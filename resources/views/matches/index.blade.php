@extends('layouts.app')

@section('title', 'Matches List')

@section('styles')
    @include('matches._styles')
@endsection

@section('content')
    <div class="matches-page">

        <div class="match-header">
            <h2>Matches List</h2>
            <a href="{{ route('matches.create') }}" class="match-btn">
                + Create Match
            </a>
        </div>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="table-wrapper">
            <table class="matches-table">
                <thead>
                    <tr>
                        <th>Match Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Players</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($matches as $match)
                        <tr>
                            <td>{{ $match->name }}</td>
                            <td>{{ $match->match_date->format('Y-m-d') }}</td>
                            <td>{{ substr($match->match_time, 0, 5) }}</td>
                            <td>{{ $match->location }}</td>
                            <td>{{ $match->players_count }}</td>

                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('matches.show', $match) }}" class="match-btn">Details</a>

                                    <a href="{{ route('matches.edit', $match) }}" class="match-btn">Edit</a>

                                    <form method="POST" action="{{ route('matches.destroy', $match) }}"
                                        onsubmit="return confirm('Delete this match?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="match-btn danger-btn">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">
                                No matches found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('trainer.dashboard') }}" class="match-btn back-link">
            &larr; Back to Dashboard
        </a>

    </div>
@endsection