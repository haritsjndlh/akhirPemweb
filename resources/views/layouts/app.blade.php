<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons,wght,FILL,GRAD@48,400,0,0" />

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>My Money | Your Money Manager</title>

    @yield('style')
</head>
<body>
    <div id="app">
        <nav>
            <div class="container">
                <a href="{{ url('/home') }}"><img src="logo.png" class="logo" style="align-items: center; width:13rem; margin-left:-2rem"></a>

                <div>
                    <!-- Left Side Of Navbar -->
                    <div class="search-bar" style="margin-top: -0.5rem;">
                        <span class="material-symbols-sharp">search</span>
                        <input type="search" placeholder="Search Here">
                    </div>

                    <div class="profile-area">
                        <div class="theme-btn">
                            <span class="material-symbols-sharp active">light_mode</span>
                            <span class="material-symbols-sharp">dark_mode</span>
                        </div>

                        <div class="profile">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}" style="color: grey"><h5>{{ __('Login') }}</h5></a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}" style="color: grey"><h5>{{ __('Register') }}</h5></a>
                                    </li>
                                @endif
                            @else
                                <li class="dropdown">
                                    <a class="dropbtn" href="#" role="button">
                                    <h4> {{ Auth::user()->name }}</h4>
                                    </a>

                                    <div class="dropdown-content" aria-labelledby="navbarDropdown">
                                        <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <aside>
                @yield('sidebar')
            </aside>
            <section class="middle">
                @yield('mid-cont')
            </section>
            <section class="right">
                @yield('right-cont')
            </section>
        </main>
    </div>
    <script>
        // change theme
        const themeBtn = document.querySelector('.theme-btn');

        themeBtn.addEventListener('click', ()=>{
            document.body.classList.toggle('dark-theme');

            themeBtn.querySelector('span:first-child').classList.toggle('active');

            
            themeBtn.querySelector('span:last-child').classList.toggle('active');
        })
    </script>
</body>
</html>
