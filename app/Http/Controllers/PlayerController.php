<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{
    public function index()
    {
        $players = User::where('role', 'player')
            ->latest()
            ->get();

        return view('players.index', compact('players'));
    }

    public function create()
    {
        return view('players.create');
    }

    public function store(StorePlayerRequest $request)
    {
        $data = $request->validated();

        User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'player',
        ]);

        return redirect()->route('players.index')
            ->with('success', 'Player added successfully.');
    }

    public function edit(User $player)
    {
        abort_unless($player->role === 'player', 404);

        return view('players.edit', compact('player'));
    }

    public function update(UpdatePlayerRequest $request, User $player)
    {
        abort_unless($player->role === 'player', 404);

        $data = $request->validated();

        $player->first_name = $data['first_name'];
        $player->last_name = $data['last_name'];
        $player->email = $data['email'];

        if (!empty($data['password'])) {
            $player->password = Hash::make($data['password']);
        }

        $player->save();

        return redirect()->route('players.index')
            ->with('success', 'Player updated successfully.');
    }

    public function destroy(User $player)
    {
        abort_unless($player->role === 'player', 404);

        $player->delete();

        return redirect()->route('players.index')
            ->with('success', 'Player deleted successfully.');
    }
}
