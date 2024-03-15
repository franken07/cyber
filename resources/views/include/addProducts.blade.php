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