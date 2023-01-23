@extends('layout')

@section('title', 'Wishlist')

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="heading text-center">
                <h3 class="m-4">Wishlist</h3>
            </div>
            @if($favourites->isEmpty())
                <p class="my-2">Add some <a href="{{ route('property.list') }}" class="link-dark">announcements</a> to your Wishlist</p>
            @endif
            <div class="row row-cols-4 mt-3">
                    @foreach($favourites as $favourite)
                        @include('property.card', $property = $favourite->property)
                    @endforeach
                </div>
        </div>
    </div>
@endsection
