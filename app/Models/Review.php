<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nicolaslopezj\Searchable\SearchableTrait;

class Review extends Model
{
    use HasFactory, SearchableTrait;
    protected $guarded =[];
    public $searchable = [
        'columns' => [
            'reviews.name' => 10,
            'reviews.email' => 10,
            'reviews.title' => 10,
            'reviews.message' => 10,
        ]
    ];
    //scope
    public function status(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }
    public function created_at()
    {
        return $this->created_at->format('Y-m-d');
    }
    //Relations
        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }

        public function product(): BelongsTo
        {
            return $this->belongsTo(Product::class);
        }

}
