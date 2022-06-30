<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProductCategory extends Model
{
    use HasFactory, Sluggable,SearchableTrait;
    protected $guarded = [];
    //func ***********************************************************************************************************************
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    protected $searchable = [
        'columns' => [
            'product_categories.name' => 10,
        ]
    ];
    //scopes ***********************************************************************************************************************
    public function status()
    {
        return $this->status ? 'Active' : 'Inactive';
    }
    public function parents()
    {
        return $this->parent->name ?? null ;
    }
    public function created_at()
    {
        return $this->created_at->format('Y-m-d') ;
    }
    //rel ***********************************************************************************************************************
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function parent()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id');
    }
    public function appearedChildren()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id')->where('status',true);
    }

    public static function tree( $level = 1 )
    {
        return static::with(implode('.', array_fill(0, $level, 'children')))
            ->whereNull('parent_id')
            ->whereStatus(true)
            ->orderBy('id', 'asc')
            ->get();
    }
}
