@extends('layouts.app')

@section('content')
<!-- /resources/views/auth/login.blade.php  -->
<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="mb-3{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="form-label">E-Mail Address</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="form-label">Password</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="col-md-12">
	                            <!--
                                <div class="checkbox">
                                    <label class="form-label">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                                -->
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="col-md-12 text-right">
	                            
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
								<!--
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                                -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
