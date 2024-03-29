<?php

namespace App\Http\Controllers;

use App\Models\checkout;
use App\Models\Reservation;
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
    
        // Check if the request wants JSON response
        if (request()->wantsJson()) {
            return response()->json($productsBycategory);
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
            // Retrieve all user purchases
            $userPurchases = Checkout::whereNotNull('delivery_status')
                            ->orWhere('delivery_status', '!=', '')
                            ->get();
            $reservations = Reservation::all();
        
            // Retrieve GPU products
            $gpuProducts = Product::where('category', 'GPU')->get();
            // Retrieve CPU products
            $cpuProducts = Product::where('category', 'CPU')->get();
            // Retrieve Monitor products
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
        
            // Pass product data and user purchases to the view
            return view('admin', compact('gpuProducts', 'cpuProducts', 'monitorProducts', 'userPurchases','reservations'));
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
        if(Auth::check()) {
            $userId = Auth::id();
            $orders = Order::where('user_id', $userId)->get();
            return view('addcart', compact('orders'));
        } else {
            return view('login');
        }
    }

    public function removeCartItem(Order $order)
    {
        // Assuming you have some logic to validate the authenticated user and the order belongs to the user
    
        $order->delete();
    
        return redirect()->back()->with('success', 'Item removed from cart successfully.');
    }

    public function checkoutprod(Request $request)
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'User not authenticated'], 401);
            } else {
                return redirect()->back()->with('error', 'User not authenticated');
            }
        }
    
        $userId = Auth::id();
        $selectedOrderIds = $request->input('order_ids');
    
        if (!empty($selectedOrderIds)) {
            $orders = Order::whereIn('id', $selectedOrderIds)
                ->where('user_id', $userId)
                ->get();
    
            foreach ($orders as $order) {
                $checkout = new Checkout();
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
                $checkout->save();
                $order->delete();
            }
        }
    
        $token = Auth::user()->createToken('csd')->accessToken;
    
        if ($request->expectsJson()) {
            return response()->json(['success' => 'Checkout successful!', 'token' => $token]);
        } else {
            return redirect()->route('billing')->with('success', 'Checkout successful!');
        }
    }




    public function delivered($id){

        $checkout=checkout::find($id);

        $checkout->delivery_status="delivered";

        $checkout->save();

        return redirect()->route('edit_delete_products');

    }

    public function billingshow()
{
    if (Auth::check()) {
        $userId = Auth::id();
        $checkout = checkout::where('user_id', $userId)
                             ->whereNull('delivery_status')
                             ->orWhere('delivery_status', '')
                             ->get();
        return view('billing', compact('checkout'));
    } else {
        return view('login');
    }
}
    
    public function updateBilling(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'string|max:255',
            'address' => 'string|max:255',
            'delivery_status' => 'string|max:255'
        ]);
    
        // Get the authenticated user's ID
        $userId = auth()->id();
    
        // Update the delivery status for all checkouts of the authenticated user
        checkout::where('user_id', $userId)->update([
            'phone' => $request->phone,
            'address' => $request->address,
            'delivery_status' => 'Delivery'
        ]);
    
        return redirect()->route('billing')->with('success', 'Billing information updated successfully.');
    }

}