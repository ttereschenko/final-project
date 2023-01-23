<div class="col mb-4">
    <div class="card shadow-sm">
{{--        TODO: IMG-SLIDER--}}
        <div id="carousel">
        @foreach($property->images as $image)
            <img src="{{ asset($image->url) }}" class="d-block card-img-top" alt="apartment-photo" height="175px">
        @endforeach
        </div>
        <div class="card-body">
            <h6 class="my-0">{{ $property->country }}, {{ $property->city }}</h6>
            <p class="my-1">{{ $property->type->name}}</p>
            <p class="card-text">${{ $property->price }} per night</p>
            <div class="d-flex justify-content-between">
                <div class="btn-group">
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('property.show', ['property' => $property->id]) }}">View</a>
                    @can('edit', $property)
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('property.edit.form', ['property' => $property->id]) }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    @endcan
                    @can('delete', $property)
                        <form action="{{ route('property.delete', ['property' => $property->id]) }}" method="post"
                              class="btn btn-outline-secondary p-0">
                            @csrf
                            <button class="btn btn-sm">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    @endcan
                </div>
                <small class="text-muted pt-2">{{ $property->created_at?->format('d M Y') }}</small>
            </div>
            @can('addToWishlist', $property)
{{--                TODO: WISHLIST BTN (ADD/DELETE) --}}
                <div id="wishlist"></div>
            <form action="{{ route('wishlist.add', ['property' => $property->id]) }}" method="post">
                @csrf
                <button class="btn btn-sm addToWishlist">
                    <i class="bi bi-heart"></i>ADD
                </button>
            </form>
            @endcan
            @can('deleteFromWishlist', $property)
            <form action="{{ route('wishlist.delete', ['property' => $property->id]) }}" method="post">
                @csrf
                <button class="btn btn-sm deleteFromWishlist">
                    <i class="bi bi-heart-fill"></i>DELETE
                </button>
            </form>
            @endcan
        </div>
    </div>
</div>
