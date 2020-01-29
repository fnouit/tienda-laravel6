<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //línea necesaria

class Category extends Model
{
    use SoftDeletes; //Implementamos 
    
    protected $fillable = ['nombre','slug','descripcion'];
    
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
