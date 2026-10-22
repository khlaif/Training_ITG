@if ($errors->any())
    <div class="error-box">
        <strong>Please correct the following errors:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="name">Match Name</label>
    <input type="text" id="name" name="name" value="{{ old('name', $match->name ?? '') }}" required>
</div>

<div class="form-group">
    <label for="match_date">Match Date</label>
    <input type="date" id="match_date" name="match_date"
        value="{{ old('match_date', isset($match) ? $match->match_date->format('Y-m-d') : '') }}" required>
</div>

<div class="form-group">
    <label for="match_time">Match Time</label>
    <input type="time" id="match_time" name="match_time"
        value="{{ old('match_time', isset($match) ? substr($match->match_time, 0, 5) : '') }}" required>
</div>

<div class="form-group">
    <label for="location">Location</label>
    <input type="text" id="location" name="location" value="{{ old('location', $match->location ?? '') }}" required>
</div>

<div class="form-group">
    <label for="description">Description (Optional)</label>
    <textarea id="description" name="description"
        rows="4">{{ old('description', $match->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label>Assign Players</label>
    <p class="field-hint">Select the players participating in this match.</p>

    @php
        $selectedPlayers = old(
            'players',
            isset($match) ? $match->players->pluck('id')->all() : []
        );
    @endphp

    <div class="player-options">
        @forelse ($players as $player)
            <label class="player-option">
                <input type="checkbox" name="players[]" value="{{ $player->id }}" @checked(in_array($player->id, $selectedPlayers))>

                {{ $player->first_name }} {{ $player->last_name }}
                ({{ $player->email }})
            </label>
        @empty
            <p>No registered players available.</p>
        @endforelse
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="match-btn">
        {{ $buttonText }}
    </button>

    <a href="{{ route('matches.index') }}" class="match-btn secondary-btn">
        Cancel
    </a>
</div>