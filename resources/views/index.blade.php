<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://getbootstrap.com.vn/examples/equal-height-columns/equal-height-columns.css" />
    <title>Online store</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Store</a>
            </li>
            @if(session()->has('LoggedUserId'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.profile') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.orders') }}">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.logout') }}">Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                </li>
            @endif
        </ul>
    </nav>
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ $product->name }}</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">{{ $product->price }}$</p>
                            <p class="card-text">Left {{ $product->quantity }}</p>
                            @if(session()->has('LoggedUserId'))
                                <form action="{{ route('create.order') }}" method="post">
                                    @csrf
                                    <input type="text" name="quantity" placeholder="quantity">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input class="btn btn-primary" type="submit" value="Order">
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>