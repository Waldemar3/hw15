@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form method="post" action="{{ route('login') }}">
                    @csrf

                    @error('username')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>

                    @enderror

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp">
                        <small id="usernameHelp" class="form-text text-muted">Not email.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
