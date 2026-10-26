<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $id = $request->product_id;
        $qty = (int) $request->qty;
        $product = Products::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $qty,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        if ($request->action === 'checkout') {
            return redirect()->route('checkout.index');
        }

        return redirect()->back()->with('success', "{$product->name} added to cart!");
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('checkout', compact('cart'));
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart');
        if($request->id && $request->quantity > 0) {
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
        } elseif($request->quantity <= 0) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Item removed.');
        }
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('home')->with('success', 'Your cart has been cleared.');
    }

   // ... inside CartController class

public function payment()
{
    $order = session()->get('pending_order');
    if (!$order) return redirect()->route('checkout.index');
    
    return view('payment', compact('order'));
}

public function processOrder(Request $request)
{
    $request->validate([
        'phone' => 'required',
        'tip_amount' => 'nullable|numeric',
        'total_amount' => 'required|numeric'
    ]);

    // Store order details in session to pass to the payment page
    session()->put('pending_order', $request->all());

    // Instead of a JSON response, we redirect to the payment route
    return response()->json(['redirect_url' => route('payment.index')]);
}

    public function orderSuccess(Request $request)
    {
        // Accept both real IntaSend COMPLETE state and our simulation DEMO state
        if ($request->state === 'COMPLETE' || $request->state === 'DEMO') {
            session()->forget('cart');
            
            return view('order-success', [
                'tracking_id' => $request->tracking_id ?? 'DEMO-' . strtoupper(str()->random(8))
            ]);
        }

        return redirect()->route('checkout.index')->with('error', 'Payment could not be processed.');
    }
}