@extends('layouts.app')

@section('title', 'Sign Up - Sport Club')

@section('styles')
<style>
    .register-page {
        width: 100%;
        min-height: calc(100vh - 160px);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
        box-sizing: border-box;
    }

    .register-card {
        width: 100%;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        background-color: white;
        padding: 30px 35px;
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        box-sizing: border-box;
    }

    .register-card {
        width: 100%;
        max-width: 500px;
        background-color: white;
        padding: 30px 35px;
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        box-sizing: border-box;
    }

    .register-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .register-header h2 {
        margin: 0 0 8px;
        color: #1e3a5f;
        font-size: 27px;
    }

    .register-header p {
        margin: 0;
        color: #777;
        font-size: 14px;
    }

    .name-row {
        display: flex;
        gap: 15px;
    }

    .name-row .form-group {
        flex: 1;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label,
    .role-label {
        display: block;
        margin-bottom: 6px;
        font-size: 14px;
        font-weight: bold;
        color: #333;
    }

    .form-group input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .form-group input:focus {
        outline: none;
        border-color: #1e3a5f;
    }

    .role-options {
        display: flex;
        gap: 12px;
        margin-bottom: 16px;
    }

    .role-option {
        flex: 1;
    }

    .role-option input {
        display: none;
    }

    .role-option label {
        display: block;
        text-align: center;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
        color: #555;
        background-color: #fff;
    }

    .role-option input:checked + label {
        background-color: #eef4fa;
        border-color: #1e3a5f;
        color: #1e3a5f;
        font-weight: bold;
    }

    .register-btn {
        width: 100%;
        padding: 11px;
        margin-top: 5px;
        border: none;
        border-radius: 5px;
        background-color: #1e3a5f;
        color: white;
        font-size: 15px;
        cursor: pointer;
    }

    .register-btn:hover {
        background-color: #162d4a;
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
        color: #666;
        font-size: 14px;
    }

    .login-link a {
        color: #1e3a5f;
        font-weight: bold;
        text-decoration: none;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    .error {
        color: #c0392b;
        font-size: 12px;
        margin-top: 5px;
    }

    @media (max-width: 550px) {
        .register-card {
            padding: 25px 20px;
        }

        .name-row {
            display: block;
        }
    }
</style>
@endsection


@section('content')

<div class="register-page">

    <div class="register-card">

        <div class="register-header">
            <h2>Create Account</h2>
            <p>Join the Sport Club</p>
        </div>

        <form method="POST" action="{{ route('register.store') }}">

            @csrf

            <div class="name-row">

                <div class="form-group">
                    <label for="first_name">First Name</label>

                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        value="{{ old('first_name') }}"
                        placeholder="First name"
                    >

                    @error('first_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>

                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        value="{{ old('last_name') }}"
                        placeholder="Last name"
                    >

                    @error('last_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            <div class="form-group">
                <label for="email">Email Address</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="example@email.com"
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>


            <span class="role-label">Select Role</span>

            <div class="role-options">

                <div class="role-option">
                    <input
                        type="radio"
                        id="player"
                        name="role"
                        value="player"
                        {{ old('role') == 'player' ? 'checked' : '' }}
                    >

                    <label for="player">
                        Player
                    </label>
                </div>

                <div class="role-option">
                    <input
                        type="radio"
                        id="trainer"
                        name="role"
                        value="trainer"
                        {{ old('role') == 'trainer' ? 'checked' : '' }}
                    >

                    <label for="trainer">
                        Trainer
                    </label>
                </div>

            </div>

            @error('role')
                <div class="error" style="margin-top: -10px; margin-bottom: 15px;">
                    {{ $message }}
                </div>
            @enderror


            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimum 8 characters"
                >

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="password_confirmation">
                    Confirm Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Enter password again"
                >
            </div>


            <button type="submit" class="register-btn">
                Create Account
            </button>

        </form>


        <div class="login-link">
            Already have an account?
            <a href="/login">Sign In</a>
        </div>

    </div>

</div>

@endsection
