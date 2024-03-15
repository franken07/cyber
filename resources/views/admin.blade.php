<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="shortcut icon" href="{{ secure_asset('assets/images/loko.png') }}" type="image/x-icon">
<link rel="stylesheet" href="{{ secure_asset('assets/admincss/admin.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/web/assets/mobirise-icons2/mobirise2.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/parallax/jarallax.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/bootstrap/css/bootstrap-grid.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/dropdown/css/style.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/socicon/css/styles.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/animatecss/animate.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/theme/css/style.css') }}">
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap"></noscript>
<link rel="preload" as="style" href="{{ secure_asset('assets/mobirise/css/additional.css') }}"><link rel="stylesheet" href="{{ secure_asset('assets/mobirise/css/additional.css') }}" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css">
  
<body style="background-image: url('{{ asset('images/17.png') }}');">
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
<<<<<<< Updated upstream
=======
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Addapointment">Add Apointment</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#reserverations">Reservation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#alladmin">Admin</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#statistic">Statistic</a>
        </li>
>>>>>>> Stashed changes
    </ul>
    
    <!-- Tab panes -->
    <div class="rounded-container">
    <div class="tab-content">
        <!-- Add Products Tab -->
        <div id="addProducts" class="container tab-pane active"><br>
            @include('include.addProducts')
        </div>
        <!-- Edit/Delete Products Tab -->
<<<<<<< Updated upstream
        <div id="editDeleteProducts" class="container tab-pane fade">
            <br>
            <h3>Edit/Delete Products</h3>
            
            <div id="accordion">
                     
<!-- GPU Products -->
<div class="card">
    <div class="card-header" id="gpuHeading">
        <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseGPU" aria-expanded="false" aria-controls="collapseGPU">
                GPU Products
            </button>
        </h5>
    </div>
    <div id="collapseGPU" class="collapse" aria-labelledby="gpuHeading" data-parent="#accordion">
        <div class="card-body">
            <div class="row">
                @foreach($gpuProducts as $product)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="product-card card h-100">
                        <img src="{{ url($product->image) }}" class="card-img-top" alt="{{ $product->prod_name }}" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->prod_name }}</h5>
                            <p class="card-text">${{ $product->price }}</p>
                            <a href="#" class="btn btn-primary mt-auto" data-toggle="modal" data-target="#editModal{{ $product->id }}">Edit</a>
                            <!-- Delete Form -->
                            <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-2">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Ensure this is PUT or PATCH as per your route definition -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="prod_name">Product Name</label>
                        <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{ $product->prod_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="GPU" {{ $product->category == 'GPU' ? 'selected' : '' }}>GPU</option>
                            <option value="CPU" {{ $product->category == 'CPU' ? 'selected' : '' }}>CPU</option>
                            <option value="Monitor" {{ $product->category == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
                @endforeach
            </div>
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
            <div class="row">
                @foreach($cpuProducts as $product)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="product-card card h-100">
                        <img src="{{ url($product->image) }}" class="card-img-top" alt="{{ $product->prod_name }}" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->prod_name }}</h5>
                            <p class="card-text">${{ $product->price }}</p>
                            <a href="#" class="btn btn-primary mt-auto" data-toggle="modal" data-target="#editModalCPU{{ $product->id }}">Edit</a>
                            <!-- Delete Form -->
                            <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-2">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Edit Modal for CPU Products -->
                <div class="modal fade" id="editModalCPU{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabelCPU{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabelCPU{{ $product->id }}">Edit Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Ensure this is PUT or PATCH as per your route definition -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="prod_name">Product Name</label>
                        <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{ $product->prod_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="GPU" {{ $product->category == 'GPU' ? 'selected' : '' }}>GPU</option>
                            <option value="CPU" {{ $product->category == 'CPU' ? 'selected' : '' }}>CPU</option>
                            <option value="Monitor" {{ $product->category == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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
            <div class="row">
                @foreach($monitorProducts as $product)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="product-card card h-100">
                        <img src="{{ url($product->image) }}" class="card-img-top" alt="{{ $product->prod_name }}" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->prod_name }}</h5>
                            <p class="card-text">${{ $product->price }}</p>
                            <a href="#" class="btn btn-primary mt-auto" data-toggle="modal" data-target="#editModalMonitor{{ $product->id }}">Edit</a>
                            <!-- Delete Form -->
                            <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-2">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Edit Modal for Monitor Products -->
                <div class="modal fade" id="editModalMonitor{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabelMonitor{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabelMonitor{{ $product->id }}">Edit Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="prod_name">Product Name</label>
                                        <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{ $product->prod_name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="Monitor" {{ $product->category == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                                            <option value="GPU" {{ $product->category == 'GPU' ? 'selected' : '' }}>GPU</option>
                                            <option value="CPU" {{ $product->category == 'CPU' ? 'selected' : '' }}>CPU</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control-file" id="image" name="image">
                                        <small>Current image: {{ $product->image }}</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>           
=======
        <div id="editDeleteProducts" class="container tab-pane fade"><br>
            @include('include.editDeleteProducts')
        </div>
>>>>>>> Stashed changes
        <!-- User Purchases Tab -->
        <div id="userPurchases" class="container tab-pane fade"><br>
            @include('include.userPurchases')
        </div> 
        
        <div id="Addapointment" class="container tab-pane fade"><br>
            @include('include.Addapointment')
        </div>
        <div id="reserverations" class="container tab-pane active"><br>
            @include('include.reservations')
        </div>
    </div>
</div>
</div>

<script>
function confirmDelete(productId) {
    if (confirm('Are you sure you want to delete this product?')) {
        fetch('/delete_product.php', {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: productId }),
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Product deleted successfully!');
    
            } else {
                alert('There was a problem with the deletion.');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Product deleted successfully!');
        });
    }
}
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="assets/parallax/jarallax.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/dropdown/js/navbar-dropdown.js"></script>
<script src="assets/scrollgallery/scroll-gallery.js"></script>
<script src="assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/ytplayer/index.js"></script>
<script src="assets/theme/js/script.js"></script>
<script src="assets/formoid/formoid.min.js"></script>
</body>
</html>
