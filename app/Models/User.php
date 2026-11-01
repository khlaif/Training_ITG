<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

#[Fillable([
    'first_name',
    'last_name',
    'email',
    'password',
    'role',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Automatically delete the profile image
     * when a player is deleted.
     */
    protected static function booted(): void
    {
        static::deleted(function (User $user) {

            if ($user->role === 'player' && $user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Matches assigned to this player.
     */
    public function matches(): BelongsToMany
    {
        return $this->belongsToMany(
            SportMatch::class,
            'match_player',
            'user_id',
            'match_id'
        );
    }
}
