@extends('layout')

@section('title', $property->title)

@section('content')
    <script>
        window.disabled_dates = {!! json_encode($disabled) !!};
    </script>
    <div class="container my-4">
        <div class="row">
            <h3 class="heading col-10">{{ $property->title }}</h3>
            <div class="col-2 d-flex justify-content-end">
            @favourite($property)
                @can('deleteFavourite', $property)
                    <form action="{{ route('wishlist.delete', ['property' => $property->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-sm border-bottom px-2 me-1">
                            <i class="bi bi-heart-fill wishlistActive me-2"></i>Saved
                        </button>
                    </form>
                @endcan
            @endfavourite
            @notFavourite($property)
                @can('addFavourite', $property)
                    <form action="{{ route('wishlist.add', ['property' => $property->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-sm border-bottom px-2 me-1">
                            <i class="bi bi-heart me-2"></i>Save
                        </button>
                    </form>
                @endcan
            @endnotFavourite
            @can('edit', $property)
                <a href="{{ route('property.edit.form', ['property' => $property->id]) }}"
                   class="btn btn-dark fw-light mb-1 px-5">
                    <i class="bi bi-pencil-square me-2"></i>Edit
                </a>
            @endcan
        </div>
        </div>
        <p class="text-muted">Location: {{ $property->country->name }}, {{ $property->city->name }}</p>
        <div class="row d-flex justify-content-between">
        <div class="my-3 col-8">
            <section id="main-slider" class="splide gallery" aria-label="My Awesome Gallery">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($property->images as $image)
                            <li class="splide__slide w-100">
                                <img src="{{ asset($image->url) }}" class="img-fluid">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
        @can('reserve', $property)
            <div class="col-4 card my-3 py-2 shadow">
                <h5 class="heading text-center my-4">book this apartment</h5>
                <form action="{{ route('booking.create', ['property' => $property->id]) }}" method="post">
                    @csrf
                    <div class="input-group my-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('check_in_date') is-invalid @enderror"
                                   placeholder="Check-in" name="check_in_date" id="start">
                            <label class="text-muted" for="check_in_date">
                                <i class="bi bi-box-arrow-in-down-right me-2"></i>Check-in
                            </label>
                            @error('check_in_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control @error('check_out_date') is-invalid @enderror"
                                   placeholder="Check-out" name="check_out_date" id="end">
                            <label class="text-muted" for="check_out_date">
                                <i class="bi bi-box-arrow-up-right me-2"></i>Check-out
                            </label>
                            @error('check_out_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control @error('guests') is-invalid @enderror"
                               placeholder="Guests" name="guests">
                        <label class="text-muted" for="guests"><i class="bi bi-people me-2"></i>Guests</label>
                        @error('guests')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <p class="mt-3 mb-2" id="price">Night: ${{ $property->price }}</p>
                    <p class="mt-3 mb-2">Service fee: $10</p>
                    <button type="submit" class="btn btn-dark fw-light mt-3 py-2 w-100">Reserve</button>
                    <button class="btn fw-light w-100 text-decoration-underline my-2" type="reset">Clean</button>
                </form>
            </div>
            @endcan
        <div class="row">
            <p>{{ $property->type->name }} | Owner: {{ $property->user->name }}</p>
            <p>{{ $property->guests }} guests | {{ $property->rooms }} rooms | {{ $property->beds }} beds</p>
            <p>{{ $property->description }}</p>
            <div class="my-3">
                @if(!$property->amenities->isEmpty())
                    <h6>Amenities</h6>
                    @foreach($property->amenities as $amenity)
                        <span>{{ $amenity->name }} | </span>
                    @endforeach
                @endif
            </div>
            <div>
                @if(!$property->facilities->isEmpty())
                    <h6>Features</h6>
                    @foreach($property->facilities as $facility)
                        <span>{{ $facility->name }} | </span>
                    @endforeach
                @endif
            </div>
            <small class="text-muted pt-2 my-2">{{ $property->created_at?->format('d M Y') }}</small>
        </div>
    </div>
@endsection
