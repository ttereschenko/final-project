@extends('layout')

@section('title', 'Create Announcement')

@section('content')
    <div class="container">
        <h4 class="heading text-center my-4">add new announcement</h4>
        <form action="{{ route('property.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <h5 class="mt-4">Main Information</h5>
                    <div class="form-floating my-2">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                               placeholder="Title" value="{{ old('title') }}">
                        <label class="text-muted" for="title">Title</label>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <h5 class="mt-3">Address</h5>
                    <div class="row">
                        <div class="col-6">
                            <select name="country" class="form-select @error('country') is-invalid @enderror py-3"
                                    id="country-dropdown">
                                <option selected>Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 ps-0">
                            <select name="city" class="form-select @error('city') is-invalid @enderror py-3"
                                    id="city-dropdown">
                                <option selected>Select City</option>
                            </select>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="form-floating col-6">
                            <input class="form-control @error('address') is-invalid @enderror" name="address"
                                   type="text" placeholder="Address" value="{{ old('address') }}">
                            <label class="text-muted px-4" for="address">Street</label>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating col-6 ps-0">
                            <input type="text" class="form-control @error('house_number') is-invalid @enderror"
                                   name="house_number" placeholder="House Number" value="{{ old('house_number') }}">
                            <label class="text-muted px-3" for="city">House Number</label>
                            @error('house_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <h5 class="mt-3">Characteristics</h5>
                    <div class="row my-2">
                        <div class="col-6">
                            <select name="types" class="form-select @error('types') is-invalid @enderror py-3">
                                <option selected disabled>Select a Property Type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('types')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating col-6 ps-0">
                            <input type="text" class="form-control @error('rooms') is-invalid @enderror"
                                   name="rooms" placeholder="Rooms" value="{{ old('rooms') }}">
                            <label class="text-muted" for="rooms">Rooms</label>
                            @error('rooms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                </div>
                    <div class="row">
                        <div class="form-floating col-6">
                            <input type="text" class="form-control @error('beds') is-invalid @enderror" name="beds"
                                   placeholder="Beds" value="{{ old('beds') }}">
                            <label class="text-muted px-4" for="beds">Beds</label>
                            @error('beds')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating col-6 ps-0">
                            <input type="text" class="form-control @error('guests') is-invalid @enderror"
                                   name="guests" placeholder="Guests" value="{{ old('guests') }}">
                            <label class="text-muted px-3" for="guests">Guests</label>
                            @error('guests')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-floating my-2">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                  placeholder="Description">{{ old('description') }}</textarea>
                        <label class="text-muted" for="description">Description</label>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-5">
                    <h5 class="mt-4">Cost</h5>
                    <div class="row">
                        <div class="form-floating col-6">
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                   name="price" placeholder="Price" value="{{ old('price') }}">
                            <label class="text-muted px-4" for="title">Price per night</label>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating col-6 ps-0">
                            <input type="text" class="form-control @error('currency') is-invalid @enderror"
                                   name="currency" placeholder="Currency" value="{{ old('currency') }}">
                            <label class="text-muted px-3" for="currency">Currency</label>
                            @error('currency')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <h5 class="mt-3">Extra</h5>
                    <div class="form-group my-2">
                        <div class="form-control @error('amenities') is-invalid @enderror py-3">
                            <a class="link-secondary text-decoration-none btn-toggle dropdown-toggle"
                               data-bs-toggle="collapse" data-bs-target="#amenities-collapse">
                                Choose Amenities
                            </a>
                            <div class="collapse" id="amenities-collapse">
                                <ul class="btn-toggle-nav list-unstyled m-1">
                                    @foreach($amenities as $amenity)
                                        <li>
                                            <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                                                   class="form-check-input m-1 @error('amenities') is-invalid @enderror">
                                            {{ $amenity->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @error('amenities')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <div class="form-control @error('facilities') is-invalid @enderror py-3">
                            <a class="link-secondary text-decoration-none btn-toggle dropdown-toggle"
                               data-bs-toggle="collapse" data-bs-target="#facilities-collapse">
                                Choose Features
                            </a>
                            <div class="collapse" id="facilities-collapse">
                                <ul class="btn-toggle-nav list-unstyled m-1">
                                    @foreach($facilities as $facility)
                                        <li>
                                            <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                                   class="form-check-input m-1 @error('facilities') is-invalid @enderror">
                                            {{ $facility->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @error('facilities')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <h5 class="mt-4">Photos</h5>
                        <input type="file" class="form-control @error('images') is-invalid @enderror"
                               name="images[]" multiple>
                        @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-dark py-2 my-4 fw-light px-5">Create</button>
                </div>
            </div>
        </form>
    </div>
@endsection
