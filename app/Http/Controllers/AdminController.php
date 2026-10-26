<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class AdminController extends Controller
{
  public function dashboard() {
    // 1. Get the list for the table
    $products = Product::all(); 
    
    // 2. Get the count for the summary
    $totalProducts = $products->count(); 
    
    // 3. Pass both names to the view
    return view('admin.dashboard', compact('products', 'totalProducts'));
}

    // RENAMED: Specifically for the inventory list
    public function showInventory() {
        $products = Product::all();
        return view('admin.inventory', compact('products'));
    }

    // For saving new items
    public function store(Request $request) 
    {
        // 1. Validation - include category and image
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Max 2MB
        ]);

        // 2. Handle the Image Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            // This saves the file to storage/app/public/products
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // 3. Create the Product
        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            
            'image' => $imagePath, // Saves the path like "products/filename.jpg"
        ]);

        return redirect()->back()->with('success', 'Item added to inventory successfully!');
    }

}