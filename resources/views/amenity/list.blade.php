@extends('layout')

@section('title', 'Amenities')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end my-4">
            <div class="heading text-center col-10">
                <h4 class="my-1">All Amenities</h4>
            </div>
            <a href="{{ route('amenity.create') }}" class="btn btn-dark fw-light">
                <i class="bi bi-plus-square me-3"></i>Add New
            </a>
        </div>
        @if($amenities->isEmpty())
            <p>Any item wasn't found</p>
        @endif
        @if(!$amenities->isEmpty())
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($amenities as $amenity)
                    <tr>
                        <th scope="row">{{ $amenity->id }}</th>
                        <td>{{ $amenity->name }}</td>
                        <td>{{ $amenity->created_at?->format('Y/m/d') }}</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-sm btn-outline-secondary"
                                   href="{{ route('amenity.edit.form', ['amenity' => $amenity->id]) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('amenity.delete', ['amenity' => $amenity->id]) }}" method="post"
                                      class="btn btn-outline-secondary p-0">
                                    @csrf
                                    <button class="btn btn-sm"><i class="bi bi-trash3"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
