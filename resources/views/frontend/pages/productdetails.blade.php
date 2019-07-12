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
              <h2>Product Details</h2>
              <p>Very us move be blessed multiply night</p>
            </div>
            <div class="page_link">
              <a href="index.html">Home</a>
              <a href="single-product.html">Product Details</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Single Product Area =================-->
    <div class="product_image_area">
      <div class="container">
        <div class="row s_product_inner">
          <div class="col-lg-6">
            <div class="s_product_img">
              <div
                id="carouselExampleIndicators"
                class="carousel slide"
                data-ride="carousel"
              >
                
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img
                      class="d-block w-100"
                      src="{{asset('images/product/'.$product->image)}}"
                      alt="First slide"
                    />
                  </div>
                  <!-- <div class="carousel-item">
                    <img
                      class="d-block w-100"
                      src="{{asset('frontend/img/product/single-product/s-product-1.jpg')}}"
                      alt="Second slide"
                    />
                  </div> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 offset-lg-1">
            <div class="s_product_text">
              <h3>{{$product->name}}</h3>
              <h2>${{$product->price}}</h2>
              <ul class="list">
                <li>
                  <a class="active" href="#">
                    <span>Category</span> : {{$product->category->name}} </a
                  >
                </li>
                <li>
                  <a href=""> <span>Availibility</span> : In Stock</a>
                </li>
              </ul>
              <p>
                {{$product->short_desc}}
              </p>
              <div class="product_count">
                <label for="qty">Quantity:</label>
                <input
                  type="text"
                  name="qty"
                  id="sst"
                  maxlength="12"
                  value="1"
                  title="Quantity:"
                  class="input-text qty"
                />
                <button
                  onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                  class="increase items-count"
                  type="button"
                >
                  <i class="lnr lnr-chevron-up"></i>
                </button>
                <button
                  onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                  class="reduced items-count"
                  type="button"
                >
                  <i class="lnr lnr-chevron-down"></i>
                </button>
              </div>
              <div class="card_area">
                <form action="{{route('cart.store')}}" method="post">
                    @csrf()
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="hidden" name="name" value="{{$product->name}}">
                    <input type="hidden" name="price" value="{{$product->price}}">
                    <input type="hidden" name="qty" value="1">
                    <button class="main_btn">Add to Cart</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a
              class="nav-link"
              id="home-tab"
              data-toggle="tab"
              href="#home"
              role="tab"
              aria-controls="home"
              aria-selected="true"
              >Description</a
            >
          </li>
          
          <li class="nav-item">
            <a
              class="nav-link active"
              id="review-tab"
              data-toggle="tab"
              href="#review"
              role="tab"
              aria-controls="review"
              aria-selected="false"
              >Reviews</a
            >
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div
            class="tab-pane fade"
            id="home"
            role="tabpanel"
            aria-labelledby="home-tab"
          >
            <p>
              {{$product->short_desc}}
            </p>
            <p>
              {{$product->long_desc}}
            </p>
          </div>
          <div
            class="tab-pane fade"
            id="profile"
            role="tabpanel"
            aria-labelledby="profile-tab">
          </div>
          <div
            class="tab-pane fade"
            id="contact"
            role="tabpanel"
            aria-labelledby="contact-tab"
          >
            <div class="row">
              <div class="col-lg-6">
                <div class="comment_list">
                </div>
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade show active"
            id="review"
            role="tabpanel"
            aria-labelledby="review-tab"
          >
            <div class="row" id="app">
              <div class="col-lg-6">
                <div class="row total_rate">
                  <div class="col-12">
                    <div class="box_total">
                      <h5>Overall</h5>
                      <h4>{{$product->getStarRating()}}</h4>
                      <h6>({{$product->getReviewCount()}} Reviews)</h6>
                    </div>
                  </div>
                </div>
                <div class="review_list">
                  @forelse($product->review as $review)
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex mt-3">
                        <img
                          src="{{asset('images/review/1561553669.png')}}"
                          alt="" style="width:50px; height:50px;"
                        />
                      </div>
                      <div class="media-body mt-3"> 
                        <h4>{{$review->user->name}}</h4>
                        <star-rating star-size="20" increment="0.5" :rating="{{$review->rating}}"></star-rating>
                      </div>
                    </div>
                      <p>{{$review->title}}</p>
                    <p>
                      {{$review->review}}
                    </p>
                  </div>
                  @empty
                    <p>You can be the first to leave a review for this product</p>
                  @endforelse
                </div>
              </div>                 
              <div class="col-lg-6">
                <div class="review_box">
                  <star-rating increment="0.5" :rating="{{$product->getStarRating()}}"></star-rating>
                  <h4 class="mt-3" >Add a Review</h4>
                  <review-form
                    :product="{{$product}}" 
                    url="{{route('review.store')}}"
                  ></review-form>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Product Description Area =================-->
@endsection