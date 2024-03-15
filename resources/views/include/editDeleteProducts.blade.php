
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
                                <a href="{{ route('editprod', ['id' => $product->id]) }}">Edit</a>
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