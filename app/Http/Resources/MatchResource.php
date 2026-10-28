<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'match_date' => $this->match_date?->format('Y-m-d'),
            'match_time' => substr($this->match_time, 0, 5),
            'location' => $this->location,
            'description' => $this->description,
            'players' => PlayerResource::collection(
                $this->whenLoaded('players')
            ),
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
