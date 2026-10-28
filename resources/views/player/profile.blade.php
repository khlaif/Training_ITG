@extends('layouts.app')

@section('title', 'My Profile')

@section('styles')
    @include('player._styles')
@endsection

@section('content')

    <div class="player-page">

        <div class="page-heading">
            <h1>My Profile</h1>
            <p>View your personal information and manage your profile image.</p>
        </div>

        @if(session('success'))
            <div class="profile-alert success-alert">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="profile-alert error-alert">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="player-card">

            <div class="profile-image-section">

                <img src="{{ $player->profile_image
        ? asset('storage/' . $player->profile_image)
        : asset('images/default-avatar.svg') }}" alt="Player Profile Image" class="profile-avatar">

                <h2>
                    {{ $player->first_name }}
                    {{ $player->last_name }}
                </h2>

                <p class="profile-image-hint">
                    JPG, JPEG or PNG — Maximum size: 2 MB
                </p>

                <form action="{{ route('player.profile.image.store') }}" method="POST" enctype="multipart/form-data"
                    class="profile-upload-form">
                    @csrf

                    <div class="custom-file-upload">

                        <input type="file" name="profile_image" id="profile_image" accept=".jpg,.jpeg,.png"
                            class="hidden-file-input" required>

                        <label for="profile_image" class="custom-upload-btn">

                            <span id="upload-label">Choose Profile Picture</span>
                        </label>

                        <p id="selected-file-name" class="selected-file-name">
                            No image selected
                        </p>

                    </div>

                    <button type="submit" class="player-btn">
                        {{ $player->profile_image ? 'Replace Image' : 'Upload Image' }}
                    </button>
                </form>

                @if($player->profile_image)
                    <form action="{{ route('player.profile.image.destroy') }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to remove your profile image?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="player-btn remove-image-btn">
                            Remove Image
                        </button>
                    </form>
                @endif

            </div>

            <div class="detail-row">
                <strong>First Name</strong>
                <span>{{ $player->first_name }}</span>
            </div>

            <div class="detail-row">
                <strong>Last Name</strong>
                <span>{{ $player->last_name }}</span>
            </div>

            <div class="detail-row">
                <strong>Email</strong>
                <span>{{ $player->email }}</span>
            </div>

            <div class="detail-row">
                <strong>Registration Date</strong>
                <span>
                    {{ $player->created_at->format('F d, Y') }}
                </span>
            </div>

            <div class="detail-row">
                <strong>Role</strong>
                <span>Player</span>
            </div>

        </div>

        <a href="{{ route('player.dashboard') }}" class="player-btn secondary-btn">
            &larr; Back to Dashboard
        </a>

    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const imageInput = document.getElementById('profile_image');
        const fileName = document.getElementById('selected-file-name');
        const uploadLabel = document.getElementById('upload-label');

        imageInput.addEventListener('change', function () {

            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
                uploadLabel.textContent = 'Change Selected Picture';
            } else {
                fileName.textContent = 'No image selected';
                uploadLabel.textContent = 'Choose Profile Picture';
            }

        });

    });
</script>