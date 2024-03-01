<?php

namespace App\Http\Controllers;

use App\Models\checkout;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
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
    if (Auth::check()) { // Check if user is authenticated
        dd(Auth::check());
        $user = Auth::user();
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $order = new Order;

        $order->name = $user->name;
        $order->email = $user->email;
        $order->phone = $user->phone;
        $order->address = $user->address;
        $order->user_id = $user->id;
        $order->prod_name = $product->prod_name;
        $order->image = $product->image;
        $order->price = $product->price * $request->quantity; // Calculate total price
        $order->product_id = $product->id;
        $order->quantity = $request->quantity;
        $order->save();

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    } else {
        dd(Auth::check());
        return redirect('login')->with('error', 'Please log in to add products to your cart.');
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

    public function checkoutprod()
    {
        $user = Auth::user();
        $userid = $user->id; 
    
        $orders = Order::where('user_id', $userid)->get();
    
        foreach ($orders as $order) {
            $checkout = new Checkout;
    
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
    
            $checkout->save();
    
            // Delete the current order
            $order->delete();
        }
    
        return redirect()->back();
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

        return redirect()->back();

    }
}