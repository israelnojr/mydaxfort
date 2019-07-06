@extends('frontend.layout')
@section('content')

  <!--================Home Banner Area =================-->
  <section class="home_banner_area mb-40">
    @include('frontend.sections.homebanner')
  </section>
  <!--================End Home Banner Area =================-->

  <!-- Start feature Area -->
  <section class="feature-area section_gap_bottom_custom">
    @include('frontend.sections.featurearea')
  </section>
  <!-- End feature Area -->

  <!--================ Feature Product Area =================-->
  <section class="feature_product_area section_gap_bottom_custom">
    @include('frontend.sections.featuredproducts')
  </section>
  <!--================ End Feature Product Area =================-->

  <!--================ Offer Area =================-->
  <section class="offer_area">
    @include('frontend.sections.offerarea')
  </section>
  <!--================ End Offer Area =================-->

  <!--================ New Product Area =================-->
  <section class="new_product_area section_gap_top section_gap_bottom_custom">
   @include('frontend.sections.newproductarea')
  </section>
  <!--================ End New Product Area =================-->

  <!--================ Inspired Product Area =================-->
  <section class="inspired_product_area section_gap_bottom_custom">
   @include('frontend.sections.inspiredproductarea')
  </section>
  <!--================ End Inspired Product Area =================-->

  <!--================ Start Blog Area =================-->
  <section class="blog-area section-gap">
    @include('frontend.sections.blogarea')
  </section>
  <!--================ End Blog Area =================-->
@endsection