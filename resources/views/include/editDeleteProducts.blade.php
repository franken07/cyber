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