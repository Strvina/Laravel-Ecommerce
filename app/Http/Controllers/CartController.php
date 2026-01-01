<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuce;
use App\Models\CartItem;

class CartController extends Controller
{
    // Show cart page
    public function index()
{
    $userId = 1; // dummy user for now

    $cartItems = CartItem::where('user_id', $userId)
        ->with('kuce')
        ->get();

    $total = $cartItems->sum(function ($item) {
        return $item->kuce->price * $item->quantity;
    });

    return view('cart.index', compact('cartItems', 'total'));
}


    // Add dog to cart (supports AJAX)
    public function add(Request $request, $kuceId)
    {
        $userId = 1; // dummy user for now

        $item = CartItem::where('user_id', $userId)
                        ->where('kuce_id', $kuceId)
                        ->first();

        if ($item) {
            $item->quantity += 1;
            $item->save();
        } else {
            CartItem::create([
                'user_id' => $userId,
                'kuce_id' => $kuceId,
                'quantity' => 1
            ]);
        }

        $kuce = Kuce::find($kuceId);

        // If AJAX request, return JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'dog' => [
                    'name' => $kuce->name,
                    'image' => $kuce->image,
                ],
            ]);
        }

        // Otherwise, fallback for normal request
        return back()->with('cart_success', [
            'name' => $kuce->name,
            'image' => $kuce->image
        ]);
    }

    // Remove item from cart
   public function remove($id)
{
    $userId = 1; // dummy user

    $item = CartItem::where('id', $id)
        ->where('user_id', $userId)
        ->firstOrFail();

    $item->delete();

    // recalculating total
    $cartItems = CartItem::where('user_id', $userId)->with('kuce')->get();

    $total = $cartItems->sum(function ($i) {
        return $i->kuce->price * $i->quantity;
    });

    return response()->json([
        'success' => true,
        'total' => $total
    ]);
}

    public function update(Request $request, $id)
{
    $userId = 1; // dummy user

    $item = CartItem::where('id', $id)
        ->where('user_id', $userId)
        ->with('kuce')
        ->firstOrFail();

    $quantity = max(1, (int)$request->quantity);

    $item->quantity = $quantity;
    $item->save();

    // Recalculate total
    $cartItems = CartItem::where('user_id', $userId)->with('kuce')->get();

    $total = $cartItems->sum(function ($i) {
        return $i->kuce->price * $i->quantity;
    });

    return response()->json([
        'success' => true,
        'subtotal' => $item->kuce->price * $item->quantity,
        'total' => $total
    ]);
}



}
