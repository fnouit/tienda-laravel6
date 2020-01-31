<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class AdminCategoryController extends Controller
{
    # Constructor para verificar si esta autentificado
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre = $request->get('nombre');

        $categorias = Category::where('nombre','like',"%$nombre%")->orderBy('id', 'desc')->paginate(3);
        return view('admin.category.index',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensaje = [
            'nombre.required' => 'El campo nombre es requerido',
            'descripcion.required'=>'Es necesario ingresar al menos una descripcion',
        ];
        $reglas = [
            'nombre' => 'required|unique:categories,nombre',
            'descripcion' => 'required',
        ];

        $this->validate($request, $reglas, $mensaje);

        $categoria = new Category;

        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->slug = $request->slug;
        $categoria->save();

        return redirect()->route('admin.category.index')->with('datos','ha sido creado con éxito.');

        // return $categoria;
        
        # protejiendo el Model Category -> protected $fillable
        // return Category::create($request->all);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $categoria = Category::where('slug',$slug)->firstOrFail();
        $editar = true;
        return view('admin.category.show',compact('categoria','editar')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categoria = Category::where('slug',$slug)->firstOrFail();
        $editar = true;
        return view('admin.category.edit',compact('categoria','editar')); 
        // return $categoria;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria = Category::findOrFail($id);
        
        $mensaje = [
            'nombre.required' => 'El campo nombre es requerido',
            // 'descripcion.required'=>'Es necesario ingresar al menos una descripcion'
        ];
        $reglas = [
            'nombre' => 'required|unique:categories,nombre,'.$categoria->id,
            // 'descripcion' => 'required,'.$categoria->id
        ];
        
        $this->validate($request, $reglas, $mensaje);
        
        $categoria->fill($request->all())->save();
        // return $categoria;
        return redirect()->route('admin.category.index')->with('datos','ha sido actualizado con éxito.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        
        Category::where('slug',$slug)->firstOrFail()->delete();
        return redirect()->route('admin.category.index')->with('borrar','ha sido borrada con éxito.');
        
        // return Category::where('slug',$slug)->firstOrFail()->delete();
        // Product::find(1)-> delete();
    }
}