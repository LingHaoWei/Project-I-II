<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    </head>
    <body>

      <style>

        .pageTopic{
          margin: 10px 0px 10px 0px;
        }

        .pageTopic a{
          text-decoration: none;
        }

        .currentPage{
          color: #71767a;
        }

        .logout a:hover{
          color: #d1d1d1;

        }

      </style>

<!--Nav bar-->

      <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a href="{{ url('adminHomePage') }}" class="navbar-brand">Inventory System</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="{{ url('adminHomePage') }}" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('viewOrder') }}" class="nav-link">Order</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Product
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('viewProduct') }}">Product</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('viewCategory') }}">Category</a>
                <a class="dropdown-item" href="{{ route('viewBrand') }}">Brand</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                More
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Customer</a>
                <a class="dropdown-item" href="{{ route('viewSupplier') }}">Supplier</a>
                <a class="dropdown-item" href="{{ route('purchaseOrder') }}">Purchase Order</a>
                <a class="dropdown-item" href="{{ route('showStaff') }}">Staff</a>
              </div>
            </li>
            <li class="nav-item">
              <div class="nav nav-item logout">
                  <a href="" class="nav-link" style="color:white;">Log out</a>
              </div>
            </li>
          </ul>
        </div>

      </nav>

<!--Nav bar-->

@yield('content')


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
