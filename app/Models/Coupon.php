<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Coupon extends Model
{
    use HasFactory, SearchableTrait;
    protected $guarded = [];

    protected $dates = ['start_date', 'expire_date'];
    protected $searchable = [
        'columns' => [
            'coupons.code' => 10,
            'coupons.description' => 10,
        ]
    ];
    public function status()
    {
        return $this->status ? 'Active' : 'Inactive';
    }
    public function created_at()
    {
        return $this->created_at->format('Y-m-d');
    }
    public function start_date()
    {
        return $this->start_date->format('Y-m-d');
    }
    public function expire_date()
    {
        return $this->expire_date->format('Y-m-d');
    }
}
