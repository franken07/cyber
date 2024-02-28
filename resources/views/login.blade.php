<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="assets/logincss/loginn.css">
</head>
<body>
    <!-- Outer container with yellow background -->
    <div class="outer-container" style="background-color: yellow; padding: 20px; min-height: 100vh;">
        <!-- Original container now inside the outer container -->
        <div class="container" style="max-width: 500px; margin: auto; padding: 20px; background-color: white;">
            <div class="alerts mt-5">
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

            <form action="{{route('login.post')}}" method="POST" class="login-form">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-actions mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('index')}}" class="btn btn-link">Forgot Password?</a>
                    <a href="{{route('registration')}}" class="btn btn-secondary">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>