<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .success-message {
            color: #28a745;
            margin-top: 10px;
        }
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
            <input type="text" id="phone" name="phone" value="{{ $checkouts->phone }}" required>
            @error('phone')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="{{ $checkouts->address }}" required>
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
                            <td>{{ $checkout->prod_name }}</td>
                            <td>{{ $checkout->price }}</td>
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
