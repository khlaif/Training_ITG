<?php

namespace App\Http\Controllers;

use App\Models\SportMatch;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlayerDashboardController extends Controller
{
    public function dashboard(Request $request): View
    {
        $player = $request->user();

        $totalMatches = $player->matches()->count();

        $upcomingMatches = $player->matches()
            ->where(function ($query) {
                $query->whereDate('match_date', '>', today())
                    ->orWhere(function ($query) {
                        $query->whereDate('match_date', today())
                            ->whereTime('match_time', '>=', now()->format('H:i:s'));
                    });
            })
            ->orderBy('match_date')
            ->orderBy('match_time')
            ->get();

        return view('dashboards.player', compact(
            'player',
            'totalMatches',
            'upcomingMatches'
        ));
    }

    public function profile(Request $request): View
    {
        $player = $request->user();

        return view('player.profile', compact('player'));
    }

    public function matches(Request $request): View
    {
        $matches = $request->user()
            ->matches()
            ->orderBy('match_date')
            ->orderBy('match_time')
            ->get();

        return view('player.matches', compact('matches'));
    }

    public function matchDetails(
        Request $request,
        SportMatch $match
    ): View {
        $player = $request->user();

        $assignedMatch = $player->matches()
            ->whereKey($match->getKey())
            ->firstOrFail();

        return view('player.match-details', [
            'match' => $assignedMatch
        ]);
    }
}
