@extends('layouts.app')

@section('title', 'My Matches')

@section('styles')
    @include('player._styles')
@endsection

@section('content')

    <div class="player-page">

        <div class="page-heading">
            <h1>My Matches</h1>
            <p>Matches assigned to your account.</p>
        </div>

        <div class="table-wrapper">
            <table class="player-table">

                <thead>
                    <tr>
                        <th>Match Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($matches as $match)
                        <tr>
                            <td>{{ $match->name }}</td>

                            <td>
                                {{ $match->match_date->format('Y-m-d') }}
                            </td>

                            <td>
                                {{ substr($match->match_time, 0, 5) }}
                            </td>

                            <td>{{ $match->location }}</td>

                            <td>
                                {{ $match->description ?: 'No description' }}
                            </td>

                            <td>
                                <a href="{{ route('player.matches.show', $match) }}" class="player-btn">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">
                                No matches have been assigned to you.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="button-group">
            <a href="{{ route('player.dashboard') }}" class="player-btn secondary-btn">
                &larr; Back to Dashboard
            </a>
        </div>

    </div>

@endsection
