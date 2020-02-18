<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'url', 'email', 'password',
    ];

    public function imageable() {
        return $this->morphTo();
        #morphTo trae todos los datos relacionados
        #$image = Image::find(1)->imageable();
    }
}
