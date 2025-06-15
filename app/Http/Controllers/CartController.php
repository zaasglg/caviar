<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function index() {
        // $cart = Session::get('cart', []);

        $cities = City::all();
        $carts = Cart::content();
        $total = Cart::subtotal();
        $totalCount = Cart::count();

        return view('pages.cart', [
            'carts' => $carts,
            'cities' => $cities,
            'total' => $total,
            'totalCount' => $totalCount
        ]);
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
                
        $data = $request->except('_token');

        $sizeKey = collect($data)->keys()->first(fn($key) => str_starts_with($key, 'size_'));

        Cart::add([
            'id' => $product->id, 
            'name' => $product->name, 
            'quantity' => $request->quantity, 
            'price' => (int) str_replace(' ', '', $data["price"]),
            'options' => ['size' => $data[$sizeKey], 'hero' => $product->image]
            ]
        );

        return redirect()->back();
    }

    public function destry($id) {
        Cart::remove($id);

        return redirect()->back();
    }

    public function plus(Request $request) {
        $request->validate([
            'quantity' => 'required|integer|min:1',  
        ]);

        Cart::update(1, ['quantity' => 30]);

        return redirect()->back();
    }

    public function minus(Request $request) {
        $request->validate([
            'quantity' => 'required|integer|min:1',  
        ]);

        Cart::update($request->id, $request->qty - 1);

        return redirect()->back();
    }

    public function save(Request $request) {

        Cart::destroy();

        Order::query()->create($request->all());

        return redirect()->route('thanks.page');
    }
}
