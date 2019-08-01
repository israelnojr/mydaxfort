<div class="banner_inner d-flex align-items-center">
    <div class="container">
    @foreach($hero as $banner)
        <div class="banner_content row">
            <div class="col-lg-12">
                <p class="sub text-uppercase">{{$banner->category->name}} Collections</p>
                <h3><span>{{$banner->title}}</span></h3>
                <h4>{{$banner->short_desc}}</h4>
                <a class="main_btn mt-40" href="{{route('category.index', ['category' => $banner->category->slug])}}">View Collection</a>
            </div>
        </div>
        <style>
            .home_banner_area {
            background: url({{asset('images/heroHeader/'.$banner->image)}}) no-repeat center bottom;
        }
        </style>
    @endforeach
    </div>
</div>