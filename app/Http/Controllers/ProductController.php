<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $products = Product::leftJoin('categories as c', 'c.id', 'products.category_id')
                ->where('products.product_name', 'like', '%' . $request->search . '%')
                ->orWhere('c.category_name', 'like', '%' . $request->search . '%')
                ->select('products.id', 'products.product_name', 'products.category_id', 'c.category_name', 'products.product_image', 'products.price')
                ->get();

            return view('pages.product.index', compact('products'));
        }
        $products = Product::leftJoin('categories as c', 'c.id', 'products.category_id')
            ->select('products.id', 'products.product_name', 'products.category_id', 'c.category_name', 'products.product_image', 'products.price')
            ->get();;

        return view('pages.product.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->with('category')->first();

        $related_products = Product::whereNot('id', $product->id)->where('category_id', $product->category_id)->limit(4)->get();

        if ($related_products->count() < 4) {
            $id = $related_products->map(function ($value) {
                return $value->id;
            });
            $other_products = Product::whereNotIn('id', $id)->limit(4 - $related_products->count())->get();

            $related_products = $related_products->merge($other_products);
        }

        return view('pages.product.show', compact('product', 'related_products'));
    }

    public function search(Request $request)
    {
        $products = Product::leftJoin('categories as c', 'c.id', 'products.category_id')
            ->where('products.product_name', 'like', '%' . $request->search_value . '%')
            ->orWhere('c.category_name', 'like', '%' . $request->search_value . '%')
            ->select('products.id', 'products.product_name', 'products.category_id', 'c.category_name', 'products.product_image', 'products.price')
            ->get();

        dd($products);

        return response()->json($products);
    }
}
