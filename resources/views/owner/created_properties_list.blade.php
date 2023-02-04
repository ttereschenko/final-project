@extends('layout')

@section('title', 'My Announcements')

@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-end my-4">
            <div class="heading text-center col-lg-10">
                <h4 class="my-1">My Announcements</h4>
            </div>
            <a href="{{ route('property.create') }}" class="btn btn-dark fw-light">
                <i class="bi bi-plus-square me-3"></i>Add new</a>
        </div>
        @if($properties->isEmpty())
            <p>Any announcement wasn't found</p>
        @endif
        <div class="row row-cols-lg-4 mt-3">
            @foreach($properties as $property)
                @include('property.card')
            @endforeach
        </div>
    </div>
@endsection
