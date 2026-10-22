<?php

namespace App\Http\Controllers;

use App\Models\SportMatch;
use App\Models\User;
use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;

class MatchController extends Controller
{
    public function index()
    {
        $matches = SportMatch::withCount('players')
            ->orderBy('match_date')
            ->orderBy('match_time')
            ->get();

        return view('matches.index', compact('matches'));
    }

    public function create()
    {
        $players = User::where('role', 'player')
            ->orderBy('first_name')
            ->get();

        return view('matches.create', compact('players'));
    }

    public function store(StoreMatchRequest $request)
    {
        $data = $request->validated();
        $playerIds = $data['players'] ?? [];

        unset($data['players']);

        $match = SportMatch::create($data);
        $match->players()->sync($playerIds);

        return redirect()
            ->route('matches.show', $match)
            ->with('success', 'Match created successfully.');
    }

    public function show(SportMatch $match)
    {
        $match->load('players');

        $players = User::where('role', 'player')
            ->orderBy('first_name')
            ->get();

        return view('matches.show', compact('match', 'players'));
    }

    public function edit(SportMatch $match)
    {
        $match->load('players');

        $players = User::where('role', 'player')
            ->orderBy('first_name')
            ->get();

        return view('matches.edit', compact('match', 'players'));
    }

    public function update(UpdateMatchRequest $request, SportMatch $match)
    {
        $data = $request->validated();
        $playerIds = $data['players'] ?? [];

        unset($data['players']);

        $match->update($data);
        $match->players()->sync($playerIds);

        return redirect()
            ->route('matches.show', $match)
            ->with('success', 'Match updated successfully.');
    }

    public function destroy(SportMatch $match)
    {
        $match->delete();

        return redirect()
            ->route('matches.index')
            ->with('success', 'Match deleted successfully.');
    }
}
