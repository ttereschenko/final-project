@extends('layout')

@section('title', 'Edit Feature')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mx-auto my-5">
                <h4 class="heading text-center my-4">edit feature</h4>
                <form action="{{ route('facility.edit', ['facility' => $facility->id]) }}" method="post">
                    @csrf
                    <div class="form-floating my-2">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                               placeholder="Name" value="{{ $facility->name }}">
                        <label class="text-muted" for="name">Name</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="text-white bg-dark heading py-2 my-3 w-100">Edit</button>
                    <button type="reset" class="btn btn-outline-dark fw-light w-100">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection
