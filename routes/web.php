<?php

use App\Product;
use App\Category;
use App\Image;

/* #Hacer pruebas con las imagenes
    Route::get('/prueba', function () {
        


    });


    #Mostrar resultados
    Route::get('/resultados', function () {
        $image = App\Image::orderBy('id','Desc')->get();
        return $image;
    }); 
*/

Route::get('/', function () {
    return view('tienda.index');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/admin/crear', 'Admin/AdminController@create')->name('admin.create');

Route::get('/admin', function () {
    return view('plantilla.admin');
})->name('admin');

Route::resource('admin/category','Admin\AdminCategoryController')->names('admin.category');
Route::resource('admin/product','Admin\AdminProductController')->names('admin.product');
Route::get('cancelar/{ruta}',function ($ruta){
    return redirect()->route($ruta)->with('cancelar','ha sido cancelado con éxito.');
})->name('cancelar');