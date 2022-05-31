<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Product;
use Codexshaper\WooCommerce\Facades\Variation;
use Codexshaper\WooCommerce\Facades\WooCommerce;

class WooController extends Controller
{
    public function all(Request $request)
    {
        // dd($request->query->page);
        $per_page = 15; // Or your desire number
        $current_page = $request->query("page");
        // dd($current_page);
        $products = Product::where('status',  'publish')->paginate($per_page, $current_page);
        // dd($products);
        // $p =  json_decode($products);
        // return $p;
        return view('woo.products', [
            'products' => json_decode($products)
        ]);
    }
    public function product(Request $request)
    {
        $product = WooCommerce::find('products/' . $request->id);
        $variants = WooCommerce::find('products/' . $request->id . '/variations');
        // dd($product, $variants);

        return view('woo.product', [
            'product' => $product,
            'variants' => $variants
        ]);
    }
    public function update(Request $request)
    {
        $input = $request->except(['_token']);
        $variants = [];
        foreach ($input as $i => $id) {
            $variants[] = [
                'id' => $i,
                'regular_price' => max($id[0], $id[1]),
                'sale_price' => min($id[0], $id[1]),
            ];
        }

        $data = ["update" => $variants];

        $variants = Variation::batch($request->id, $data);
        return back()->with('success', 'Product prices updated successfully');
    }
}
