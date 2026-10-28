<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadProfileImageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerProfileImageController extends Controller
{
    public function store(UploadProfileImageRequest $request): RedirectResponse
    {
        $player = $request->user();

        $newPath = $request->file('profile_image')
            ->store('profile-images', 'public');

        $oldPath = $player->profile_image;

        $player->profile_image = $newPath;
        $player->save();

        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        return back()->with(
            'success',
            'Profile image uploaded successfully.'
        );
    }

    public function destroy(Request $request): RedirectResponse
    {
        $player = $request->user();

        abort_unless($player && $player->role === 'player', 403);

        $oldPath = $player->profile_image;

        $player->profile_image = null;
        $player->save();

        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        return back()->with(
            'success',
            'Profile image removed successfully.'
        );
    }
}
