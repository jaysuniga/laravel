<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','jayzone')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body class="bg-body-tertiary">

    <div class="container-fluid  fixed-top bg-body-tertiary border-bottom">
      <div class="container">
        <nav class="navbar navbar-expand-lg">
          <div class="container-fluid">
            <a class="navbar-brand" href="#"><span class="great-vibes-regular"> Anniezone </span><b>Jewelry Shop</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <div class="container d-flex justify-content-center">
                <ul class="navbar-nav text-center">
                  <li class="nav-item px-2">
                    <a class="nav-link" aria-current="page" href="{{route('home')}}">Home</a>
                  </li>
                  <li class="nav-item px-2">
                    <a class="nav-link" href="{{route('shop')}}">Shop</a>
                  </li>
                  <li class="nav-item px-2">
                    <a class="nav-link" href="#">Gallery</a>
                  </li>
                  <li class="nav-item px-2">
                      <a class="nav-link" href="{{route('sellers.registerSeller')}}">Sell</a>
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-center px-2">
                @yield('cart')
                @auth
                  <a class="">
                    <form action="/logout" method="POST">
                      @csrf
                      <button class="btn btn-dark">Logout</button>
                    </form>
                  </a>
                @else
                  <a class="btn btn-secondary mx-2" href="{{route('login')}}">Login</a>
                  <a class="btn btn-outline-secondary" href="{{route('register')}}">Signup</a> 
                @endauth
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
    @yield('content')





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>