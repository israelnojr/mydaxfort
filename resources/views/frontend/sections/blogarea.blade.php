<div class="container">
    <div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="main_title">
        <h2><span>Products By Category</span></h2>
        <p>Browse list of product by category</p>
        </div>
    </div>
    </div>
    <div class="row">
    @foreach($bestsellingProducts as $product)
    <div class="col-lg-4 col-md-6">
        <div class="single-blog">
        <div class="thumb">
            <img class="img-fluid" src="{{asset('images/product/'.$product->image)}}" alt="">
        </div>
        <div class="short_details">
            <a class="d-block" href="{{route('category.index', ['category' => $product->category->slug])}}">
            <h4>{{$product->name}}</h4>
            </a>
            <div class="text-wrap">
            <p>
                {{$product->short_desc}}
            </p>
            </div>
        </div>
        </div>
    </div>
    @endforeach
    </div>
</div>