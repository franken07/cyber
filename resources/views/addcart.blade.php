<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add to Cart</title>
    <!-- Include any necessary stylesheets or scripts -->
</head>
<body>
    <h1>Add Items to Cart</h1>
    @if(session('product_added'))
        <div class="alert alert-success">
            Product "{{ session('product_added')->name }}" added to cart successfully!
        </div>
    @endif
    <!-- Form for reviewing cart and proceeding to checkout/billing -->
</body>
</html>