<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Information</title>
    <style>
        /* CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Billing Information</h2>
        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif
        <form action="{{ route('billing.update') }}" method="POST">
            @csrf
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" required>
            @error('address')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <!-- Display checkout items -->
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($checkouts as $checkout)
                        <tr>
                            <td><img src="{{ asset('storage/product/' . $checkout->image) }}" alt="{{ $checkout->prod_name }}">></td>
                            <td>{{ $checkout->product->name }}</td>
                            <td>{{ $checkout->product->price }}</td>
                            <td>{{ $checkout->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit">BUY</button>
        </form>
    </div>
</body>
</html>
