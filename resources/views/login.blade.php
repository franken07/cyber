<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ secure_asset('assets/logincss/loginn.css') }}">
</head>
<body>
<div class="logo-wrapper">
    <!-- Logo Image -->
        <img src="images/loko.png" alt="Logo" class="logo">
    </div>
<h1 class="title">LOGIN</h1>
<div class="container">
        <div class="mt-5">
            @if($errors->any())
                <div class="col-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
        </div>
        <form action="{{route('login.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('index')}}" class="btn btn-primary">Forgot Password?</a>
                <a href="{{route('registration')}}" class="btn btn-primary">Sign Up</a>
            </div>
        </form>
</div>    
</body>
</html>
