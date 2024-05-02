<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Log;
use App\Models\User;

class MatchHistoryController extends Controller
{
    public function fetch($puuid)
    {
        $user = User::where('puuid', $puuid)->first();

        // dd($user->last_match_history_updated); // data dump to check if the data is correct

        if ($user->last_match_history_updated !== null && now()->diffInHours($user->last_match_history_update) <= 2) {
            return back()->withErrors('Match history already fetched within 2 hours.');
        }

        // dd($puuid); // data dump to check if the data is correct
        $api_key = config('services.riot.api_key');

        $response_match_history = Http::get("https://sea.api.riotgames.com/tft/match/v1/matches/by-puuid/{$puuid}/ids?start=0&count=20&api_key={$api_key}");

        // dd($response_match_history); // data dump to check if the data is correct

        if ($response_match_history->failed()) {
            return back()->withErrors('Error fetching data from RIOT API.');
        }

        $data_match_history = json_decode($response_match_history);

        // dd($data_match_history); // data dump to check if the data is correct

        for ($i = 0; $i < count($data_match_history); $i++) {
            $response_match = Http::get("https://sea.api.riotgames.com/tft/match/v1/matches/{$data_match_history[$i]}?api_key={$api_key}");

            if ($response_match->failed()) {
                return back()->withErrors('Error fetching data from RIOT API.');
            }

            $data_match = json_decode($response_match);

            // dd($data_match); // data dump to check if the data is correct

            $placement = null;

            for ($j = 0; $j < count($data_match->metadata->participants); $j++) {
                if ($data_match->metadata->participants[$j] == $puuid) {
                    $placement = $data_match->info->participants[$j]->placement;
                    break;
                }
            }

            // store the match data in the database
            Log::create([
                'puuid' => $puuid,
                'match_id' => $data_match->metadata->match_id,
                'participants' => json_encode($data_match->metadata->participants),
                'placement' => $placement,
            ]);
        }

        $user->last_match_history_updated = now();
        $user->save();


        return back()->with('success', 'Match history fetched successfully.');
    }
}
