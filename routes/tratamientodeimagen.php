<?php

    #Revisar si un producto o usuario tiene una imagen.
        $usuario = App\User::find(1);
        $image = $usuario->image;
        
        if($image) {
            echo 'tiene una imagen';
        } else {
            echo 'no tiene una imagen';
        }
        return $image;
    #
    #01 Crear una imagen para un usuario utilizando el metodo save
        $imagen = new App\Image(['url'=>'imagenes/a.png']);
        $usuario = App\User::find(1);
        $usuario->image()->save($imagen);
        return $usuario;
    #

    #02 Obtener la información de las imagenes
        $usuario = App\User::find(1);
        return $usuario->image->url;
    #

    #03 Crear varias imagenes para un producto utilizando el metodo savemany
        $producto = App\Product::find(3);
        $producto->images()->saveMany([
            new App\Image(['url'=>'imagenes/avatar.png']),
            new App\Image(['url'=>'imagenes/avatar2.png']),
            new App\Image(['url'=>'imagenes/avatar3.png']),
        ]);
        return $producto->images;
    #

    #04 Crear una imagen para un usuario utilizando el metodo CREATE
        $imagen = new App\Image(['url'=>'imagenes/a.png']);
        $usuario = App\User::find(1);
        $usuario->image()->create([
            'url' => 'imagenes/avatar04.png',
        ]);
        return $usuario;    
    #

    #05 Crear una imagen para un usuario utilizando el metodo CREATE por array
        $imagen = [];
        $imagen['url'] = 'imagenes/avatar04.png';
        $usuario = App\User::find(1);
        $usuario->image()->create($imagen);
        return $usuario;   
    #

    #06 Crear varias imagen para un producto utilizando el metodo CREATEMANY por array
        $imagen = [];
        $imagen[]['url'] = 'imagenes/avatar.png';
        $imagen[]['url'] = 'imagenes/avatar2.png';
        $imagen[]['url'] = 'imagenes/avatar3.png';
        $imagen[]['url'] = 'imagenes/avatar04.png';
        $imagen[]['url'] = 'imagenes/a.png';

        $producto = App\Product::find(2);
        $producto->images()->createMany($imagen);

        return $producto->images;
    #     

    #07 Actualizar la imagen de usuario
        $usuario = App\User::find(1);
        $usuario->image->url='imagenes/bbb.png';
        $usuario->push();
        return $usuario->image; 
    #

    #08 Actualizar la url de los productos
        $producto = App\Product::find(3);

        $producto->images[0]->url='imagenes/ccc1.png';
        $producto->push();

        return $producto->images;
    #
    #09 Buscar el registro relacionado en la imagen
            
        $image = App\Image::find(5);

        return $image->imageable;
    #
    #10 Contar los registros relacionados a los productos
        $producto = App\Product::find(2);
        return $producto->loadCount('images');
    #
    #10 Otra forma Contar los registros relacionados a los productos
        $producto = App\Product::withCount('images')->get();
        $producto = $producto->find(2);
        return $producto->images_count;
    #




