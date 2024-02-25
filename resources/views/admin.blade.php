<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include your custom CSS file here -->
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>
<body>

<div class="container">
    <h1>Admin Dashboard</h1>
    
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#addProducts">Add Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#userPurchases">User Purchases</a>
        </li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
    <!-- Add Products Tab -->
    <div id="addProducts" class="container tab-pane active"><br>
        <h3>Add Products</h3>
        <!-- Form to add products -->
        <form action="{{route('addProduct')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="productName">Product Name:</label>
                <input type="text" class="form-control" id="productName" name="name" placeholder="Enter product name">
            </div>
            <div class="form-group">
                <label for="productPrice">Product Price:</label>
                <input type="number" class="form-control" id="productPrice" name="price" placeholder="Enter product price">
            </div>
            <div class="form-group">
                <label for="productPicture">Product Picture:</label>
                <input type="file" class="form-control-file" id="productPicture" name="image">
            </div>
            <div class="form-group">
                <label for="productCategory">Product Category:</label>
                <select class="form-control" id="productCategory" name="category">
                    <option value="GPU">GPU</option>
                    <option value="CPU">CPU</option>
                    <option value="Monitor">Monitor</option>
                </select>
            </div>
            <div class="form-group">
                <label for="productDescription">Product Description:</label>
                <textarea class="form-control" id="productDescription" name="description" placeholder="Enter product description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include your custom JavaScript file here if needed -->
<script>
    // Add your custom JavaScript code here
</script>
</body>
</html>