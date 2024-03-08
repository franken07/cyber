<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your existing head content here -->

    <!-- Your existing script includes here -->
</head>
<body>
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
                @foreach ($order as $orderItem)
                    <tr>
                        <td><input type="checkbox" name="order_ids[]" value="{{ $orderItem->id }}"></td>
                        <td><img src="{{ asset('storage/product/' . $orderItem->image) }}" alt="{{ $orderItem->prod_name }}" class="cart-product-image"></td>
                        <td>{{ $orderItem->prod_name }}</td>
                        <td class="price">{{ $orderItem->price }}</td>
                        <td>{{ $orderItem->quantity }}</td>
                        <td>
                            <form action="{{ route('remove_cart', $orderItem->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remove from Cart</button>
                            </form>
                        </td>
                    </tr>
                    @php
                        $totalprice += $orderItem->price; 
                    @endphp
                @endforeach
                </tbody> 
            </table>
            @include('include.checkout')
            <div>Total Price: $<span id="total-price">{{ $totalprice }}</span></div> <!-- Display total price -->
        </form>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to check/uncheck all checkboxes
            document.getElementById('check-all').addEventListener('change', function() {
                var checkboxes = document.querySelectorAll('input[type="checkbox"][name="order_ids[]"]');
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = event.target.checked;
                });
            });

            // Function to handle 'CHECK OUT ALL' button click
            document.getElementById('proceed-to-order-btn-all').addEventListener('click', function() {
                // Ensure all checkboxes are checked before submitting the form
                var checkboxes = document.querySelectorAll('input[type="checkbox"][name="order_ids[]"]');
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = true;
                });
            });

            // Function to recalculate total price when checkboxes are changed
            function recalculateTotalPrice() {
                var checkboxes = document.querySelectorAll('input[type="checkbox"][name="order_ids[]"]');
                var totalprice = 0;
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        var priceElement = checkbox.closest('tr').querySelector('.price');
                        totalprice += parseFloat(priceElement.textContent);
                    }
                });
                document.getElementById('total-price').textContent = totalprice.toFixed(2); // Update total price display
            }

            // Add event listeners to checkboxes
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name="order_ids[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    recalculateTotalPrice();
                });
            });

            // Call recalculateTotalPrice initially to set the initial total price
            recalculateTotalPrice();
        });
    </script>
</body>
</html>
