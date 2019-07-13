<?php

namespace Mydaxfort\Http\Controllers;

use Mydaxfort\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::take(3)->inRandomOrder()->get();
        $inspiredProducts = Product::orderBy('created_at','asc')->take(6)->get();
        $lastestProducts = Product::latest()->take(4)->get();
        $productAd = Product::take(1)->inRandomOrder()->get();
        return view('welcome', compact('featuredProducts', 'inspiredProducts', 'lastestProducts', 'productAd'));
    }
}
