@extends('layouts.app')

@section('title', 'Add Player')

@section('styles')
    <style>
        .form-page {
            flex: 1;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 20px;
            box-sizing: border-box;
        }

        .form-card {
            width: 100%;
            max-width: 480px;
            background: white;
            padding: 30px 35px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            box-sizing: border-box;
        }

        .form-card h2 {
            text-align: center;
            color: #1e3a5f;
            margin: 0 0 25px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #1e3a5f;
        }

        .error {
            color: #c0392b;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #1e3a5f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            margin-top: 10px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #1e3a5f;
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <div class="form-page">
        <div class="form-card">
            <h2>Add New Player</h2>

            <form method="POST" action="{{ route('players.store') }}">
                @csrf

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required>
                    @error('first_name') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required>
                    @error('last_name') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required>
                </div>

                <button type="submit" class="submit-btn">Add Player</button>
            </form>

            <a href="{{ route('players.index') }}" class="back-link">Back to Players List</a>
        </div>
    </div>
@endsection