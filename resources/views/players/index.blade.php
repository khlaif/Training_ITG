@extends('layouts.app')

@section('title', 'Players List')

@section('styles')
    <style>
        .players-page {
            width: 90%;
            max-width: 1050px;
            margin: 45px auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .page-header h2 {
            color: #1e3a5f;
            margin: 0;
        }

        .btn {
            background: #1e3a5f;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover {
            background: #162d4a;
            color: white;
        }

        .players-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        .players-table th,
        .players-table td {
            padding: 15px;
            border-bottom: 1px solid #e5e5e5;
            text-align: left;
        }

        .players-table th {
            background: #edf1f5;
            color: #1e3a5f;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .delete-btn {
            background: #c0392b;
        }

        .delete-btn:hover {
            background: #a93226;
        }

        .alert {
            padding: 12px 15px;
            background: #e6f4ea;
            color: #256b37;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        /* Back to Dashboard Button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 25px;
            padding: 11px 18px;
            background-color: #1e3a5f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.2s ease;
        }

        .back-btn:hover {
            background-color: #162d4a;
            color: white;
        }


        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 20px;
        }

        .modal-overlay[hidden] {
            display: none;
        }

        .delete-modal {
            background: white;
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
            text-align: center;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .delete-icon {
            width: 55px;
            height: 55px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: #fce8e6;
            color: #c0392b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
        }

        .delete-modal h2 {
            color: #1e3a5f;
            margin-bottom: 12px;
        }

        .delete-modal p {
            color: #666;
            line-height: 1.5;
        }

        .delete-player-name {
            background: #f3f5f8;
            padding: 12px;
            border-radius: 6px;
            font-weight: bold;
            margin: 15px 0;
        }

        .delete-warning {
            font-size: 13px;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 22px;
        }

        .cancel-btn,
        .confirm-delete-btn {
            flex: 1;
            padding: 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .cancel-btn {
            background: #e5e7eb;
            color: #333;
        }

        .confirm-delete-btn {
            background: #c0392b;
            color: white;
        }

        .confirm-delete-btn:hover {
            background: #a93226;
        }

        /* Task 8 - Player Search, Filters and Pagination */

        .player-filter-form {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 15px;
            padding: 22px;
            margin-bottom: 25px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        .filter-field {
            display: flex;
            flex-direction: column;
            gap: 7px;
            flex: 1 1 170px;
        }

        .filter-field label {
            font-size: 13px;
            font-weight: 600;
            color: #1e3a5f;
        }

        .filter-field input,
        .filter-field select {
            padding: 11px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background: white;
            color: #334155;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
        }

        .filter-field input:focus,
        .filter-field select:focus {
            outline: none;
            border-color: #1e3a5f;
            box-shadow: 0 0 0 2px rgba(30, 58, 95, 0.1);
        }

        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .clear-filter-btn {
            display: inline-block;
            padding: 10px 15px;
            background: #e2e8f0;
            color: #1e3a5f;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .clear-filter-btn:hover {
            background: #cbd5e1;
        }

        .pagination-section {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 22px;
        }

        .pagination-info {
            font-size: 14px;
            color: #475569;
            margin: 0;
        }

        .pagination-buttons {
            display: flex;
            gap: 10px;
        }

        .pagination-btn {
            display: inline-block;
            padding: 9px 15px;
            border-radius: 6px;
            background: #1e3a5f;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .pagination-btn:hover {
            background: #162d4a;
            color: white;
        }

        .pagination-btn.disabled {
            background: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
        }

        @media (max-width: 650px) {
            .player-filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-field,
            .filter-buttons {
                width: 100%;
            }
        }


        @media (max-width: 650px) {
            .players-table {
                display: block;
                overflow-x: auto;
            }

            .page-header {
                flex-wrap: wrap;
            }
        }
    </style>
@endsection

@section('content')

    <div class="players-page">

        <div class="page-header">
            <h2>Players List</h2>

            <a href="{{ route('players.create') }}" class="btn">
                + Add Player
            </a>
        </div>

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('players.index') }}" class="player-filter-form">

            <div class="filter-field">
                <label for="search">Search Players</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}"
                    placeholder="First name, last name or email">
            </div>

            <div class="filter-field">
                <label for="registration_date">Registration Date</label>
                <input type="date" id="registration_date" name="registration_date"
                    value="{{ request('registration_date') }}">
            </div>

            <div class="filter-field">
                <label for="sort">Sort By</label>
                <select id="sort" name="sort">
                    <option value="created_at" @selected(request('sort', 'created_at') === 'created_at')>
                        Registration Date
                    </option>
                    <option value="first_name" @selected(request('sort') === 'first_name')>
                        First Name
                    </option>
                </select>
            </div>

            <div class="filter-field">
                <label for="direction">Order</label>
                <select id="direction" name="direction">
                    <option value="asc" @selected(request('direction', 'desc') === 'asc')>
                        Ascending
                    </option>
                    <option value="desc" @selected(request('direction', 'desc') === 'desc')>
                        Descending
                    </option>
                </select>
            </div>

            <div class="filter-buttons">
                <button type="submit" class="btn">
                    Apply Filters
                </button>

                <a href="{{ route('players.index') }}" class="clear-filter-btn">
                    Clear Filters
                </a>
            </div>

        </form>

        <table class="players-table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($players as $player)
                    <tr>
                        <td>
                            {{ $player->first_name }}
                            {{ $player->last_name }}
                        </td>

                        <td>
                            {{ $player->email }}
                        </td>

                        <td>
                            {{ $player->created_at->format('Y-m-d') }}
                        </td>

                        <td>
                            <div class="actions">

                                <a href="{{ route('players.edit', $player) }}" class="btn">
                                    Edit
                                </a>


                                <button type="button" class="btn delete-btn"
                                    data-delete-url="{{ route('players.destroy', $player) }}"
                                    data-player-name="{{ $player->first_name }} {{ $player->last_name }}"
                                    onclick="openDeleteModal(this)">
                                    Delete
                                </button>


                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:#777;">
                            No players match your search or filter criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-section">

            <p class="pagination-info">
                Showing {{ $players->firstItem() ?? 0 }}
                to {{ $players->lastItem() ?? 0 }}
                of {{ $players->total() }} players
            </p>

            <p class="pagination-info">
                Page {{ $players->currentPage() }}
                of {{ $players->lastPage() }}
            </p>

            <div class="pagination-buttons">

                @if($players->onFirstPage())
                    <span class="pagination-btn disabled">Previous</span>
                @else
                    <a href="{{ $players->previousPageUrl() }}" class="pagination-btn">
                        Previous
                    </a>
                @endif

                @if($players->hasMorePages())
                    <a href="{{ $players->nextPageUrl() }}" class="pagination-btn">
                        Next
                    </a>
                @else
                    <span class="pagination-btn disabled">Next</span>
                @endif

            </div>

        </div>


        <div id="deleteModal" class="modal-overlay" hidden>
            <div class="delete-modal" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">

                <div class="delete-icon">!</div>

                <h2 id="deleteModalTitle">Delete Player?</h2>

                <p>Are you sure you want to delete this player?</p>

                <div class="delete-player-name" id="deletePlayerName"></div>

                <p class="delete-warning">
                    This action cannot be undone.
                </p>

                <form id="deletePlayerForm" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-actions">
                        <button type="button" class="cancel-btn" onclick="closeDeleteModal()">
                            Cancel
                        </button>

                        <button type="submit" class="confirm-delete-btn">
                            Delete Player
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <a href="{{ route('trainer.dashboard') }}" class="back-btn">
            &larr; Back to Dashboard
        </a>

    </div>

@endsection


<script>
    let previousFocus = null;

    function openDeleteModal(button) {
        previousFocus = button;

        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deletePlayerForm');
        const playerName = document.getElementById('deletePlayerName');

        form.action = button.dataset.deleteUrl;
        playerName.textContent = button.dataset.playerName;

        modal.hidden = false;
        modal.querySelector('.cancel-btn').focus();
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').hidden = true;

        if (previousFocus) {
            previousFocus.focus();
        }
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeDeleteModal();
        }
    });

    document.getElementById('deleteModal').addEventListener('click', function (event) {
        if (event.target === this) {
            closeDeleteModal();
        }
    });
</script>