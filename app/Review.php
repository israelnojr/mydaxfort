<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // protected $guarded = [];
    protected $fillable = [
        'product_id',
        'title',
        'review',
        'rating'
    ];

    public function product()
    {
      return  $this->belongsTo(Product::class);
    }

    public function user()
    {
      return  $this->belongsTo(User::class);
    }
}
