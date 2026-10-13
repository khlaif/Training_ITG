@extends('layouts.app')

@section('title', 'Sign In - Sport Club')

@section('styles')
    <style>
        .login-page {
            width: 100%;
            min-height: calc(100vh - 160px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            box-sizing: border-box;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            margin-left: auto;
            margin-right: auto;
            background-color: white;
            padding: 35px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            box-sizing: border-box;
        }

        .login-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-header h2 {
            margin: 0 0 8px;
            color: #1e3a5f;
            font-size: 27px;
        }

        .login-header p {
            margin: 0;
            color: #777;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #1e3a5f;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #555;
        }

        .remember-me input {
            cursor: pointer;
        }

        .login-btn {
            width: 100%;
            padding: 11px;
            border: none;
            border-radius: 5px;
            background-color: #1e3a5f;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }

        .login-btn:hover {
            background-color: #162d4a;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .register-link a {
            color: #1e3a5f;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error {
            color: #c0392b;
            font-size: 12px;
            margin-top: 5px;
        }

        .login-error {
            background-color: #fcebea;
            color: #c0392b;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        @media (max-width: 500px) {
            .login-card {
                padding: 25px 20px;
            }
        }
    </style>
@endsection


@section('content')

    <div class="login-page">

        <div class="login-card">

            <div class="login-header">
                <h2>Welcome Back</h2>
                <p>Sign in to your Sport Club account</p>
            </div>


            @if(session('error'))
                <div class="login-error">
                    {{ session('error') }}
                </div>
            @endif


            <form method="POST" action="{{ route('login.store') }}">

                @csrf


                <!-- Email -->

                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="example@email.com">

                    @error('email')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- Password -->

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input type="password" id="password" name="password" placeholder="Enter your password">

                    @error('password')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- Remember Me -->

                <label class="remember-me">

                    <input type="checkbox" name="remember">

                    Remember me

                </label>


                <!-- Login Button -->

                <button type="submit" class="login-btn">
                    Sign In
                </button>

            </form>


            <div class="register-link">

                Don't have an account?

                <a href="{{ route('register') }}">
                    Create Account
                </a>

            </div>

        </div>

    </div>

@endsection