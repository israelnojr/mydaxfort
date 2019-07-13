<?php

namespace Mydaxfort;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function category()
    {
       return $this->belongsTo(Category::class);
    }

    public function review()
    {
      return  $this->hasMany(Review::class);
    }

    public function getStarRating()
    {
       $count = $this->review()->count();
       if(empty($count)){
          return 0;
       }
       $starCountSum = $this->review()->sum('rating');
       $average = $starCountSum/$count;

       return $average;
    }

    public function getReviewCount()
    {
      $count = $this->review()->count();

      return $count;
    }

    public function getUserStar()
    {
      //
    }
}
