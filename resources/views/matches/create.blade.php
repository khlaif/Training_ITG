@extends('layouts.app')

@section('title', 'Create Match')

@section('styles')
    @include('matches._styles')
@endsection

@section('content')
    <div class="matches-page">

        <h2>Create Match</h2>

        <div class="match-card">
            <form method="POST" action="{{ route('matches.store') }}">
                @csrf

                @include('matches._form', [
                    'buttonText' => 'Create Match'
                ])
            </form>
        </div>

    </div>
@endsection