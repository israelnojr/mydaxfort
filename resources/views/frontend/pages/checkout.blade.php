@extends('frontend.layout')
@section('content')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Product Checkout</h2>
              <p>Very us move be blessed multiply night</p>
            </div>
            <div class="page_link">
              <a href="{{route('welcome')}}">Home</a>
              <a href="{{route('checkout')}}">Product Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
      <div class="container">
       
        <div class="billing_details">
          <div class="row">
            <div class="col-lg-8">
              <h3>Billing Details</h3>
              <form
                class="row contact_form"
                action="#"
                method="post"
                novalidate="novalidate"
              >
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="first"
                    name="first_name"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="First name"
                  ></span>
                </div>
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="last"
                    name="last_name"
                  />
                  <span class="placeholder" data-placeholder="Last name"></span>
                </div>
              
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="number"
                    name="number"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="Phone number"
                  ></span>
                </div>
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="compemailany"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="Email Address"
                  ></span>
                </div>
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="country"
                    name="country"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="Country"
                  ></span>
                </div>
                <div class="col-md-6 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="add1"
                    name="address"
                  />
                  <span
                    class="placeholder"
                    data-placeholder="Address "
                  ></span>
                </div>
                
                <div class="col-md-12 form-group p_star">
                  <input
                    type="text"
                    class="form-control"
                    id="city"
                    name="city"
                  />
                  <span class="placeholder" data-placeholder="Town/City"></span>
                </div>
                <div class="col-md-12 form-group p_star">
                <input type="checkbox" id="f-option4" name="selector" value="yes"/>
                  <label for="f-option4">I’ve read and accept the </label>
                  <a href="#">terms & conditions*</a>
                </div>
                <div class="col-md-12 form-group p_star">
                  <button type="submit" class="main_btn">Proceed to Paystack</button>
                </div>
              
                <!-- <div class="col-md-12 form-group">
                  <input
                    type="text"
                    class="form-control"
                    id="zip"
                    name="zip"
                    placeholder="Postcode/ZIP"
                  />
                </div> -->
                <!-- <div class="col-md-12 form-group">
                  <div class="creat_account">
                    <input type="checkbox" id="f-option2" name="selector" />
                    <label for="f-option2">Create an account?</label>
                  </div>
                </div>
                <div class="col-md-12 form-group">
                  <div class="creat_account">
                    <h3>Shipping Details</h3>
                    <input type="checkbox" id="f-option3" name="selector" />
                    <label for="f-option3">Ship to a different address?</label>
                  </div>
                  <textarea
                    class="form-control"
                    name="message"
                    id="message"
                    rows="1"
                    placeholder="Order Notes"
                  ></textarea>
                </div> -->
              </form>
            </div>
            <div class="col-lg-4">
              <div class="order_box">
                <h2>Your Order</h2>
                <ul class="list">
                  <li>
                    <a href="#"
                      >Product
                      <span>Total</span>
                    </a>
                  </li>
                  @foreach(Cart::content() as $product)
                  <li>
                    <a href="#"
                      >{{$product->name}}
                      <span class="middle">x {{$product->qty}}</span>
                      <span class="last">${{$product->price}}</span>
                    </a>
                  </li>
                @endforeach
                </ul>
                <ul class="list list_2">
                  <li>
                    <a href="#"
                      >Subtotal
                      <span>${{Cart::subtotal()}}</span>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      >Shipping
                      <span>Tax rate: ${{Cart::tax()}}</span>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      >Total
                      <span>${{Cart::total()}}</span>
                    </a>
                  </li>
                </ul>
                
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection