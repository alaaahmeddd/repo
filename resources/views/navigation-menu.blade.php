<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISISIA</title>
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="home/css/style.css" rel="stylesheet" />
    <link href="home/css/responsive.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .header_section {
            background-color: white;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .navbar {
            background-color: white;
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: black;
        }
        .nav-link {
            color: black;
        }
        .nav-link:hover {
            color: gray;
        }
        .input-group {
            width: 40%;
            max-width: 600px;
        }
        .nav-icon {
            font-size: 1.5rem;
            color: black;
            margin-left: 15px;
            margin-top: 5px;
        }
        .nav-item {
            display: flex;
            align-items: center;
        }
        .search-form {
            display: flex;
            align-items: center;
        }
        .search-icon {
            display: flex;
            align-items: center;
            padding: 0 10px;
            background-color: white;
            border-left: none;
        }
        .dropdown-menu .cart-detail img {
            max-width: 50px;
        }
        .dropdown-menu .cart-detail-product {
            padding-left: 10px;
        }
        .dropdown-menu .total-header-section {
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 10px;
        }
        .dropdown-menu .checkout {
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <!-- header section starts -->
    <header class="header_section">
        <div class="container">
            <nav x-data="{ open: false }" class="navbar navbar-expand-lg custom_nav-container bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('dashboard') }}">ISISIA</a>
                
                <!-- Toggle button for mobile view -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        @if (Route::has('login'))
                            @auth
                                @if (Auth::user()->role == 'admin')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('products_admin.index') }}">Products</a>
                                    </li>
                                    @php
                                        $notifications = auth()->user()->unreadNotifications;
                                    @endphp

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Notifications <span class="badge badge-light">{{ $notifications->count() }}</span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            @foreach($notifications as $notification)
                                                <a class="dropdown-item" href="{{ route('admin.orders') }}">
                                                    {{ $notification->data['message'] }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="/">Home</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Categories
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="categoriesDropdown">
                                            <a class="dropdown-item" href="#">Category 1</a>
                                            <a class="dropdown-item" href="#">Category 2</a>
                                            <a class="dropdown-item" href="#">Category 3</a>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                                    </li>
                                    <li class="nav-item">
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                                <input type="text" class="form-control" name="search" id="search" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1" autocomplete="on" onfocus="this.value=''">
                                            </div>
                                            <div id="search_list"></div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-icon">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="dropdown">
                                            <button id="dLabel" type="button" class="btn btn-dark btn-link nav-icon" data-bs-toggle="dropdown">
                                                <i class="fa fa-shopping-cart"></i><span class="badge">{{ count((array) session('cart')) }}</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel">
                                                <div class="row total-header-section">
                                                    @php $total = 0 @endphp
                                                    @foreach((array) session('cart') as $id => $details)
                                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                                    @endforeach
                                                    <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                                                        <p>Total: <span class="text-success">$ {{ $total }}</span></p>
                                                    </div>
                                                </div>
                                                @if(session('cart'))
                                                    @foreach(session('cart') as $id => $details)
                                                        <div class="row cart-detail">
                                                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                                <img src="{{ $details['photo'] }}" />
                                                            </div>
                                                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                                <p>{{ $details['product_name'] }}</p>
                                                                <span class="price text-success"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                                            </div>
                                                        </div

                                                    @endforeach
                                                @endif
                                                <div class="row">
                                                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                                        <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Teams Dropdown -->
                                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                        <div class="nav-item ms-3 relative">
                                            <x-dropdown align="right" width="60">
                                                <x-slot name="trigger">
                                                    <span class="inline-flex rounded-md">
                                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                            {{ Auth::user()->currentTeam->name }}
                                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </x-slot>
                                                <x-slot name="content">
                                                    <div class="w-60">
                                                        <!-- Team Management -->
                                                        <div class="block px-4 py-2 text-xs text-gray-400">{{ __('Manage Team') }}</div>
                                                        <!-- Team Settings -->
                                                        <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">{{ __('Team Settings') }}</x-dropdown-link>
                                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                            <x-dropdown-link href="{{ route('teams.create') }}">{{ __('Create New Team') }}</x-dropdown-link>
                                                        @endcan
                                                        <!-- Team Switcher -->
                                                        @if (Auth::user()->allTeams()->count() > 1)
                                                            <div class="border-t border-gray-200 dark:border-gray-600"></div>
                                                            <div class="block px-4 py-2 text-xs text-gray-400">{{ __('Switch Teams') }}</div>
                                                            @foreach (Auth::user()->allTeams() as $team)
                                                                <x-switchable-team :team="$team" />
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </x-slot>
                                            </x-dropdown>
                                        </div>
                                    @endif
                                    <!-- Settings Dropdown -->
                                    <div class="nav-item ms-3 relative">
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                                    </button>
                                                @else
                                                    <span class="inline-flex rounded-md">
                                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                            {{ Auth::user()->name }}
                                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                            </svg>
                                                        </button>
                                                    </span>
                                                @endif
                                            </x-slot>
                                            <x-slot name="content">
                                                <!-- Account Management -->
                                                <x-dropdown-link href="{{ route('profile.show') }}">{{ __('Profile') }}</x-dropdown-link>
                                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">{{ __('API Tokens') }}</x-dropdown-link>
                                                @endif
                                                <div class="border-t border-gray-200 dark:border-gray-600"></div>
                                                <!-- Authentication -->
                                                <form method="POST" action="{{ route('logout') }}" x-data>
                                                    @csrf
                                                    <x-responsive-nav-link href="{{ route('logout') }}"
                                                                @click.prevent="$root.submit();">
                                                        {{ __('Log Out') }}
                                                    </x-responsive-nav-link>
                                                </form>
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Log in</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- header section ends -->
    <!-- JavaScript and dependencies -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <script src="home/js/bootstrap.js"></script>
    <script src="home/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#search').on('keyup', function(){
                var query = $(this).val();
                $.ajax({
                    url: 'search',
                    type: 'GET',
                    date: {'search': query},
                    success:function(data){
                        $('#search_list').html(data)
                    }
                })
            })
        })
    </script>
</body>
</html>
