<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Your existing index method
    public function index()
    {
        $groupedProducts = Products::all()->groupBy('category');
        return view('home', compact('groupedProducts'));
    }

    // New search method
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Filter products based on the search query
        $groupedProducts = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('category', 'LIKE', "%{$query}%")
            ->get()
            ->groupBy('category');

        // Return the same welcome view with the filtered results
        return view('home', compact('groupedProducts'));
    }
}