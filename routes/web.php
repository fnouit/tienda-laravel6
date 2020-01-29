<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
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
Route::get('cancelar/{ruta}',function ($ruta){
    return redirect()->route('admin.category.index')->with('cancelar','ha sido cancelado con éxito.');
})->name('cancelar');