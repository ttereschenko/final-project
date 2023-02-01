@extends('layout')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4 mx-auto my-5">
                <div class="heading text-center">
                    <h3 class="m-4">Welcome back</h3>
                </div>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-floating my-2">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                               placeholder="Email" value="{{ old('email') }}">
                        <label class="text-muted" for="email">Email</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating my-2">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" placeholder="Password">
                        <label class="text-muted" for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="text-white bg-dark w-100 heading py-2 my-3">Sign in</button>
                    <p class="my-2">
                        <a class="link-dark" href="{{ route('register.form') }}">Don't have an account?</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection

