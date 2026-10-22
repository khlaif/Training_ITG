@extends('layouts.app')

@section('title', 'My Profile')

@section('styles')
    @include('player._styles')
@endsection

@section('content')

    <div class="player-page">

        <div class="page-heading">
            <h1>My Profile</h1>
            <p>View your personal information.</p>
        </div>

        <div class="player-card">

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
