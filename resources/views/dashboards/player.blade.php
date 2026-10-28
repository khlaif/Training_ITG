@extends('layouts.app')

@section('title', 'Player Dashboard')

@section('styles')
    @include('player._styles')
@endsection

@section('content')

    <div class="player-page">

        <div class="page-heading">
            <h1>Player Dashboard</h1>
            <p>Welcome, {{ $player->first_name }}!</p>
        </div>

        <div class="dashboard-grid">

            <div class="player-card">
                <h2>Total Assigned Matches</h2>

                <div class="stat-number">
                    {{ $totalMatches }}
                </div>

                <a href="{{ route('player.matches') }}" class="player-btn">
                    View My Matches
                </a>
            </div>

            <div class="player-card">

                <div class="dashboard-profile-header">

                    <img src="{{ $player->profile_image
        ? asset('storage/' . $player->profile_image)
        : asset('images/default-avatar.svg') }}" alt="Player Profile Image"
                        class="dashboard-avatar">

                    <h2>My Profile</h2>

                </div>

                <div class="detail-row">
                    <strong>Name</strong>
                    <span>
                        {{ $player->first_name }}
                        {{ $player->last_name }}
                    </span>
                </div>

                <div class="detail-row">
                    <strong>Email</strong>
                    <span>{{ $player->email }}</span>
                </div>

                <div class="button-group">
                    <a href="{{ route('player.profile') }}" class="player-btn">
                        View My Profile
                    </a>
                </div>
            </div>

        </div>

        <div class="player-card">

            <h2>Upcoming Matches</h2>

            @forelse($upcomingMatches as $match)

                <div class="detail-row">
                    <div>
                        <strong>{{ $match->name }}</strong>
                        <p>
                            {{ $match->match_date->format('Y-m-d') }}
                            |
                            {{ substr($match->match_time, 0, 5) }}
                        </p>
                        <p>{{ $match->location }}</p>
                    </div>

                    <div>
                        <a href="{{ route('player.matches.show', $match) }}" class="player-btn">
                            View Details
                        </a>
                    </div>
                </div>

            @empty
                <p class="empty-message">
                    You have no upcoming matches.
                </p>
            @endforelse

        </div>

        <div class="button-group">
            <a href="{{ route('player.profile') }}" class="player-btn">
                My Profile
            </a>

            <a href="{{ route('player.matches') }}" class="player-btn">
                My Matches
            </a>
        </div>

    </div>

@endsection