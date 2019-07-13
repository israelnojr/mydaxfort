<?php

namespace Mydaxfort;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created( function($user){
            $user->profile()->create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'description' => "I'm ". $user->name,
                'image' => "adminlte.jpg"
            ]);

        });
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function heroHeader()
    {
        return $this->hasMany(HeroHeader::class);
    }
}
