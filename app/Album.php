<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $guarded = [];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
