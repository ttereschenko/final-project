@extends('layout')

@section('title', 'Bookings')

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="heading text-center">
                <h3 class="m-4">My Bookings</h3>
            </div>
            @if($bookings->isEmpty())
                <p class="my-2"><a href="{{ route('property.list') }}" class="link-dark">Let's travel!</a></p>
            @endif
            <div class="row row-cols-4 mt-3">
                    @foreach($bookings as $booking)
                        <div class="col mb-4">
                            <p>
                                Dates: {{$booking->check_in_date?->format('d M')}} - {{$booking->check_out_date?->format('d M Y')}}
                            </p>
                            <p>Status: {{$booking->status}}</p>
                            @include('property.card', $property = $booking->property)
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
@endsection
