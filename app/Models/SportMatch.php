<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SportMatch extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'name',
        'match_date',
        'match_time',
        'location',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'match_date' => 'date',
        ];
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'match_player',
            'match_id',
            'user_id'
        );
    }
}
