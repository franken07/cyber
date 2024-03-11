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
<link rel="preload" as="style" href="{{ secure_asset('assets/mobirise/css/additional.css') }}"><link rel="stylesheet" href="{{ secure_asset('assets/mobirise/css/additional.css') }}" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css">

<style>
        .order-row {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .order-details {
            flex: 1;
            display: flex;
            align-items: center;
        }
        .order-image {
            max-width: 100px;
            max-height: 100px;
            margin-right: 10px;
        }
        .remove-form {
            margin-left: auto;
        }
        .remove-form button {
            background-color: #ff6666;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .remove-form button:hover {
            background-color: #ff4d4d;
        }
    </style>
</head>
<body>
    <h1>Checkout Orders</h1>
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <input type="checkbox" id="check-all"> <label for="check-all">Check All</label>
        <div class="order-list">
            @foreach($orders as $order)
            <div class="order-row">
                <div class="order-details">
                    <input type="checkbox" name="order_ids[]" value="{{ $order->id }}" class="order-checkbox">
                    <img src="{{ $order->image }}" alt="{{ $order->prod_name }}" class="order-image">
                    <label>{{ $order->name }} - {{ $order->prod_name }} - ${{ $order->price }}</label>
                </div>
                <form action="{{ route('remove.cart', $order->id) }}" method="POST" class="remove-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Remove</button>
                </form>
            </div>
            @endforeach
        </div>
        <div>
            <label>Total Price:</label> <span id="total-price">$0.00</span>
        </div>
        <button type="submit">Checkout</button>
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
                        const price = parseFloat(checkbox.parentElement.querySelector('label').textContent.split('-')[1].trim().slice(1));
                        totalPrice += price;
                    }
                });
                totalPriceSpan.textContent = `$${totalPrice.toFixed(2)}`;
            }
        });
    </script>
</body>
</html>
