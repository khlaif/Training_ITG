<?php

namespace App\Http\Controllers;

use App\Models\SportMatch;
use App\Models\User;
use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'match_date' => ['nullable', 'date_format:Y-m-d'],
            'location' => ['nullable', 'string', 'max:255'],
            'sort' => ['nullable', 'in:name,match_date'],
            'direction' => ['nullable', 'in:asc,desc'],
        ]);

        $search = trim($validated['search'] ?? '');
        $matchDate = $validated['match_date'] ?? null;
        $location = trim($validated['location'] ?? '');
        $sort = $validated['sort'] ?? 'match_date';
        $direction = $validated['direction'] ?? 'asc';

        $matches = SportMatch::query()
            ->withCount('players')

            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })

            ->when($matchDate, function ($query) use ($matchDate) {
                $query->whereDate('match_date', $matchDate);
            })

            ->when($location !== '', function ($query) use ($location) {
                $query->where('location', 'like', "%{$location}%");
            })

            ->orderBy($sort, $direction)
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

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
