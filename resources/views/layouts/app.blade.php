<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <div class="messages fixed-top p-4">
            @include('flash::message')
        </div>
        <div class="container-fluid bg-dark border-bottom">
            <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            Выйти
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>


                </div>
            </nav>
        </div>

        <main class="container-fluid">
            <div class="row">
                <div class="col-lg-3 bg-dark">
                    <nav class=" bd-sidebar bg-dark nav-dark nav flex-column the-main-navbar">
                        @can('viewAny', \App\Filial::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('filials')}}">Филиалы</a>
                        </li>
                        @endcan
                        <hr>

                        @can('viewAny', \App\Order::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('orders')}}">Закупки</a>
                        </li>
                        @endcan

                        @can('viewAny', \App\Provider::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('providers')}}">Поставщики</a>
                        </li>
                        @endcan
                        @can('viewAny', \App\ProviderProducts::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('provider-products')}}">Товары поставщика</a>
                        </li>
                        @endcan
                        <hr>
                        @can('viewAny', \App\Product::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('products')}}">Продукты</a>
                        </li>
                        @endcan
                        @can('viewAny', \App\ProductGroup::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('groups')}}">Группы продуктов</a>
                        </li>
                        @endcan
                        <hr>
                        @can('viewAny', \App\User::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('users')}}">Пользователи</a>
                        </li>
                        @endcan
                        @can('viewAny', \App\Role::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('roles')}}">Роли</a>
                        </li>
                        @endcan
                        @can('viewAny', \App\Permission::class)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('permissions')}}">Операции</a>
                        </li>
                        @endcan
                    </nav>
                </div>
                <div class="container bg-white p-4 col-lg-9">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>
