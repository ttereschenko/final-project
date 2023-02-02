<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@300;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/css/datepicker.min.css">
    @vite(['resources/css/style.css', 'resources/js/slider.js', 'resources/js/country-dropdown.js',
    'resources/js/pricerange.js', 'resources/js/datepicker.js',])
</head>
<body>
    <div class="bg-light">
        <header class="container">
            <nav class="navbar">
                <a class="navbar-brand" href="{{ route('main') }}">Rental Platform</a>
                <ul class="nav navbar-text nav-pills">
                    @guest
                        <li class="nav-item">
                            <form action="{{ route('owner.start') }}" method="post">
                                @csrf
                                <button class="btn btn-outline-dark fw-light">Rent out</button>
                            </form>
                        </li>
                    @endguest
                    <li class="nav-item"><a class="nav-link" href="{{ route('main') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('property.list') }}">All</a></li>
                    @if(auth()->check())
                        <li class="nav-item"><a class="nav-link" href="{{ route('wishlist') }}">Wishlist</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('booking.list') }}">My Bookings</a></li>
                    @endif
                    @admin
                        <li class="mb-1 nav-item">
                            <a class="nav-link btn-toggle dropdown-toggle" data-bs-toggle="collapse"
                               data-bs-target="#extras-collapse">
                                Extras
                            </a>
                            <div class="collapse" id="extras-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li>
                                        <a class="mx-3 link-dark d-inline-flex text-decoration-none rounded"
                                           href="{{ route('type.list') }}">
                                            Property Types
                                        </a>
                                    </li>
                                    <li>
                                        <a class="mx-3 link-dark d-inline-flex text-decoration-none rounded"
                                           href="{{ route('amenity.list') }}">
                                            Amenities
                                        </a>
                                    </li>
                                    <li>
                                        <a class="mx-3 link-dark d-inline-flex text-decoration-none rounded"
                                           href="{{ route('facility.list') }}">
                                            Features
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endadmin
                    @if(!auth()->check())
                        <li class="nav-item">
                            <a class="nav-link pt-1" href="{{ route('login.form') }}">
                                <i class="bi bi-person-circle fs-4"></i>
                            </a>
                        </li>
                    @endif
                    @owner
                        <li class="mb-1 nav-item">
                            <a class="nav-link btn-toggle dropdown-toggle" data-bs-toggle="collapse"
                               data-bs-target="#activity-collapse">
                                My Activity
                            </a>
                            <div class="collapse" id="activity-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li>
                                        <a class="mx-3 link-dark d-inline-flex text-decoration-none rounded"
                                           href="{{ route('owner.property.list') }}">
                                            Announcements
                                        </a>
                                    </li>
                                    <li>
                                        <a class="mx-3 link-dark d-inline-flex text-decoration-none rounded"
                                           href="{{ route('owner.booking.list') }}">
                                            Booking Requests
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endowner
                    @if(auth()->check())
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-link link-dark">
                                    <i class="bi bi-box-arrow-right fs-5"></i>
                                </button>
                            </form>
                        </li>
                    @endif
                </ul>
            </nav>
        </header>
</div>
    @include('flash-messages')
    @yield('content')
    <footer>
        <div class="container mt-5">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <span class="mb-3 text-muted">© 2023 Rental Platform</span>
                </div>
                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-instagram"></i></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-facebook"></i></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><i class="bi bi-twitter"></i></a></li>
                </ul>
            </footer>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.2.0/dist/js/datepicker-full.min.js"></script>
</body>
</html>
