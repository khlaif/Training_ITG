@extends('layouts.app')

@section('title', 'Player Dashboard')


@section('styles')

    <style>
        .dashboard-page {
            flex: 1;
            width: 100%;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 30px 20px;
            box-sizing: border-box;
        }


        .dashboard-card {
            width: 100%;
            max-width: 520px;

            background-color: white;

            border: 1px solid #dddddd;
            border-radius: 10px;

            padding: 35px 40px;

            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);

            box-sizing: border-box;
        }


        .dashboard-header {
            text-align: center;
            margin-bottom: 25px;
        }


        .dashboard-header h2 {
            margin: 0 0 8px;

            color: #1e3a5f;

            font-size: 27px;
        }


        .dashboard-header p {
            margin: 0;

            color: #777;

            font-size: 16px;
        }


        .user-info {
            border-top: 1px solid #e1e1e1;
            border-bottom: 1px solid #e1e1e1;

            padding: 18px 0;

            margin: 25px 0;
        }


        .info-row {
            display: flex;

            justify-content: space-between;
            align-items: center;

            padding: 10px 0;
        }


        .info-label {
            font-weight: bold;
            color: #222;
        }


        .info-value {
            color: #555;
            text-align: right;
        }


        .role-badge {
            background-color: #e8eef5;

            color: #1e3a5f;

            padding: 5px 12px;

            border-radius: 15px;

            font-size: 14px;
            font-weight: bold;

            text-transform: capitalize;
        }


        .logout-btn {
            width: 100%;

            background-color: #1e3a5f;

            color: white;

            border: none;

            border-radius: 5px;

            padding: 12px;

            font-size: 16px;

            cursor: pointer;
        }


        .logout-btn:hover {
            background-color: #162d4a;
        }


        @media (max-width: 600px) {

            .dashboard-card {
                padding: 25px;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .info-value {
                text-align: left;
            }
        }
    </style>

@endsection


@section('content')

    <div class="dashboard-page">

        <div class="dashboard-card">

            <div class="dashboard-header">

                <h2>Player Dashboard</h2>

                <p>
                    Welcome, {{ auth()->user()->first_name }}!
                </p>

            </div>


            <div class="user-info">

                <div class="info-row">

                    <span class="info-label">
                        First Name
                    </span>

                    <span class="info-value">
                        {{ auth()->user()->first_name }}
                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Last Name
                    </span>

                    <span class="info-value">
                        {{ auth()->user()->last_name }}
                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Email
                    </span>

                    <span class="info-value">
                        {{ auth()->user()->email }}
                    </span>

                </div>


                <div class="info-row">

                    <span class="info-label">
                        Role
                    </span>

                    <span class="role-badge">
                        {{ auth()->user()->role }}
                    </span>

                </div>

            </div>


            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button type="submit" class="logout-btn">
                    Logout
                </button>

            </form>

        </div>

    </div>

@endsection
