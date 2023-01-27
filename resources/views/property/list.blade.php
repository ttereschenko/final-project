@extends('layout')

@section('title', 'Announcements')

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-9 pe-4">
                <div class="d-flex justify-content-end my-4">
                    <div class="heading text-center col-10">
                        <h4 class="my-1">All Announcements</h4>
                    </div>
                    <a href="{{ route('property.create') }}" class="btn btn-dark fw-light">
                        <i class="bi bi-plus-square me-3"></i>Add new</a>
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
                    <h6 class="my-2">Please, tell us...</h6>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control"
                               placeholder="Where do you want to go?" name="location" value="{{ request()->get('location') }}">
                        <label class="text-muted" for="location"><i class="bi bi-geo-alt me-2"></i>Where do you go?</label>
                    </div>
                    <div class="input-group mb-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Check-in" name="check_in_date" value="{{ request()->get('check_in_date') }}">
                            <label class="text-muted" for="check_in_date"><i class="bi bi-box-arrow-in-down-right me-2"></i>Check-in</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Check-out" name="check_out_date" value="{{ request()->get('check_out_date') }}">
                            <label class="text-muted" for="check_out_date"><i class="bi bi-box-arrow-up-right me-2"></i>Check-out</label>
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" placeholder="Guests" name="guests" value="{{ request()->get('guests') }}">
                        <label class="text-muted" for="guests"><i class="bi bi-people me-2"></i>How many guests?</label>
                    </div>
                    <h6 class="my-2">Price range</h6>
{{--                    <div class="input-group">--}}
{{--                        <div class="range-slider">--}}
{{--                            <input type="range" class="min-price" name="min_price" value="{{ request()->get('min_price') ?? $properties->min('price') }}"--}}
{{--                                   min="{{ $properties->min('price') }}" max="{{ $properties->max('price') }}">--}}
{{--                            <input type="range" class="max-price" name="max_price" value="{{ request()->get('max_price') ?? $properties->max('price') }}"--}}
{{--                                   min="{{ $properties->min('price') }}" max="{{ $properties->max('price') }}">--}}
{{--                        </div>--}}
{{--                        <p id="min-value">$ {{$properties->min('price') }}</p> ---}}
{{--                        <p id="max-value">$ {{$properties->max('price') }}</p>--}}
{{--                    </div>--}}
                    <h6 class="my-2">Property Type</h6>
                    @foreach($types as $type)
                        <div class="form-check ps-1">
                            <input type="checkbox" name="types[]" value="{{ $type->id }}"
                                   @if(in_array($type->id, request()->get('types', []))) checked @endif> {{ $type->name }}
                        </div>
                    @endforeach
                    <h6 class="my-2">Amenities</h6>
                    @foreach($amenities as $amenity)
                        <div class="form-check ps-1">
                            <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                            @if(in_array($amenity->id, request()->get('amenities', []))) checked @endif> {{ $amenity->name }}
                        </div>
                    @endforeach
                    <h6 class="my-2">Features</h6>
                    @foreach($facilities as $facility)
                        <div class="form-check ps-1">
                            <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                   @if(in_array($facility->id, request()->get('facilities', []))) checked @endif> {{ $facility->name }}
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-dark fw-light mb-1 w-100"><i class="bi bi-search me-2"></i>Search</button>
                </form>
            </div>
        </div>
    </div>
@endsection
