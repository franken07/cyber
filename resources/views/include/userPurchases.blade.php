<h3>User Purchases</h3>
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