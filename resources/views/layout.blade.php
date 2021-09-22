<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ getenv('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}" />
    
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    
    @yield('styles')

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">{{ getenv('APP_NAME') }}</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('project.show') }}"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Projects</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTasksLink" data-bs-toggle="dropdown" role="button" aria-expanded="false">Tasks</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownTasksLink">
                            <li><a class="dropdown-item" href="{{ route('task.show') }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> All Tasks</a></li>
                            <li><a class="dropdown-item" href="{{ route('task.create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create new Task</a></li>
                        </ul>
                    </li>


                </ul>
                <!-- Right Side Of Navbar -->
                <div class="">
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>

    <section class="main-content">
    <div class="container">   
        
            @yield('content')
        
    </div>
    </section>

    <!--   FOOTER -->
    
    <div class="footer-bottom">

        <div class="container">
    
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                <div class="copyright">

                    &copy; {{ date('Y') }}

                </div>

            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right">

                <div class="design">

                    With thanks to <a target="_blank" href="http://juancadima.com">JC</a>

                </div>

            </div>

        </div>

    </div>
    

</body>

{{-- <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script> --}}

{{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script>     --}}
<script src="{{ asset('js/app.js') }}"></script>

<script src="{{asset('js/toastr.min.js') }}"></script>

<script src="{{ asset('js/sweetalert2.min.js') }}"></script>

<script>

@if ( Session::has('success') )
    toastr.success("{{ Session::get('success') }}")
@endif

@if ( Session::has('info') )
    toastr.info("{{ Session::get('info') }}")
@endif


@if ( Session::has('error') )
    toastr.error("{{ Session::get('error') }}")
@endif

</script>

@yield('scripts')


</html>