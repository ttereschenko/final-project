@extends('layout')

@section('title', 'Announcements')

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-9 pe-4">
                <div class="d-flex justify-content-between mb-4 mt-1">
                    <h3 class="my-1 heading">All Announcements</h3>
                    @owner
                    <a href="{{ route('property.create') }}" class="btn btn-dark fw-light py-2">
                        <i class="bi bi-plus-square me-3"></i>Add new</a>
                    @endowner
                </div>
                @if($properties->isEmpty())
                    <p>Any announcement wasn't found</p>
                @endif
                <div class="row row-cols-3 mt-3">
                    @foreach($properties as $property)
                        @include('property.card')
                    @endforeach
                </div>
            </div>
            <div class="col-3 border-start ps-4 pe-0">
                <form action="{{ route('property.list') }}">
                    <h6 class="mt-1">Please, tell us...</h6>
                    <div class="form-floating my-2">
                        <input type="text" class="form-control"
                               placeholder="Where do you want to go?" name="location"
                               value="{{ request()->get('location') }}">
                        <label class="text-muted" for="location">
                            <i class="bi bi-geo-alt me-2"></i>Where do you go?
                        </label>
                    </div>
                    <div class="input-group mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Check-in" name="check_in_date"
                                   value="{{ request()->get('check_in_date') }}">
                            <label class="text-muted" for="check_in_date">
                                <i class="bi bi-box-arrow-in-down-right me-2"></i>Check-in
                            </label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Check-out" name="check_out_date"
                                   value="{{ request()->get('check_out_date') }}">
                            <label class="text-muted" for="check_out_date">
                                <i class="bi bi-box-arrow-up-right me-2"></i>Check-out
                            </label>
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" placeholder="Guests" name="guests"
                               value="{{ request()->get('guests') }}">
                        <label class="text-muted" for="guests">
                            <i class="bi bi-people me-2"></i>How many guests?
                        </label>
                    </div>
                    <h6 class="my-2">Price range</h6>
                    <div class="input-group">
                        <div class="range-slider my-2">
                            <input type="range" id="min-price" name="min_price"
                                   value="{{ request()->get('min_price') ?? 0 }}" min="0" max="500">
                            <input type="range" id="max-price" name="max_price"
                                   value="{{ request()->get('max_price') ?? 500 }}" min="0" max="500">
                        </div>
                        <div class="mt-4">
                            <span id="min-value">$ {{ request()->get('min_price') ?? 0 }}</span>
                            -
                            <span id="max-value">$ {{ request()->get('max_price') ?? 500 }}</span>
                        </div>
                    </div>
                    <h6 class="my-2">Property Type</h6>
                    @foreach($types as $type)
                        <div class="form-check ps-1">
                            <input type="checkbox" name="types[]" value="{{ $type->id }}"
                                   @if(in_array($type->id, request()->get('types', []))) checked @endif>
                            {{ $type->name }}
                        </div>
                    @endforeach
                    <h6 class="my-2">Amenities</h6>
                    @foreach($amenities as $amenity)
                        <div class="form-check ps-1">
                            <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                                   @if(in_array($amenity->id, request()->get('amenities', []))) checked @endif>
                            {{ $amenity->name }}
                        </div>
                    @endforeach
                    <h6 class="my-2">Features</h6>
                    @foreach($facilities as $facility)
                        <div class="form-check ps-1">
                            <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                   @if(in_array($facility->id, request()->get('facilities', []))) checked @endif>
                            {{ $facility->name }}
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-dark fw-light mb-1 w-100 my-3">
                        <i class="bi bi-search me-2"></i>Search
                    </button>
                    <a class="link-dark" href="{{ route('property.list') }}">Clear Filters</a>
                </form>
            </div>
        </div>
    </div>
@endsection
