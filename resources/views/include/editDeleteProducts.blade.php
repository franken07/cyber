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
                            <button type="button" class="btn btn-danger mt-2" onclick="confirmDelete({{ $product->id }})">Delete</button>
                        </div>
                    </div>
                </div>
                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Edit form (simplified for brevity) -->
                            </div>
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
                            <button type="button" class="btn btn-danger mt-2" onclick="confirmDeleteCPU({{ $product->id }})">Delete</button>
                        </div>
                    </div>
                </div>
                <!-- Edit Modal for CPU Products -->
                <div class="modal fade" id="editModalCPU{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabelCPU" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabelCPU">Edit Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Edit form (simplified for brevity) -->
                            </div>
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
                            <button type="button" class="btn btn-danger mt-2" onclick="confirmDeleteMonitor({{ $product->id }})">Delete</button>
                        </div>
                    </div>
                </div>
                <!-- Edit Modal for Monitor Products -->
                <div class="modal fade" id="editModalMonitor{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabelMonitor" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabelMonitor">Edit Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Edit form (simplified for brevity) -->
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>