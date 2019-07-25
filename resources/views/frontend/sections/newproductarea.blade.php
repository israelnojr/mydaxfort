<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="main_title">
            <h2><span>new products</span></h2>
            <p>Bring called seed first of third give itself now ment</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
        @foreach($productAd as $product)
            <div class="new_product">
                <h5 class="text-uppercase">{{$product->category->name}}</h5>
                <h3 class="text-uppercase">{{$product->name}}</h3>
                <div class="product-img">
                <img class="img-fluid" src="{{asset('images/product/'.$product->image)}}" alt="{{$product->slug}}" style=" width:100%; height: 300px;"/>
            </div>
                <h4>₦ {{$product->price}}</h4>
                <form action="{{route('cart.store')}}" method="post">
                    @csrf()
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="hidden" name="name" value="{{$product->name}}">
                    <input type="hidden" name="price" value="{{$product->price}}">
                    <input type="hidden" name="qty" value="1">
                    <button class="main_btn">Add to Cart</button>
                </form>
            </div>
        @endforeach
        </div>
    
        <div class="col-lg-6 mt-5 mt-lg-0">
            <div class="row">
            @foreach($lastestProducts as $product)
                <div class="col-lg-6 col-md-6">
                    <div class="single-product">
                    <div class="product-img">
                        <img class="img-fluid w-100" src="{{asset('images/product/'.$product->image)}}" alt="{{$product->slug}}" style="height: 250px;" />
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
                        <span class="mr-4">₦ {{$product->price}}</span>
                        <!-- <del>$35.00</del> -->
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach
            
            </div>
        </div>
    </div>
</div>