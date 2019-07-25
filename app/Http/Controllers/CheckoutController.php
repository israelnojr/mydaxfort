<?php

namespace Mydaxfort\Http\Controllers;

use Illuminate\Http\Request;
use Mydaxfort\Checkout;
class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.checkout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function loadOrders()
    {
        return Checkout::all();
    }

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
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'number' => 'required',
            'email' => 'required',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'terms' => 'required',
        ]);
        $checkout = new Checkout;
        $checkout->first_name = $request->input('first_name');
        $checkout->last_name = $request->input('last_name');
        $checkout->number = $request->input('number');
        $checkout->email = $request->input('email');
        $checkout->country = $request->input('country');
        $checkout->address = $request->input('address');
        $checkout->city = $request->input('city');
        $checkout->terms = $request->input('terms');
    
        $checkout->save();

        return redirect()->route('paypage');
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
        //
    }

}
