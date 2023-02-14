<div class="col-lg mb-4">
    <div class="card shadow-sm">
        <section id="image-carousel" class="splide" aria-label="apartment-photo">
            <div class="splide__track">
                <ul class="splide__list list-unstyled">
                    @foreach($property->images as $image)
                        <li class="splide__slide">
                            <img src="{{ asset($image->url) }}" class="d-block card-img-top" alt="apartment-photo">
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <div class="card-body">
            <h6 class="my-0">{{ $property->country->name }}, {{ $property->city->name }}</h6>
            <p class="my-0">{{ $property->type->name}}</p>
            <p class="card-text mb-2">${{ $property->price }} night</p>
            <div class="d-flex justify-content-between">
                <div class="btn-group">
                    <a class="btn btn-sm btn-outline-secondary"
                       href="{{ route('property.show', ['property' => $property->id]) }}">
                        View
                    </a>
                    @can('edit', $property)
                        <a class="btn btn-sm btn-outline-secondary"
                           href="{{ route('property.edit.form', ['property' => $property->id]) }}">
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
                <div>
                    @notFavourite($property)
                    @can('addFavourite', $property)
                        <form action="{{ route('wishlist.add', ['property' => $property->id]) }}" method="post">
                            @csrf
                            <button class="btn p-0"><i class="bi bi-heart"></i></button>
                        </form>
                    @endcan
                    @endnotFavourite
                    @favourite($property)
                    @can('deleteFavourite', $property)
                        <form action="{{ route('wishlist.delete', ['property' => $property->id]) }}" method="post">
                            @csrf
                            <button class="btn p-0"><i class="bi bi-heart-fill wishlistActive"></i></button>
                        </form>
                    @endcan
                    @endfavourite
                </div>
            </div>
        </div>
    </div>
</div>
