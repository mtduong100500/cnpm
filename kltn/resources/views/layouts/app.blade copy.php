<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('fithnue.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hệ thống đăng ký khóa luận tốt nghiệp - Khoa Công nghệ thông tin - Trường Đại học Sư phạm Hà Nội</title>
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}" defer></script>
    <script src="{{ asset('js/removeUnicode.js') }}" defer></script>
    <!-- Fonts -->
    <!-- Styles -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div id="progress" class="waiting">
            <dt></dt>
            <dd></dd>
        </div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img height="68" src="{{ asset('fithnue.png') }}" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <!-- <ul class="navbar-nav mr-auto">
                    <li><a class="nav-link p-0" href="{{ route('home') }}">
                        
                    </a></li>
                    </ul> -->


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a></li>
                        <!-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li> -->
                        @else

                        @canany(['dvdt-list'])
                        <li><a class="nav-link" href="{{ route('users.index', ['role'=>3]) }}">DS Đơn vị dự thi</a></li>
                        @endcanany

                        @canany(['field-list', 'field-edit', 'field-create'])
                        <li><a class="nav-link" href="{{ route('fields.index') }}">DS Lĩnh vực</a></li>
                        @endcanany

                        @canany(['group-list', 'group-edit', 'group-create'])
                        <li><a class="nav-link" href="{{ route('groups.index') }}">Nhóm lĩnh vực</a></li>
                        @endcanany

                        @can('province-report')
                        <li><a class="nav-link" href="/reports">In ấn</a></li>
                        @endcan

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @canany(['province-list', 'province-edit', 'province-create'])
                                <a class="dropdown-item" href="{{ route('provinces.index') }}">DS Tỉnh</a>
                                @endcanany
                                @canany(['school-list', 'school-edit', 'school-create'])
                                <a class="dropdown-item" href="{{ route('schools.index') }}">DS Trường</a>
                                @endcanany
                                @canany(['user-list'])
                                <a class="dropdown-item" href="{{ route('users.index') }}">Quản lý tài khoản</a>
                                @endcanany
                                @canany(['topic-register'])
                                <a class="dropdown-item" href="{{url('topic-register-details')}}">Đề tài đã đăng ký</a>
                                @endcanany

                                <!--@canany(['role-list', 'role-edit', 'role-create'])-->
                                <!--<a class="dropdown-item" href="{{ route('roles.index') }}">Quản lý quyền</a>-->
                                <!--@endcanany-->
                                <!-- <hr/> -->
                                <a class="dropdown-item" href="/changePassword">Đổi mật khẩu</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Đăng xuất') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="pt-2">
            <div class="container bg-white pt-2 pb-1">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
</body>

</html>