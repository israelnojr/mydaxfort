@extends('frontend.layout')
@section('content')

    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div class="banner_content d-md-flex justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
              <h2>Shop {{$categoryName}}</h2>
              <p>Very us move be blessed multiply night</p>
            </div>
            <div class="page_link">
            <a href="{{('/')}}">Home</a>
              <a href="{{route('category.index')}}">Shop</a>
              <a href="">{{$categoryName}}</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
      <div class="container">
        <div class="row flex-row-reverse">
          <div class="col-lg-9">
            <!-- <div class="product_top_bar">
              <div class="left_dorp">
                <select class="sorting">
                  <option value="1">Default sorting</option>
                  <option value="2">Default sorting 01</option>
                  <option value="4">Default sorting 02</option>
                </select>
                <select class="show">
                  <option value="1">Show 12</option>
                  <option value="2">Show 14</option>
                  <option value="4">Show 16</option>
                </select>
              </div>
            </div> -->
            
            <div class="latest_product_inner">
              <div class="row">
              @forelse($products as $product)
                <div class="col-lg-4 col-md-6">
                  <div class="single-product">
                    <div class="product-img">
                      <img
                        class="card-img"
                        src="{{asset('images/product/'.$product->image)}}"
                        alt="" style="height:250px;"
                      />
                      <div class="p_icon">
                        
                      <a href="{{route('product.show',$product->slug)}}">
                        <i class="ti-eye"></i>
                      </a>
                        <a href="{{route('product.show',$product->slug)}}">
                          <i class="ti-shopping-cart"></i>
                        </a>
                      </div>
                    </div>
                    <div class="product-btm">
                      <a href="#" class="d-block">
                        <h4>Latest {{$product->category->name}}</h4>
                      </a>
                      <div class="mt-3">
                        <span class="mr-4">${{$product->price}}</span>
                       
                      </div>
                    </div>
                  </div>
                </div>
                @empty
                <p class="text-center">There's no PRODUCT in this collection</p>
              @endforelse
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="left_sidebar_area">
              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Browse Categories</h3>
                </div>
                <div class="widgets_inner">
                  <ul class="list">
                    @foreach($categories as $category)
                        <li class="{{request()->category == $category->slug ? 'active' : ''}}">
                        <a href="{{route('category.index', ['category' => $category->slug])}}">{{$category->name}}</a>
                        </li>
                    @endforeach
                  </ul>
                </div>
              </aside>

              <aside class="left_widgets p_filter_widgets">
                <div class="l_w_title">
                  <h3>Price Filter</h3>
                </div>
                <div class="widgets_inner">
                  <div class="range_item">
                    <div id="slider-range"></div>
                    <div class="">
                      <label for="amount">Price : </label>
                      <input type="text" id="amount" readonly />
                    </div>
                  </div>
                </div>
              </aside>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Category Product Area =================-->

@endsection