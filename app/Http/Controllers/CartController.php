<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * Retrieve all data from the cart table that is related to the product table.
     */
    public function index()
    {
        $items = Cart::with('product')->get();
        return view('pages.cart.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        if (!Cart::where('product_id', $request->product_id)->first()) {
            Cart::create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        } else {
            $cart = Cart::where('product_id', $request->product_id)->first();

            $cart->update([
                'quantity' => $cart->quantity + $request->quantity,
            ]);
        }

        return response()->json([
            'msg' => 'Data successfully added to the cart.'
        ]);
    }

    public function update($id, Request $request)
    {
        $item = Cart::where('id', $id)->first();
        $item->update([
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'msg' => 'Data successfully updated.'
        ]);
    }

    public function destroy($id)
    {
        Cart::where('id', $id)->delete();

        return response()->json([
            'msg' => 'Data successfully deleted.'
        ]);
    }
}
