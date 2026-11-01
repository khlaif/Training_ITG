<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePlayerRequest;
use App\Http\Requests\Api\UpdatePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class PlayerController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $players = User::query()
            ->where('role', 'player')
            ->orderBy('first_name')
            ->paginate(10);

        return PlayerResource::collection($players);
    }

    public function show(User $player): PlayerResource
    {
        abort_unless($player->role === 'player', 404);

        return new PlayerResource($player);
    }

    public function store(StorePlayerRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['role'] = 'player';

        $player = User::create($data);

        return (new PlayerResource($player))
            ->response()
            ->setStatusCode(201);
    }

    public function update(
        UpdatePlayerRequest $request,
        User $player
    ): PlayerResource {
        abort_unless($player->role === 'player', 404);

        $player->update($request->validated());

        return new PlayerResource($player->refresh());
    }

    public function destroy(User $player): JsonResponse
    {
        abort_unless(auth()->user()?->role === 'trainer', 403);

        abort_unless($player->role === 'player', 404);

        $player->delete();

        return response()->json([
            'message' => 'Player deleted successfully.'
        ], 200);
    }
}
