<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ secure_asset('assets/logincss/loginn.css') }}">
</head>
<body>

<div class="login-wrapper">
    <div class="logo-wrapper">
        <img src="images/loko.png" alt="Logo" class="logo">
    </div>
    <h1 class="title">Login</h1>
    <div class="form-container">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif

        <form action="{{route('login.post')}}" method="POST" class="login-form">
            @csrf
            <div class="form-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">Login</button>
                <a href="{{route('index')}}" class="btn-link">Forgot Password?</a>
                <a href="{{route('registration')}}" class="btn-link">Sign Up</a>
            </div>
        </form>
    </div>
</div>    

</body>
</html>