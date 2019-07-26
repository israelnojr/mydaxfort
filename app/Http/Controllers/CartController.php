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
            $request->session()->flash('status',  'Item already in cart');
            return redirect()->route('cart.index');
        }
        Cart::add($request->id, $request->name, $request->qty, $request->price)->associate('Mydaxfort\Product');
        $request->session()->flash('status',  'Item added to cart successfully');
        return redirect()->route('cart.index');
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
        $request->session()->flash('status',  'Item quantity updated successfully');
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
    public function destroy(Request $request, $id)
    {
        Cart::remove($id);
        $request->session()->flash('status',  'Item has been removed!');
        return redirect()->route('category.index');

    }

    public function reset(Request $request)
    {
        Cart::destroy();
        $request->session()->flash('status',  'Cart reset successfully');
        return redirect()->route('welcome');
    }
}
