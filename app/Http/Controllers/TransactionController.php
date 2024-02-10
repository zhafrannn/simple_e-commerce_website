<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('pages.payment.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required'
        ]);

        $transaction_id = $request->input('transaction_id');

        $checkouts = Checkout::where('transaction_id', $transaction_id)->get();

        $total_price = 0;
        foreach ($checkouts as $item) {
            $total_price += ($item->product->price * $item->quantity);

            $product = Product::where('id', $item->product_id)->first();
            $product->update([
                'stock' => $product->stock - $item->quantity,
            ]);

            Cart::where('product_id', $item->product_id)->delete();
        }
        
        $transaction = Transaction::where('id', $transaction_id)->first();
        $transaction->update([
            "total" => $total_price,
        ]);

        return response()->json(['message' => 'Payment successful']);
    }

    public function destroy($id)
    {
        Transaction::where('id', $id)->delete();

        return response()->json([
            'msg' => 'Checkout successfully deleted.'
        ]);
    }
}
