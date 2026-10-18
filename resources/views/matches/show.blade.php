@extends('layouts.app')

@section('title', 'Match Details')

@section('styles')
    @include('matches._styles')
@endsection

@section('content')
    <div class="matches-page">

        <div class="match-header">
            <h2>Match Details</h2>

            <a href="{{ route('matches.edit', $match) }}" class="match-btn">
                Edit Match
            </a>
        </div>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="match-card">

            <div class="detail-row">
                <strong>Match Name:</strong>
                {{ $match->name }}
            </div>

            <div class="detail-row">
                <strong>Date:</strong>
                {{ $match->match_date->format('Y-m-d') }}
            </div>

            <div class="detail-row">
                <strong>Time:</strong>
                {{ substr($match->match_time, 0, 5) }}
            </div>

            <div class="detail-row">
                <strong>Location:</strong>
                {{ $match->location }}
            </div>

            <div class="detail-row">
                <strong>Description:</strong>
                {{ $match->description ?: 'No description provided.' }}
            </div>

            <h2>Assigned Players</h2>

            @forelse($match->players as $player)
                <div class="detail-row">
                    {{ $player->first_name }} {{ $player->last_name }}
                    — {{ $player->email }}
                </div>
            @empty
                <p>No players assigned to this match.</p>
            @endforelse

            <div style="margin-top:25px;">
                <a href="{{ route('matches.edit', $match) }}" class="match-btn">
                    Update Player Assignments
                </a>
            </div>

        </div>

        <a href="{{ route('matches.index') }}" class="match-btn back-link">
            &larr; Back to Matches
        </a>

    </div>
@endsection