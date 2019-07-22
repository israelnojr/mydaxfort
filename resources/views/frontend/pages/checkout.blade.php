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
              <a href="{{route('checkout.index')}}">Product Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
      <div class="container">
       @if(Cart::count() > 0)
        <div class="billing_details">
          <div class="row">
            <div class="col-lg-8">
              <h3>Billing Details</h3>
              <form method="POST" action="{{ route('checkout.store') }}"  class="row contact_form">
                        @csrf
                <div class="col-md-6 form-group p_star">
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" 
                    value="{{ old('first_name') }}"  autocomplete="first_name" autofocus placeholder="First Name">

                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 form-group p_star">
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" 
                    value="{{ old('last_name') }}"  autocomplete="last_name" autofocus placeholder="Last Name">

                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 form-group p_star">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                    value="{{ old('email') }}"  autocomplete="email" placeholder="Email Address">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 form-group p_star">
                    <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" 
                    value="{{ old('number') }}"  autocomplete="number" placeholder="Mobile Number">

                    @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 form-group p_star">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" 
                    value="{{ old('address') }}"  autocomplete="address" placeholder="Address">

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 form-group p_star">
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" 
                    value="{{ old('city') }}"  autocomplete="city" placeholder="City">

                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 form-group p_star">
                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" 
                    value="{{ old('country') }}"  autocomplete="country" placeholder="Country">

                    @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12 form-group p_star">
                  <input type="checkbox" id="f-option4" name="terms" value="yes"/>
                    <label for="f-option4">I’ve read and accept the </label>
                    <a href="#">terms & conditions*</a>
                </div>
                <div class="col-md-12 form-group p_star">
                  <button type="submit" class="main_btn">Proceed to Paystack</button>
                </div>
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
                      <span class="last">₦ {{$product->subtotal}}</span>
                    </a>
                  </li>
                @endforeach
                </ul>
                <ul class="list list_2">
                  <li>
                    <a href="#"
                      >Subtotal
                      <span> ₦ {{Cart::subtotal()}}</span>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      >Tax
                      <span> ₦ {{Cart::tax()}}</span>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      >Total
                      <span> ₦ {{Cart::total()}}</span>
                    </a>
                  </li>
                </ul>
                
            </div>
          </div>
          @else
          <p>You do not have item to checkout</p>
          @endif
        </div>
      </div>
    </section>
    <!--================End Checkout Area =================-->
@endsection