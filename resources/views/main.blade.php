@extends('layout')

@section('title', 'Main')

@section('content')
    <div class="main-form img-fluid p-5">
        <div class="container my-5">
            <div class="pt-5">
                <h2 class="heading text-white text-center pt-5">Let's find your dream apartment</h2>
            </div>
            <div class="row my-4">
                <form action="{{ route('property.list') }}" class="d-flex justify-content-center mb-5">
                    <div class="form-floating m-2 col-3">
                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                               placeholder="Where do you want to go?" name="location">
                        <label class="text-muted" for="location"><i class="bi bi-geo-alt me-2"></i>Where do you want to go?</label>
                        @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div id="datePicker" class="input-group w-25 m-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Check-in" name="check_in_date">
                            <label class="text-muted" for="check_in_date"><i class="bi bi-box-arrow-in-down-right me-2"></i>Check-in</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Check-out" name="check_out_date">
                            <label class="text-muted" for="check_out_date"><i class="bi bi-box-arrow-up-right me-2"></i>Check-out</label>
                        </div>
                    </div>
                    <div class="form-floating m-2 col-2">
                        <input type="text" class="form-control" placeholder="Guests" name="guests">
                        <label class="text-muted" for="guests"><i class="bi bi-people me-2"></i>Guests</label>
                    </div>
                    <div class="m-2">
                        <button type="submit" class="btn btn-dark fw-light py-3 px-4"><i class="bi bi-search me-2"></i>Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container my-4">
        <h4 class="mt-5 heading text-center">Recent announcements</h4>
        <div class="row row-cols-4 mt-5">
            @foreach($properties as $property)
                @include('property.card')
            @endforeach
            {{ $properties->links() }}
        </div>
    </div>
@endsection
