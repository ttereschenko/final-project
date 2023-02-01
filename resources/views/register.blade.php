@extends('layout')

@section('title', 'Register')

@section('content')
    <div class="container h-100">
        <div class="row">
            <div class="heading text-center">
                <h3 class="m-4">Create an Account</h3>
            </div>
            <div class="col-6 mx-auto">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="d-flex my-2">
                        <div class="form-floating me-2 w-50">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                   placeholder="Name" value="{{ old('name') }}">
                            <label class="text-muted" for="name">Name</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating w-50">
                            <input type="text" class="form-control @error('surname') is-invalid @enderror"
                                   name="surname" placeholder="Surname" value="{{ old('surname') }}">
                            <label class="text-muted" for="surname">Surname</label>
                            @error('surname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating my-2">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                               placeholder="Phone" value="{{ old('phone') }}">
                        <label class="text-muted" for="phone">Phone</label>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
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
                    <div class="form-floating my-2">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password_confirmation" placeholder="Confirm your password">
                        <label class="text-muted" for="password_confirmation">Confirm your password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-3 form-check form-switch my-4">
                        <input type="checkbox" name="agreement"
                               class="form-check-input @error('agreement') is-invalid @enderror">
                        I agree to the <a href="#" class="link-dark">Privacy Policy</a>
                        @error('agreement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="text-white bg-dark w-100 heading py-2">Create</button>
                    <p class="my-3">
                        <a class="link-dark" href="{{ route('login.form') }}">Already have an account?</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
