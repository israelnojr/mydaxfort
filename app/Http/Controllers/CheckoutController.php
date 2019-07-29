<?php

namespace Mydaxfort\Http\Controllers;

use Mydaxfort\Checkout;
use Damas\Paytabs\Paytabs;
use Illuminate\Http\Request;

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
        $this->authorize('isAdmin');
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
        // $checkout = new Checkout;
        // $checkout->first_name = $request->input('first_name');
        // $checkout->last_name = $request->input('last_name');
        // $checkout->number = $request->input('number');
        // $checkout->email = $request->input('email');
        // $checkout->country = $request->input('country');
        // $checkout->address = $request->input('address');
        // $checkout->city = $request->input('city');
        // $checkout->terms = $request->input('terms');
    
        // $checkout->save();

        // return redirect()->route('paypage');

        $pt = Paytabs::getInstance("MERCHANT_EMAIL", "SECRET_KEY");
	    $result = $pt->create_pay_page(array(
		"merchant_email" => "MERCHANT_EMAIL",
		'secret_key' => "mdcrklKeT0D1yZFwpW2lobsHVTrdfPaC2n4mIPBBQeDodiVDeXZD9rk4lMiBCtdEQi1y7CaXRNm55iJkgIXpaiuv5N7Hglm6DnFL",
		'title' => "John Doe",
		'first_name' => "John",
		'last_name' => "Doe",
		'email' => [ $request => 'email'],
		'cc_phone_number' => "973",
		'number' => "33333333",
		'billing_address' => "Juffair, Manama, Bahrain",
		'city' => "Manama",
		'state' => "Capital",
		'postal_code' => "97300",
		'country' => "BHR",
		'address_shipping' => "Juffair, Manama, Bahrain",
		'city_shipping' => "Manama",
		'state_shipping' => "Capital",
		'postal_code_shipping' => "97300",
		'country_shipping' => "BHR",
		"products_per_title"=> "Mobile Phone",
		'currency' => "BHD",
		"unit_price"=> "10",
		'quantity' => "1",
		'other_charges' => "0",
		'amount' => "10.00",
		'discount'=>"0",
		"msg_lang" => "english",
		"reference_no" => "1231231",
		"site_url" => "https://your-site.com",
		'return_url' => "https://www.mystore.com/paytabs_api/result.php",
        "cms_with_version" => "API USING PHP"
        ));

        if($result->response_code == 4012){
            return redirect($result->payment_url);
            }
            return $result->result;
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
