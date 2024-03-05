<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include your custom CSS file here -->
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

<div class="container">
    <h1>Admin Dashboard</h1>
    
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#addProducts">Add Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#editDeleteProducts">Edit/Delete Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#userPurchases">User Purchases</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="{{ route('allusers') }}">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#alladmin">Admin</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#statistic">Statistic</a>
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
                    <input type="text" class="form-control" id="productName" name="prod_name" placeholder="Enter product name">
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

        <!-- Edit/Delete Products Tab -->
        <div id="editDeleteProducts" class="container tab-pane fade">
            <br>
            <h3>Edit/Delete Products</h3>
            
            <div id="accordion">
                <!-- GPU Products -->
                <div class="card">
                    <div class="card-header" id="gpuHeading">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseGPU" aria-expanded="true" aria-controls="collapseGPU">
                                GPU Products
                            </button>
                        </h5>
                    </div>
                    <div id="collapseGPU" class="collapse show" aria-labelledby="gpuHeading" data-parent="#accordion">
                        <div class="card-body">
                            <!-- List of GPU products with edit and delete options -->
                            @foreach($gpuProducts as $product)
                            <div class="product-item">
                                <img src="{{ url($product->image) }}" class="card-img-top small-image" alt="{{ $product->prod_name }}" style="max-width: 100px; max-height: 100px;">
                                <p>{{ $product->prod_name }} - ${{ $product->price }}</p>
                                <a href="{{ route('edit_product', ['id' => $product->id]) }}">Edit</a>
                                <form action="{{ route('delete_product', ['productId' => $product->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- CPU Products -->
                <div class="card">
                    <div class="card-header" id="cpuHeading">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseCPU" aria-expanded="false" aria-controls="collapseCPU">
                                CPU Products
                            </button>
                        </h5>
                    </div>
                    <div id="collapseCPU" class="collapse" aria-labelledby="cpuHeading" data-parent="#accordion">
                        <div class="card-body">
                            <!-- List of CPU products with edit and delete options -->
                            @foreach($cpuProducts as $product)
                            <div class="product-item">
                                <img src="{{ url($product->image) }}" class="card-img-top small-image" alt="{{ $product->prod_name }}" style="max-width: 100px; max-height: 100px;">
                                <p>{{ $product->prod_name }} - ${{ $product->price }}</p>
                                <a href="{{ route('edit_product', ['id' => $product->id]) }}">Edit</a>
                                <form action="{{ route('delete_product', ['productId' => $product->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Monitor Products -->
                <div class="card">
                    <div class="card-header" id="monitorHeading">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseMonitor" aria-expanded="false" aria-controls="collapseMonitor">
                                Monitor Products
                            </button>
                        </h5>
                    </div>
                    <div id="collapseMonitor" class="collapse" aria-labelledby="monitorHeading" data-parent="#accordion">
                        <div class="card-body">
                            <!-- List of Monitor products with edit and delete options -->
                            @foreach($monitorProducts as $product)
                            <div class="product-item">
                                <img src="{{ url($product->image) }}" class="card-img-top small-image" alt="{{ $product->prod_name }}" style="max-width: 100px; max-height: 100px;">
                                <p>{{ $product->prod_name }} - ${{ $product->price }}</p>
                                <a href="{{ route('edit_product', ['id' => $product->id]) }}">Edit</a>
                                <form action="{{ route('delete_product', ['productId' => $product->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Purchases Tab -->
        <div id="userPurchases" class="container tab-pane fade">
            <h1>User Purchases</h1>
            @if ($userPurchases->isEmpty())
                <p>No purchases found.</p>
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
                            <th>Image</th>
                            <th>quantity</th>
                            <th>Delivery</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userPurchases as $purchase)
                        <tr>
                            <td>{{ $purchase->name }}</td>
                            <td>{{ $purchase->email }}</td>
                            <td>{{ $purchase->phone }}</td>
                            <td>{{ $purchase->address }}</td>
                            <td>{{ $purchase->prod_name }}</td>
                            <td>{{ $purchase->price }}</td>
                            <td><img src="{{ asset('storage/product/' . $purchase->image) }}" alt="{{ $purchase->prod_name }}"></td>
                            <td>{{ $purchase->quantity }}</td>
                            <td>{{ $purchase->delivery_status }}</td>
                            <td>
                            <form action="{{ route('delivered', ['id' => $purchase->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Mark Delivered</button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif   
        </div> 
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
