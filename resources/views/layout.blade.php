<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@300;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    @viteReactRefresh
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body>
    <div class="bg-light">
    <header class="container">
        <nav class="navbar">
            <a class="navbar-brand" href="{{ route('main') }}">Rental Platform</a>
            <ul class="nav navbar-text">
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
                        <a class="nav-link btn-toggle dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#extras-collapse">
                            Extras
                        </a>
                        <div class="collapse" id="extras-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('type.list') }}" class="mx-3 link-dark d-inline-flex text-decoration-none rounded">Property Types</a></li>
                                <li><a href="{{ route('amenity.list') }}" class="mx-3 link-dark d-inline-flex text-decoration-none rounded">Amenities</a></li>
                                <li><a href="{{ route('facility.list') }}" class="mx-3 link-dark d-inline-flex text-decoration-none rounded">Features</a></li>
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
                        <a class="nav-link btn-toggle dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#activity-collapse">
                            My Activity
                        </a>
                        <div class="collapse" id="activity-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="{{ route('owner.property.list') }}" class="mx-3 link-dark d-inline-flex text-decoration-none rounded">Announcements</a></li>
                                <li><a href="{{ route('owner.booking.list') }}" class="mx-3 link-dark d-inline-flex text-decoration-none rounded">Booking Requests</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
