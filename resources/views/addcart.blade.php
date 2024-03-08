<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout</title>
<link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets/parallax/jarallax.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/animatecss/animate.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/addtocartcss/addtocart.css">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/additional.css"><link rel="stylesheet" href="assets/mobirise/css/additional.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css">
</head>
<body>
<!-- Include header -->
@include('include.header')
<div class="center-content">
    <strong>CART</strong>
</div>

@if ($order->isEmpty())
    <p>No orders found.</p>
@else
    <form id="checkout-form" action="{{ route('checkoutprod') }}" method="post">
        @csrf
        <table>
            <thead>
                <tr>
                    <th>Select</th> <!-- Add this column -->
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @php
                $totalprice = 0;
            @endphp
            @foreach ($order as $order)
                <tr>
                    <td><input type="checkbox" name="order_ids[]" value="{{ $order->id }}"></td>
                    <td><img src="{{ asset('storage/product/' . $order->image) }}" alt="{{ $order->prod_name }}" class="cart-product-image"></td>
                    <td>{{ $order->prod_name }}</td>
                    <td class="price">{{ $order->price }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>
                        <form action="{{ route('remove_cart', $order->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove from Cart</button>
                        </form>
                    </td>
                </tr>
                @php
                    $totalprice += $order->price * $order->quantity;
                @endphp
            @endforeach
            </tbody> 
        </table>
        @include('include.checkout')
    </form>
@endif

<!-- Add your JavaScript code here -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('check-all').addEventListener('change', function(event) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name="order_ids[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = event.target.checked;
            });
            recalculateTotalPrice(); // Recalculate total price after checking/unchecking all checkboxes
        });

        document.getElementById('proceed-to-order-btn').addEventListener('click', function(event) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name="order_ids[]"]');
            var atLeastOneChecked = false;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    atLeastOneChecked = true;
                }
            });
            if (!atLeastOneChecked) {
                alert("Please select at least one product to proceed.");
                event.preventDefault();
            }
        });

        function recalculateTotalPrice() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name="order_ids[]"]');
            var totalprice = 0;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var priceElement = checkbox.closest('tr').querySelector('.price');
                    totalprice += parseFloat(priceElement.textContent);
                }
            });
            document.getElementById('total-price').textContent = totalprice.toFixed(2);
        }

        var checkboxes = document.querySelectorAll('input[type="checkbox"][name="order_ids[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                recalculateTotalPrice();
            });
        });

        recalculateTotalPrice();
    });
    
</script>
<script src="assets/parallax/jarallax.js"></script>
  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="assets/scrollgallery/scroll-gallery.js"></script>
  <script src="assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/ytplayer/index.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
<!-- Include your JavaScript and library files here -->
</body>
</html>
