<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Checkout</h1>

    @if ($order->isEmpty())
        <p>No orders found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @php
                    $totalprice = 0;
                @endphp
                @foreach ($order as $order)
                    <tr>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->prod_name }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td><img src="{{ asset('storage/product/' . $order->image) }}" alt="{{ $order->prod_name }}"></td>
                        <td><form action="{{ route('remove_cart', $order->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove from Cart</button>
                        </form></td>
                    </tr>
                    @php
                        $totalprice += $order->price; // Add the price of each order to the total
                    @endphp
                @endforeach
                <div>
                 <h1>Total Price: {{ $totalprice }}</h1>
                 <form action="{{ route('checkoutprod') }}" method="post">
                    @csrf
                    <button type="submit">Proceed to Order (Cash on Delivery)</button>
                </form>
                </div>
            </tbody>
        </table>
    @endif
</body>
</html>