<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreMatchRequest;
use App\Http\Requests\Api\UpdateMatchRequest;
use App\Http\Requests\Api\AssignPlayersRequest;
use App\Http\Resources\MatchResource;
use App\Models\SportMatch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;

class MatchController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $matches = SportMatch::query()
            ->with('players')
            ->orderBy('match_date')
            ->orderBy('match_time')
            ->paginate(10);

        return MatchResource::collection($matches);
    }

    public function show(SportMatch $match): MatchResource
    {
        return new MatchResource($match->load('players'));
    }

    public function store(StoreMatchRequest $request): JsonResponse
    {
        $data = $request->validated();

        $match = SportMatch::create(
            Arr::except($data, ['players'])
        );

        if (array_key_exists('players', $data)) {
            $match->players()->sync($data['players']);
        }

        return (new MatchResource($match->load('players')))
            ->response()
            ->setStatusCode(201);
    }

    public function update(
        UpdateMatchRequest $request,
        SportMatch $match
    ): MatchResource {
        $data = $request->validated();

        $match->update(
            Arr::except($data, ['players'])
        );

        if (array_key_exists('players', $data)) {
            $match->players()->sync($data['players']);
        }

        return new MatchResource($match->load('players'));
    }

    public function destroy(SportMatch $match): JsonResponse
    {
        abort_unless(auth()->user()?->role === 'trainer', 403);

        $match->delete();

        return response()->json([
            'message' => 'Match deleted successfully.'
        ], 200);
    }

    public function assignPlayers(
        AssignPlayersRequest $request,
        SportMatch $match
    ): MatchResource {
        $data = $request->validated();

        $match->players()->syncWithoutDetaching($data['players']);

        return new MatchResource($match->load('players'));
    }
}
