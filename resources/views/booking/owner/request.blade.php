@extends('layout')

@section('title', $booking->property->title)

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="heading text-center">
                <h3 class="m-4">Booking Confirmation</h3>
            </div>
            <div class="col-lg-6 mx-auto my-3">
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
                        <p>Total Price: ${{ $booking->total_price }}</p>
                        @can('confirm', $booking)
                            <form action="{{ route('booking.confirm', ['booking' => $booking->id]) }}" method="post">
                                @csrf
                                <button class="btn btn-dark fw-light w-100">Confirm</button>
                            </form>
                        @endcan
                        @can('cancel', $booking)
                            <form action="{{ route('booking.cancel', ['booking' => $booking->id]) }}" method="post">
                                @csrf
                                <button class="btn fw-light w-100 text-decoration-underline mt-2">Reject</button>
                            </form>
                        @endcan
                    </div>
                    <div class="col-lg-6">
                        @include('property.card', $property = $booking->property)
                    </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
