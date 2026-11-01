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

        <form method="GET" action="{{ route('matches.index') }}" class="match-filter-form">

            <div class="match-filter-field">
                <label for="search">Search Matches</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}"
                    placeholder="Match name or location">
            </div>

            <div class="match-filter-field">
                <label for="match_date">Match Date</label>
                <input type="date" id="match_date" name="match_date" value="{{ request('match_date') }}">
            </div>

            <div class="match-filter-field">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" value="{{ request('location') }}"
                    placeholder="Filter by location">
            </div>

            <div class="match-filter-field">
                <label for="sort">Sort By</label>
                <select id="sort" name="sort">
                    <option value="match_date" @selected(request('sort', 'match_date') === 'match_date')>
                        Match Date
                    </option>
                    <option value="name" @selected(request('sort') === 'name')>
                        Match Name
                    </option>
                </select>
            </div>

            <div class="match-filter-field">
                <label for="direction">Order</label>
                <select id="direction" name="direction">
                    <option value="asc" @selected(request('direction', 'asc') === 'asc')>
                        Ascending
                    </option>
                    <option value="desc" @selected(request('direction', 'asc') === 'desc')>
                        Descending
                    </option>
                </select>
            </div>

            <div class="match-filter-buttons">
                <button type="submit" class="match-btn">Apply Filters</button>

                <a href="{{ route('matches.index') }}" class="match-clear-btn">
                    Clear Filters
                </a>
            </div>

        </form>

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
                                No matches match your search or filter criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>

        <div class="match-pagination">

            <p>
                Showing {{ $matches->firstItem() ?? 0 }}
                to {{ $matches->lastItem() ?? 0 }}
                of {{ $matches->total() }} matches
            </p>

            <p>
                Page {{ $matches->currentPage() }}
                of {{ $matches->lastPage() }}
            </p>

            <div class="match-pagination-buttons">
                @if($matches->onFirstPage())
                    <span class="match-page-btn disabled">Previous</span>
                @else
                    <a href="{{ $matches->previousPageUrl() }}" class="match-page-btn">
                        Previous
                    </a>
                @endif

                @if($matches->hasMorePages())
                    <a href="{{ $matches->nextPageUrl() }}" class="match-page-btn">
                        Next
                    </a>
                @else
                    <span class="match-page-btn disabled">Next</span>
                @endif
            </div>

        </div>

        <a href="{{ route('trainer.dashboard') }}" class="match-btn back-link">
            &larr; Back to Dashboard
        </a>

    </div>
@endsection