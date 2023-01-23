@extends('layout')

@section('title', 'Edit Announcement')

@section('content')
    <div class="container">
        <div class="row">
            <h4 class="heading text-center my-4">edit the announcement</h4>
            @foreach($property->images as $image)
                <div class="w-25 card shadow-sm pt-2 mx-2">
                    <img src="{{ asset($image->url) }}" class="card-img my-1" alt="card-img">
                    <form action="{{ route('image.delete', ['image' => $image->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-outline-secondary btn-sm w-100 my-2">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </form>
                </div>
            @endforeach
            <form action="{{ route('property.edit', ['property' => $property->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-7">
                        <h5 class="mt-4">Main Information</h5>
                        <div class="form-floating my-2">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                   placeholder="Title" value="{{ $property->title }}">
                            <label class="text-muted" for="title">Title</label>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <h5 class="mt-3">Address</h5>
                        <div class="row">
                            <div class="form-floating col-6">
                                <input type="text" class="form-control @error('country') is-invalid @enderror" name="country"
                                       placeholder="Country" value="{{ $property->country }}">
                                <label class="text-muted px-4" for="country">Country</label>
                                @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating col-6 ps-0">
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                                       placeholder="City" value="{{ $property->city }}">
                                <label class="text-muted px-3" for="city">City</label>
                                @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="form-floating col-6">
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                                       placeholder="Address" value="{{ $property->address }}">
                                <label class="text-muted px-4" for="address">Street</label>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating col-6 ps-0">
                                <input type="text" class="form-control @error('house_number') is-invalid @enderror" name="house_number"
                                       placeholder="House Number" value="{{ $property->house_number }}">
                                <label class="text-muted px-3" for="city">House Number</label>
                                @error('house_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <h5 class="mt-3">Characteristics</h5>
                        <div class="row my-2">
                            <div class="form-group col-6">
                                <div class="form-control @error('types') is-invalid @enderror py-3">
                                    <a class="link-secondary text-decoration-none btn-toggle dropdown-toggle" data-bs-toggle="collapse"
                                       data-bs-target="#types-collapse">
                                        Choose a Property Type
                                    </a>
                                    <div class="collapse" id="types-collapse">
                                        <ul class="btn-toggle-nav list-unstyled m-1">
                                            @foreach($types as $type)
                                                <li>
                                                    <input type="radio" name="types" value="{{ $type->id }}"
                                                           class="form-check-input m-1 @error('types') is-invalid @enderror "
                                                           @if($property->type_id) checked @endif>
                                                    {{ $type->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @error('types')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating col-6 ps-0">
                                <input type="text" class="form-control @error('rooms') is-invalid @enderror" name="rooms"
                                       placeholder="Rooms" value="{{ $property->rooms }}">
                                <label class="text-muted" for="rooms">Rooms</label>
                                @error('rooms')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-floating col-6">
                                <input type="text" class="form-control @error('beds') is-invalid @enderror" name="beds"
                                       placeholder="Beds" value="{{ $property->beds }}">
                                <label class="text-muted px-4" for="beds">Beds</label>
                                @error('beds')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating col-6 ps-0">
                                <input type="text" class="form-control @error('guests') is-invalid @enderror" name="guests"
                                       placeholder="Guests" value="{{ $property->guests }}">
                                <label class="text-muted px-3" for="guests">Guests</label>
                                @error('guests')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-floating my-2">
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                      placeholder="Description">{{ $property->description }}</textarea>
                            <label class="text-muted" for="description">Description</label>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <h5 class="mt-4">Cost</h5>
                        <div class="row">
                            <div class="form-floating col-6">
                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                                       placeholder="Price" value="{{ $property->price }}">
                                <label class="text-muted px-4" for="title">Price per night</label>
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating col-6 ps-0">
                                <input type="text" class="form-control @error('currency') is-invalid @enderror" name="currency"
                                       placeholder="Currency" value="{{ $property->currency }}">
                                <label class="text-muted px-3" for="currency">Currency</label>
                                @error('currency')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <h5 class="mt-3">Extra</h5>
                        <div class="form-group my-2">
                            <div class="form-control @error('amenities') is-invalid @enderror py-3">
                                <a class="link-secondary text-decoration-none btn-toggle dropdown-toggle" data-bs-toggle="collapse"
                                   data-bs-target="#amenities-collapse">
                                    Choose Amenities
                                </a>
                                <div class="collapse" id="amenities-collapse">
                                    <ul class="btn-toggle-nav list-unstyled m-1">
                                        @foreach($amenities as $amenity)
                                            <li>
                                                <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                                                       class="form-check-input m-1 @error('amenities') is-invalid @enderror"
                                                       @if($property->amenities->contains('id',$amenity->id)) checked @endif>
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
                                <a class="link-secondary text-decoration-none btn-toggle dropdown-toggle" data-bs-toggle="collapse"
                                   data-bs-target="#facilities-collapse">
                                    Choose Features
                                </a>
                                <div class="collapse" id="facilities-collapse">
                                    <ul class="btn-toggle-nav list-unstyled m-1">
                                        @foreach($facilities as $facility)
                                            <li>
                                                <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                                       class="form-check-input m-1 @error('facilities') is-invalid @enderror"
                                                       @if($property->facilities->contains('id',$facility->id)) checked @endif>
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
                            <h5 class="mt-4">Add new Photos</h5>
                            <input type="file" class="form-control @error('images') is-invalid @enderror" name="images[]"
                                   multiple>
                            @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-dark heading py-2 w-50 my-4">Edit</button>
                            <button type="reset" class="btn btn-outline-dark fw-light w-50">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
