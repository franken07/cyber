<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ secure_asset('assets/web/assets/mobirise-icons2/mobirise2.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/parallax/jarallax.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/socicon/css/styles.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/animatecss/animate.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/addtocartcss/addtocart.css') }}">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap"></noscript>
    <link rel="preload" as="style" href="{{ secure_asset('assets/mobirise/css/additional.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/mobirise/css/additional.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css">
    
    @include('include.header')
</head>
<body style="background-image: url('{{ asset('images/bg.jpg') }}');">
    <h1>CART</h1>
        <form action="{{ route('checkoutprod') }}" method="POST">
            @csrf
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td><input type="checkbox" name="order_ids[]" value="{{ $order->id }}" class="order-checkbox"></td>
                        <td><img src="{{ asset('storage/product/' . $order->image) }}" alt="{{ $order->prod_name }}"></td>
                        <td>{{ $order->prod_name }}</td>
                        <td>${{ $order->price }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>
                            <form action="{{ route('remove_cart', $order->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="remove-button">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="checkout-container">
                <div>
                     <label>Total Price:</label> <span id="total-price">₱0.00</span>
                </div>
                <button type="submit" class="checkout-button">Checkout Selected</button>
            </div>
            <div>
            <input type="checkbox" id="check-all"> <label for="check-all">Check All</label>
            </div>
        </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAllCheckbox = document.getElementById('check-all');
            const orderCheckboxes = document.querySelectorAll('.order-checkbox');
            const totalPriceSpan = document.getElementById('total-price');

            checkAllCheckbox.addEventListener('change', function() {
                orderCheckboxes.forEach(checkbox => {
                    checkbox.checked = checkAllCheckbox.checked;
                });
                calculateTotalPrice();
            });

            orderCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    calculateTotalPrice();
                });
            });

            function calculateTotalPrice() {
                let totalPrice = 0;
                orderCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const priceText = checkbox.parentElement.parentElement.querySelector('td:nth-child(4)').textContent;
                        const price = parseFloat(priceText.slice(1));
                        totalPrice += price;
                    }
                });
                totalPriceSpan.textContent = `$${totalPrice.toFixed(2)}`;
            }
        });
    </script>
</body>
</html>
