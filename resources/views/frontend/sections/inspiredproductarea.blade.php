<div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Inspired products</span></h2>
            <p>Browse list of products inspired by customers interest</p>
          </div>
        </div>
      </div>

      <div class="row">
      @foreach($inspiredProducts as $product)
          <div class="col-lg-3 col-md-6">
            <div class="single-product">
              <div class="product-img">
                <img class="img-fluid w-100" src="{{asset('images/product/'.$product->image)}}"alt="{{$product->slug}}" style="height: 250px;"/>
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
                  <h4>{{$product->name}}</h4>
                </a>
                <div class="mt-3">
                  <span class="mr-4">$ {{$product->price}}</span>
                  <!-- <del>$35.00</del> -->
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>