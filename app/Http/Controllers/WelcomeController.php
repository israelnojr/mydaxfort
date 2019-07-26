<?php

namespace Mydaxfort\Http\Controllers;

use Mydaxfort\Product;
use Mydaxfort\HeroHeader;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::take(6)->inRandomOrder()->get();
        $inspiredProducts = Product::orderBy('created_at','asc')->take(12)->get();
        $bestsellingProducts = Product::orderBy('created_at','desc')->take(3)->get();
        $lastestProducts = Product::latest()->take(4)->get();
        $productAd = Product::take(1)->inRandomOrder()->get();
        $hero = HeroHeader::take(1)->inRandomOrder()->get();
        return view('welcome', compact('featuredProducts', 'inspiredProducts', 'lastestProducts', 'productAd','hero','bestsellingProducts'));
    }
}
