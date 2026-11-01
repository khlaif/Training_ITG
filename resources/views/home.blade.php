@extends('layouts.app')

@section('title', 'Sport Club - Home')

@section('styles')
    <style>
        .welcome {
            padding: 80px 0;
            text-align: center;
            background-color: white;
        }

        .welcome h1 {
            font-size: 42px;
            color: #1e3a5f;
            margin-bottom: 15px;
        }

        .welcome p {
            font-size: 18px;
            color: #666;
            max-width: 650px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }

        .buttons a {
            display: inline-block;
            padding: 12px 22px;
            margin: 5px;
            text-decoration: none;
            border-radius: 5px;
        }

        .join-btn {
            background-color: #1e3a5f;
            color: white;
        }

        .join-btn:hover {
            background-color: #162d4a;
        }

        .login-btn {
            background-color: #ddd;
            color: #333;
        }

        .login-btn:hover {
            background-color: #ccc;
        }

        .about {
            padding: 50px 0;
        }

        .about h2 {
            text-align: center;
            color: #1e3a5f;
            margin-bottom: 30px;
        }

        .cards {
            display: flex;
            gap: 20px;
        }

        .card {
            background-color: white;
            padding: 25px;
            border-radius: 5px;
            flex: 1;
            border: 1px solid #ddd;
        }

        .card h3 {
            color: #1e3a5f;
        }

        .card p {
            color: #666;
            line-height: 1.5;
        }

        @media (max-width: 700px) {
            .cards {
                flex-direction: column;
            }

            .welcome h1 {
                font-size: 32px;
            }
        }
    </style>
@endsection

@section('content')

    <section class="welcome">
        <div class="container">

            <h1>Welcome to Sport Club</h1>

            <p>
                Our Sport Club Management System helps players and trainers
                join the club and access their own accounts.
            </p>

            <div class="buttons">

                @guest

                    <a href="{{ route('register') }}" class="join-btn">
                        Sign Up
                    </a>

                    <a href="{{ route('login') }}" class="login-btn">
                        Sign In
                    </a>

                @endguest

                @auth

                    @if(auth()->user()->role === 'trainer')

                        <a href="{{ route('trainer.dashboard') }}" class="join-btn">
                            Go to Dashboard
                        </a>

                    @elseif(auth()->user()->role === 'player')

                        <a href="{{ route('player.dashboard') }}" class="join-btn">
                            Go to Dashboard
                        </a>

                    @endif

                @endauth

            </div>

        </div>
    </section>

    <section class="about">
        <div class="container">

            <h2>About Our Club</h2>

            <div class="cards">

                <div class="card">
                    <h3>Players</h3>
                    <p>
                        Players can create an account and access their
                        personal dashboard.
                    </p>
                </div>

                <div class="card">
                    <h3>Trainers</h3>
                    <p>
                        Trainers can register with the club and access
                        their trainer dashboard.
                    </p>
                </div>

                <div class="card">
                    <h3>Our Goal</h3>
                    <p>
                        Our goal is to provide a simple system for managing
                        the club and its members.
                    </p>
                </div>

            </div>

        </div>
    </section>

@endsection