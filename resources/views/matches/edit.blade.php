@extends('layouts.app')

@section('title', 'Edit Match')

@section('styles')
    @include('matches._styles')
@endsection

@section('content')
    <div class="matches-page">

        <h2>Edit Match</h2>

        <div class="match-card">
            <form method="POST" action="{{ route('matches.update', $match) }}">

                @csrf
                @method('PUT')

                @include('matches._form', [
                    'buttonText' => 'Save Changes'
                ])
            </form>
        </div>

    </div>
@endsection