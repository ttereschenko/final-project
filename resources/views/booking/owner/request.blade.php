@extends('layout')

@section('title', $booking->property->title)

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="heading text-center">
                <h3 class="m-4">Booking Confirmation</h3>
            </div>
            <div class="col-6 mx-auto my-3">
                <div class="row justify-content-between">
                    <div class="col-6">
                        <p>Name: {{ $booking->user->name }}</p>
                        <p>Surname: {{ $booking->user->surname }}</p>
                        <p>Email: {{ $booking->user->email }}</p>
                        <p>Phone: {{ $booking->user->phone }}</p>
                        <p>
                            Dates: {{$booking->check_in_date?->format('d M')}} - {{$booking->check_out_date?->format('d M Y')}}
                        </p>
                        <p>Guests: {{ $booking->guests }}</p>
                        <form action="{{ route('booking.confirm', ['booking' => $booking->id]) }}" method="post">
                            @csrf
                            <button class="btn btn-dark fw-light w-100">Confirm</button>
                        </form>
                        <form action="{{ route('booking.cancel', ['booking' => $booking->id]) }}" method="post">
                            @csrf
                            <button class="btn fw-light w-100 text-decoration-underline mt-2">Reject</button>
                        </form>
                    </div>
                    <div class="col-6">
                        <a class="btn border py-2" href="{{ route('property.show', ['property' => $booking->property_id]) }}">
                        @foreach($booking->property->images as $image)
                        <img src="{{ asset($image->url) }}" class="d-block card-img-top" alt="apartment-photo" height="175px">
                        @endforeach
                        <div>
                            <h6 class="my-2">{{ $booking->property->country }}, {{ $booking->property->city }}</h6>
                            <p class="my-1">{{ $booking->property->type->name}}</p>
                            <p class="card-text">${{ $booking->property->price }} per night</p>
                        </div>
                        </a>
                    </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
