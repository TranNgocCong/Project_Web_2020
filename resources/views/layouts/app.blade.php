<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title --}}
    <title>Vivu</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png"
        type="image/icon type">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"
        defer>
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{--
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
    <div id="app">
        <!-- Header section -->
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container ">

                <!-- Logo -->
                <a href="{{ url('/') }}" class="navbar-brand">
                    <img class="" src="{{ asset('img/vivu-text.png') }}" alt="InstaClone Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar5">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links -->
                <div class="navbar-collapse collapse justify-content-stretch" id="navbar5">

                    <form action="/search" method="POST" role="search" class="m-auto d-inline w-80">
                        @csrf
                        <div class="input-group">
                            <input class="form-control" name="q" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit"
                                style="border-color: #ced4da"><i class="fas fa-search"></i></button>
                        </div>
                    </form>

                    <ul class="navbar-nav">
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
                            <li class="nav-item px-2 {{ Route::is('post.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/') }}">
                                    <i class="fas fa-home fa-2x"></i>
                                </a>
                            </li>
                            <li class="nav-item px-2 {{ Route::is('post.explore') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/explore') }}">
                                    <i class="far fa-compass fa-2x"></i>
                                </a>
                            </li>
                            {{-- <li class="nav-item px-2 ">
                                <a class="nav-link" href="#">
                                    <i class="far fa-heart fa-2x"></i>
                                </a>
                            </li> --}}
                            <li class="nav-item dropdown no-arrow px-2">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="far fa-heart fa-2x " , id="click_fade"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter" id="count_noti">0</span>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="messagesDropdown" id="noti">
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>

                                    </a>
                                </div>
                            </li>
                            <li class="nav-item pl-2">
                                <a href="/profile/{{ Auth::user()->username }}" class="nav-link"
                                    style="width: 42px; height: 22px; padding-top: 6px;">
                                    <img src="{{ asset(Auth::user()->profile->image) }}" class="rounded-circle w-100">
                                    {{-- <i class="far fa-user fa-2x"></i>
                                    --}}
                                </a>
                            </li>

                            <!-- Add more dropdown in Profile Page -->
                            <!-- To get current routedd(Route::currentRouteName())  -->
                            {{-- @if (Route::is('profile.index')) --}}

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        @can('update', Auth::user()->profile)
                                            <a class="dropdown-item" href="/p/create" role="button">
                                                Add New Post
                                            </a>
                                        @endcan

                                        @can('update', Auth::user()->profile)
                                            <a class="dropdown-item" href="/stories/create" role="button">
                                                Add New Story
                                            </a>
                                        @endcan

                                        <a class="dropdown-item" href="{{ url('/albums') }}" role="button">My Album</a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                                document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                {{--
                            @endif --}}

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content section -->
        <div class="pt-3 mt-5">
            @yield('content')
        </div>

    </div>

    @yield('exscript')

</body>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var pusher = new Pusher('{{ env('
            PUSHER_APP_KEY ') }}', {
                encrypted: true,
                cluster: "ap1",
            });
        var channel = pusher.subscribe('my-channel1');
        let owner = "{{ Auth::user()->username }}";
        channel.bind('my-event1', function(data) {
            if (data.owner.username == owner) {
                var newNotificationHtml = `
        <a class="dropdown-item d-flex align-items-center" href="/p/` + data.cmtpost.id + `">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle w-100" src="` + data.img.image + `"
                                                alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">` + data.commenter.name + ` đã bình luận về bài viết của bạn </div>

                                        </div>
                                    </a>
        `;

                $('#noti').append(newNotificationHtml);
                let dem = $('#count_noti').text();
                let dem1 = parseInt(dem) + 1;
                $('#count_noti').text(dem1);
            }


        });
        $('#click_fade').click(function() {
            $('#count_noti').text(0);
        });
    });

</script>
<script>
    $('#click_fade').click(function() {
        $('#count_noti').text(0);
    });

</script>

</html>
