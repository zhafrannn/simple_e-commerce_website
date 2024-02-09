<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * create new checkout record
     * 
     */
    public function store(Request $request)
    {
        $request->validate([
            'checked_items' => 'required|array',
        ]);

        $checkedItems = $request->input('checked_items');

        $transaction = Transaction::create([
            'transaction_code' => Str::random(10),
            'total' => 0
        ]);

        foreach ($checkedItems as $item) {
            $cart = Cart::where('id', $item)->first();

            Checkout::create([
                'product_id' => $cart->product_id,
                'transaction_id' => $transaction->id,
                'quantity'  => $cart->quantity
            ]);
        }

        return response()->json(['message' => 'Checkout successful', 'transaction_id' => $transaction->id]);
    }

    public function index($id)
    {
        $items = Checkout::where('transaction_id', $id)->with('product')->get();
        return view('pages.checkout.index', compact('items'));
    }

    public function destroy($id)
    {
        Checkout::where('id', $id)->delete();

        return response()->json([
            'msg' => 'Data successfully deleted.'
        ]);
    }
}
