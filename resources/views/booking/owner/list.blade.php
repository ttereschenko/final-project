@extends('layout')

@section('title', 'Booking Requests')

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="heading text-center">
                <h3 class="my-1">Booking my Property</h3>
            </div>
                @if($properties->isEmpty())
                    <p class="my-5">Any Booking Request wasn't found</p>
                @endif
            <div class="row row-cols-4 mt-3">
                @foreach($properties as $property)
                    @foreach($property->bookings as $booking)
                    <div class="col m-4 py-3 px-4 card shadow">
                        <p class="m-1">Guest: {{$booking->user->name}} {{$booking->user->surname}}</p>
                        <p class="m-1">Contacts: {{$booking->user->phone}}, {{$booking->user->email}}</p>
                        <p class="m-1">
                            Dates: {{$booking->check_in_date?->format('d M')}} - {{$booking->check_out_date?->format('d M Y')}}
                        </p>
                        <p class="m-1">Costs: ${{$booking->total_price}}</p>
                        <p class="mx-1 mb-2">Status: {{$booking->status}}</p>
                        <a class="m-1" href="{{route('property.show', ['property' => $booking->property->id])}}">Announcement</a>
                    </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
