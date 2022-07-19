<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laratrust\Traits\LaratrustUserTrait;
class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable ,SearchableTrait;

    protected $guarded=[];
    protected $appends=['full_name'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public $searchable = [
        'columns' => [
            'users.firstname' => 10,
            'users.lastname' => 10,
        ]
    ];
       //scope
       public function userImage()
       {
           return asset('images/users/'.$this->image);
       }
       public function adminImage()
       {
           return asset('images/admins/'.$this->image);
       }
       public function status(): string
       {
           return $this->status ? 'Active' : 'Inactive';
       }
       public function created_at()
       {
           return $this->created_at->format('Y-m-d');
       }
    //attribute
       public function getFullNameAttribute()
       {
           return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
       }
    //relations
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }
}
