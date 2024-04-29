<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index()
    {
        $leaders = User::query()
            ->orderByRaw("CASE tier
                WHEN 'CHALLENGER' THEN 1
                WHEN 'GRANDMASTER' THEN 2
                WHEN 'MASTER' THEN 3
                WHEN 'DIAMOND' THEN 4
                WHEN 'EMERALD' THEN 5
                WHEN 'PLATINUM' THEN 6
                WHEN 'GOLD' THEN 7
                WHEN 'SILVER' THEN 8
                WHEN 'BRONZE' THEN 9
                WHEN 'IRON' THEN 10
                ELSE 11 END")
            ->orderByRaw("CASE rank
                WHEN 'I' THEN 1
                WHEN 'II' THEN 2
                WHEN 'III' THEN 3
                WHEN 'IV' THEN 4
                ELSE 5 END")
            ->orderByDesc('point')
            ->take(10)
            ->get();

        return view('welcome', compact('leaders'));
    }
}
