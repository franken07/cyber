<?php

namespace App\Http\Controllers;

use App\Models\checkout;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class Productcontroller extends Controller
{


    public function admin()
    {
        return view('admin');
    }

    public function components()
    {
        $productsBycategory = [
            'GPU' => Product::where('category', 'GPU')->get(),
            'CPU' => Product::where('category', 'CPU')->get(),
            'Monitor' => Product::where('category', 'Monitor')->get(),
        ];

        foreach ($productsBycategory as $category => $products) {
            foreach ($products as $product) {
                // Assuming $product->image contains the relative path to the image
                // Set the full image path for each product
                $product->image = asset('storage/product/' . $product->image);
            }
            
        }

        return view('components', compact('productsBycategory'));
    }
    public function addProduct(Request $request)
        {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'prod_name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:25048', // Adjust max file size if needed
                'category' => 'required|string',
                'description' => 'nullable|string',
            ]);

            // Handle the file upload if an image is provided
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = time().'.'.$request->image->extension();
                $request->image->move(public_path('storage/product'), $imagePath);
            }

            // Create the product
            $productData = [
                'prod_name' => $validatedData['prod_name'],
                'price' => $validatedData['price'],
                'category' => $validatedData['category'],
                'description' => $validatedData['description'],
                'image' => $imagePath,
            ];

            Product::create($productData);

            // Redirect back with success message
            return redirect('admin')->with('success', 'Product added successfully.');
        }

    public function editDeleteProducts()
    {

        $userPurchases = Checkout::all();


        $gpuProducts = Product::where('category', 'GPU')->get();
        $cpuProducts = Product::where('category', 'CPU')->get();
        $monitorProducts = Product::where('category', 'Monitor')->get();
    
        // Assuming $product->image contains the relative path to the image
        // Set the full image path for each product 
        foreach ($gpuProducts as $product) {
            $product->image = asset('storage/product/' . $product->image);
        }
        foreach ($cpuProducts as $product) {
            $product->image = asset('storage/product/' . $product->image);
        }
        foreach ($monitorProducts as $product) {
            $product->image = asset('storage/product/' . $product->image);
        }
    
        // Pass product data to the view
        return view('admin', compact('gpuProducts', 'cpuProducts', 'monitorProducts','userPurchases'));
    }

    public function editProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'prod_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category' => 'required|in:GPU,CPU,Monitor', // Ensure category is one of the specified values
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:25048', // Updated validation rule for image
        ]);

        $product->prod_name = $request->prod_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category = $request->category; // Update category

        
        if ($request->hasFile('image')) {
            // Delete previous image if exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            
            // Upload new image
            $imagePath= time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/product'), $imagePath);
            $product->image = $imagePath;
        }

        $product->save();



        return redirect()->route('edit_delete_products')->with('success', 'Product updated successfully');
    
    }

public function editprod($id)
{
    // Fetch the product from the database
    $product = Product::findOrFail($id);
    
    // Return the view with the product data
    return view('editproduct', compact('product'));
}
public function deleteProduct(Request $request, $productId)
{
    // Find the product by ID
    $product = Product::findOrFail($productId);

    // Delete the product image if it exists
    if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
    }

    // Delete the product
    $product->delete();

    // Redirect back with success message
    return redirect('admin')->with('success', 'Product deleted successfully.');
}

public function addToCart(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    // Check if the user is authenticated
    if (Auth::check()) {
        $user = Auth::user();
        $product = Product::find($id);

        if (!$product) {
            // Product not found
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Product not found.'], 404);
            } else {
                return redirect()->back()->with('error', 'Product not found.');
            }
        }

        // Calculate the total price based on the product's price and quantity
        $totalPrice = $product->price * $validatedData['quantity'];

        // Find existing order for the product and user
        $existingOrder = Order::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        // Update existing order or create a new one
        if ($existingOrder) {
            $existingOrder->quantity += $validatedData['quantity'];
            $existingOrder->price += $totalPrice;
            $existingOrder->save();
        } else {
            $order = new Order([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'user_id' => $user->id,
                'prod_name' => $product->prod_name,
                'image' => $product->image,
                'price' => $totalPrice,
                'product_id' => $product->id,
                'quantity' => $validatedData['quantity']
            ]);
            $order->save();
        }

        // Generate token and return response based on request type
        $token = $user->createToken('csd')->accessToken;
        if ($request->expectsJson()) {
            return response()->json(['success' => 'Product added to cart successfully.', 'token' => $token]);
        } else {
            return redirect()->back()->with('success', 'Product added to cart successfully.');
        }
    } else {
        // User not authenticated
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Please log in to add products to your cart.'], 401);
        } else {
            return redirect()->route('login')->with('error', 'Please log in to add products to your cart.');
        }
    }
}

public function checkout(Request $request)
{
    if(Auth::id()){

    
    $id=Auth::user()->id;

    $order=order::where('user_id',"=",$id)->get();

    return view('addcart',compact('order'));
    }
    else{
        return view('login');
    }
}


    public function remove_cart($id)
    {
        $order=Order::find($id);

        $order->delete();
        return redirect()->back();
    }

    public function checkoutprod(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'User not authenticated'], 401);
            } else {
                return redirect()->back()->with('error', 'User not authenticated');
            }
        }
    
        // Get the authenticated user's ID
        $userId = Auth::id();
    
        // Retrieve selected order IDs from the request
        $selectedOrderIds = $request->input('order_ids');
    
        // Check if any orders are selected
        if (!empty($selectedOrderIds)) {
            // Retrieve orders for the authenticated user and selected order IDs
            $orders = Order::whereIn('id', $selectedOrderIds)
                ->where('user_id', $userId)
                ->get();
    
            // Loop through the selected orders
            foreach ($orders as $order) {
                // Create a new checkout instance
                $checkout = new Checkout();
    
                // Assign values from the order to the checkout instance
                $checkout->name = $order->name;
                $checkout->email = $order->email;
                $checkout->phone = $order->phone;
                $checkout->address = $order->address;
                $checkout->user_id = $order->user_id;
                $checkout->prod_name = $order->prod_name;
                $checkout->price = $order->price;
                $checkout->image = $order->image;
                $checkout->quantity = $order->quantity;
                $checkout->product_id = $order->product_id;
                $checkout->delivery_status = 'cash on delivery';
    
                // Save the checkout instance
                $checkout->save();
    
                // Delete the current order
                $order->delete();
            }
        }
    
        // Generate token and return response based on request type
        $token = Auth::user()->createToken('csd')->accessToken;
        if ($request->expectsJson()) {
            return response()->json(['success' => 'Checkout successful!', 'token' => $token]);
        } else {
            // Redirect back to the previous page
            return redirect()->back()->with('success', 'Checkout successful!');
        }
    }


    public function userPurchases(){
    $userPurchases = Checkout::all();

    // Pass the data to the view
    return view('checkouts', compact('userPurchases'));
    }


    public function delivered($id){

        $checkout=checkout::find($id);

        $checkout->delivery_status="delivered";

        $checkout->save();

        return redirect()->route('edit_delete_products');

    }
}