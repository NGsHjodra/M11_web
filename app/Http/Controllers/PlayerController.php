<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;


class PlayerController extends Controller
{
    public function show($puuid)
    {
        $user = User::where('puuid', $puuid)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Player not found.');
        }

        $matches = $user->logs()->get()->sortByDesc(function ($match) {
            return substr($match->match_id, 4);
        });

        return view('player_show', compact('user', 'matches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'tagline' => 'required|max:5',
        ]);

        $user = User::where('name', $request->name)
        ->where('tagline', $request->tagline)
        ->first();

        // commented out to allow for updating user

        // // reject if user already exists and was updated within 2 hours
        // if ($user && now()->diffInHours($user->updated_at) <= 2) {
        //     return back()->withErrors('Player already exists.');
        // }

        if (!$user) {
            $user = new User();
        }
    
        $api_key = config('services.riot.api_key');
        $response_1 = Http::get("https://asia.api.riotgames.com/riot/account/v1/accounts/by-riot-id/{$request->name}/{$request->tagline}?api_key={$api_key}");

        if ($response_1->failed()) {
            return back()->withErrors('Error fetching data from RIOT API.');
        }

        $data_1 = json_decode($response_1);

        // dd($data_1); data dump to check if the data is correct

        $puuid = $data_1->puuid;

        // dd($puuid);

        $response_2 = Http::get("https://th2.api.riotgames.com/tft/summoner/v1/summoners/by-puuid/{$puuid}?api_key={$api_key}");

        if ($response_2->failed()) {
            return back()->withErrors('Error fetching data from RIOT API.');
        }
        
        $data_2 = json_decode($response_2);

        // dd($data_2);

        $summoner_id = $data_2->id;

        $response_3 = Http::get("https://th2.api.riotgames.com/tft/league/v1/entries/by-summoner/{$summoner_id}?api_key={$api_key}");

        if ($response_3->failed()) {
            return back()->withErrors('Error fetching data from RIOT API.');
        }

        $data_3 = json_decode($response_3)[0];

        // dd($data_3);

        $tier = $data_3->tier;
        $rank = $data_3->rank;
        $league_points = $data_3->leaguePoints;

        $user->fill([
            'name' => $request->name,
            'tagline' => $request->tagline,
            'puuid' => $puuid,
            'summoner_id' => $summoner_id,
            'tier' => $tier,
            'rank' => $rank,
            'point' => $league_points,
        ]);

        $user->save();

        // dd($user->puuid);

        // return redirect()->route('player_show', ['puuid' => $user->puuid])->with('success', 'Player created successfully.');
        return redirect()->route('welcome')->with('success', 'Player created successfully.');
    }

}

