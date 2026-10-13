<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sport Club')</title>

    <style>
        html,
        body {
            margin: 0;
            height: 100%;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        /* Navbar */
        nav {
            background-color: #1e3a5f;
            padding: 15px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .logo {
            color: white;
            font-size: 22px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 25px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        /* Main Content */
        main {
            flex: 1;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 84%;
            margin: auto;
        }

        /* Footer */
        footer {
            background-color: #1e3a5f;
            color: white;
            text-align: center;
            padding: 15px;
        }

        footer p {
            margin: 0;
        }

        /* Responsive Navbar */
        @media (max-width: 600px) {
            nav {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }

            .nav-links {
                justify-content: center;
                gap: 15px;
            }
        }
    </style>

    {{-- CSS specific to each page --}}
    @yield('styles')

</head>

<body>

    <nav>

        <div class="logo">
            Sport Club
        </div>

        <div class="nav-links">

            <a href="{{ route('home') }}">Home</a>

            @guest

                <a href="{{ route('register') }}">
                    Sign Up
                </a>

                <a href="{{ route('login') }}">
                    Sign In
                </a>

            @endguest

            @auth

                @if(auth()->user()->role === 'trainer')

                    <a href="{{ route('trainer.dashboard') }}">
                        Dashboard
                    </a>

                    <a href="{{ route('players.index') }}">
                        Manage Players
                    </a>

                @elseif(auth()->user()->role === 'player')

                    <a href="{{ route('player.dashboard') }}">
                        Dashboard
                    </a>

                @endif

            @endauth

        </div>

    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Sport Club Management System</p>
    </footer>


    @yield('scripts')
</body>

</html>