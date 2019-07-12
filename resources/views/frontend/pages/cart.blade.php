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
              <h2>Cart</h2>
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
          <div class="table-responsive">
            <table class="table">
            @if(Cart::count() > 0)
              <thead>
                <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Action</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
              @foreach(Cart::content() as $product)
                <tr>
                  <td>
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="{{asset('images/product/'.$product->model->image)}}" style="width: 100px;height: 70px;" alt="{{$product->model->slug}}"/>
                      </div>
                      <div class="media-body">
                        <p>{{$product->name}}</p>
                      </div>
                    </div>
                  </td>
                  <td>
                   <form action="{{route('cart.remove', $product->rowId)}}" method="post" >
                    @csrf() @method('delete')
                    <button type="submit" class="btn main_btn">Remove</button>
                   </form>
                  </td>
                  <td>
                    <div class="product_count d-flex" >
                        <form action="{{route('cart.updatecart')}}" method="post"> @csrf()
                            <input
                            type="text"
                            name="qty"
                            id="sst"
                            maxlength="12"
                            value="{{$product->qty}}"
                            title="Quantity:"
                            style="width: 42px;
                                  padding-left: 17px;
                                  margin-right: -4px;
                                  height: 35px; "
                            />
                          <input type="hidden" name="rowId" value="{{$product->rowId}}">
                          <input type="submit" value="Update" class="btn main_btn" style="padding: 2px; height: 50px;" >
                        </form>
                    </div>
                  </td>
                  <td>
                    <h5>${{$product->subtotal}}</h5>
                  </td>
                </tr>
                @endforeach
               
                <tr class="bottom_button">
                  <td>
                    <a class="main_btn" href="{{route('cart.reset')}}">Reset Cart</a>
                  </td>
                  <td></td>
                  <td></td>
                  <td>
                   
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <h5>Subtotal</h5>
                  </td>
                  <td>
                    <h5>${{Cart::subtotal()}}</h5>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <h5>Tax</h5>
                  </td>
                  <td>
                    <h5>${{Cart::tax()}}</h5>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <h5>Total</h5>
                  </td>
                  <td>
                    <h5>${{Cart::total()}}</h5>
                  </td>
                </tr>
                
                <tr class="out_button_area">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <div class="checkout_btn_inner  d-flex">
                      <a class="gray_btn mr-2" href="{{route('category.index')}}">Continue To Shop</a>
                      @guest 
                        <a class="main_btn" href="{{route('login')}}" href="{{route('checkout.index')}}">Proceed to checkout</a>
                      @else
                        <a class="main_btn" href="{{route('checkout.index')}}">Proceed to checkout</a>
                      @endguest
                    </div>
                  </td>
                </tr>
                  @else
                  <p>You don't have any item in your cart</p>
                  @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!--================End Cart Area =================-->
@endsection