<?php

namespace Mydaxfort\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function($cartItem, $rowId) use($request){
            return $cartItem->id === $request->id;
        });
        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success', 'Item already in cart');
        }
        Cart::add($request->id, $request->name, $request->qty, $request->price)->associate('Mydaxfort\Product');
        return redirect()->route('cart.index')->with('success', 'Item added to cart successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function UpdateCart(Request $request)
    {
        $qty = $request->qty;
        $product_id = $request->rowId;
  
        Cart::update($product_id, $qty);

        return Redirect()->route('cart.index');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return redirect()->route('category.index')->with('success', 'Item has been removed!');

    }

    public function reset()
    {
        Cart::destroy();
        return redirect()->route('welcome');
    }
}
