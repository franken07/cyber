<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="assets/registration.css">
</head>
<body>
    <div class="form-container">
        <form action="{{route('registrationpost')}}" method="POST" class="registration-form">
            <h2>Sign Up</h2>
            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirmPassword" required>
            </div>
            <div class="input-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone">
            </div>
            <div class="input-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address">
            </div>
            <button type="submit">Sign Up</button>
            <p>Already have an account?<a href="/sign-in">Sign In</a></p>
        </form>
    </div>
</body>
</html>
