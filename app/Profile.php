<?php

namespace Mydaxfort;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'description', 'image', 'name', 'email', 'password',
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating( function($profile){
            $profile->user()->update([
                'name' => $profile->name,
                'email' => $profile->email,
                'password' => $profile->password,
            ]);

        });
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
