<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class Productcontroller extends Controller
{

    public function cart()
    {
        return view('addcart');
    }
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:25048', // Adjust max file size if needed
            'category' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // Handle the file upload if an image is provided
        if ($request->hasFile('image')) {
            // Use storeAs to specify the file name
            $imagePath= time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/product'), $imagePath);
            $validatedData['image'] = $imagePath;
        }
    
        // Create the product
        Product::create($validatedData);
    
        // Redirect back with success message
        return back()->with('success', 'Product added successfully.');
    }


    public function add(Request $request)
    {
        $product = Product::find($request->product_id);

        // Add the product to the cart (you may have a Cart model)
        // This is a basic example, you may need to adjust based on your cart implementation
        Product::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'options' => [
                'image' => $product->image
            ]
        ]);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }
    
    public function checkout(Request $request)
    {
        // Handle checkout logic here (e.g., save order details, process payment, etc.)
        
        // Redirect to admin page after checkout
        return redirect()->route('admin')->with('success', 'Your order has been placed successfully!');
    }


}