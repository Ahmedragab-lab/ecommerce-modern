<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;
use Nicolaslopezj\Searchable\SearchableTrait;
class Role extends LaratrustRole
{
    use SearchableTrait;
    public $guarded = [];
    protected $searchable = [
        'columns' => [
            'roles.name' => 10,
        ]
    ];
    public function created_at()
    {
        return $this->created_at->format('Y-m-d') ;
    }
}
