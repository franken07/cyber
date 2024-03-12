<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Information</title>
    <link rel="stylesheet" href="{{ secure_asset('assets/web/assets/mobirise-icons2/mobirise2.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/parallax/jarallax.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/socicon/css/styles.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/animatecss/animate.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/billingcss/billing.css') }}">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap"></noscript>
    <link rel="preload" as="style" href="{{ secure_asset('assets/mobirise/css/additional.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/mobirise/css/additional.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css">
    
</head>
<body>
<h1>Billing Information</h1>
    <div>
        <h2>Checkout Details:</h2>
        @if($checkout->count() > 0)
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
                    @foreach($checkout as $item)
                        <tr>
                            <td><img src="{{ $item->image }}" alt="{{ $item->name }}" width="100"></td>
                            <td>{{ $item->prod_name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No items found in checkout.</p>
        @endif
    </div>

    <hr>

    <div>
        <h2>Edit Billing Information:</h2>
        @if($checkout->isNotEmpty())
            <form method="POST" action="{{ route('billing.buy') }}">
                @csrf
                @method('PUT')
                <div>
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') ?? $checkout->first()->phone }}">
                </div>

                <div>
                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address" value="{{ old('address') ?? $checkout->first()->address }}">
                </div>

                <div>
                    <button type="submit">Update Billing Information</button>
                </div>
            </form>
        @else
            <p>No billing information found.</p>
        @endif
    </div>
</body>
</html>