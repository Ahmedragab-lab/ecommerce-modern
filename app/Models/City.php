<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nicolaslopezj\Searchable\SearchableTrait;

class City extends Model
{
    use HasFactory,SearchableTrait;
    protected $guarded=[];
    public $timestamps = false;
    protected $searchable = [
        'columns' => [
            'cities.name' => 10,
        ]
    ];
    public function Status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
    public function state(): BelongsTo    {
        return $this->belongsTo(State::class);
    }

}
