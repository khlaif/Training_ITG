@extends('layouts.app')

@section('title', 'Match Details')

@section('styles')
    @include('player._styles')
@endsection

@section('content')

    <div class="player-page">

        <div class="page-heading">
            <h1>Match Details</h1>
            <p>View your assigned match information.</p>
        </div>

        <div class="player-card">

            <div class="detail-row">
                <strong>Match Name</strong>
                <span>{{ $match->name }}</span>
            </div>

            <div class="detail-row">
                <strong>Match Date</strong>
                <span>
                    {{ $match->match_date->format('Y-m-d') }}
                </span>
            </div>

            <div class="detail-row">
                <strong>Match Time</strong>
                <span>
                    {{ substr($match->match_time, 0, 5) }}
                </span>
            </div>

            <div class="detail-row">
                <strong>Location</strong>
                <span>{{ $match->location }}</span>
            </div>

            <div class="detail-row">
                <strong>Description</strong>
                <span>
                    {{ $match->description ?: 'No description provided.' }}
                </span>
            </div>

        </div>

        <a href="{{ route('player.matches') }}" class="player-btn secondary-btn">
            &larr; Back to My Matches
        </a>

    </div>

@endsection
