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
              <h2>PayPage</h2>
              <p>Very us move be blessed multiply night</p>
            </div>
            <div class="page_link">
              <a href="{{('/')}}">Home</a>
              <a href="{{route('cart.index')}}">Cart</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Cart Area =================-->
    <section class="cart_area">
      <div class="container">
        <div class="cart_inner">
        @forelse(Cart::content() as $product)
        <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                <div class="row" style="margin-bottom:40px;">
                  <div class="col-md-12 col-md-offset-2">
                    <p>
                        <div>
                           You're paying 
                            ₦ {{Cart::total()}} 
                        </div>
                    </p>
                    <input type="hidden" name="email" value="{{auth::user()->email}}"> {{-- required --}}
                    <input type="hidden" name="orderID" value="{{$product->id}}">
                    <input type="hidden" name="amount" value="{{Cart::total()}}"> {{-- required in kobo --}}
                    <input type="hidden" name="quantity" value="{{$product->qty}}">
                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['customer_name' => 'auth->user()->name',]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                    {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}


                    <p>
                      <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                      <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                      </button>
                    </p>
                  </div>
                </div>
          </form>
          @empty
          <p>No Product to pay for</p>
          @endforelse
        </div>
      </div>
    </section>
    <!--================End Cart Area =================-->
@endsection