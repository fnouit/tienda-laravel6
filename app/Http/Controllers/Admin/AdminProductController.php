<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre = $request->get('nombre');

        $productos = Product::where('nombre','like',"%$nombre%")->orderBy('id', 'desc')->paginate(3);
        return view('admin.product.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Category::orderBy('id')->get();
        return view('admin.product.create',compact('categorias'));
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
            'descripcion_corta.required'=>'Es necesario ingresar al menos una descripcion',
        ];
        $reglas = [
            'nombre' => 'required|unique:products,nombre',
            'slug' => 'required|unique:products,slug',
            'descripcion_corta' => 'required',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        $this->validate($request, $reglas, $mensaje);


        $urlimagenes = [];

        if($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');
            foreach($imagenes as $img) {
                $nombre = time().'_'.$img->getClientOriginalName();
                $ruta = public_path().'/imagenes';
                $img->move($ruta,$nombre);
                $urlimagenes[]['url'] = '/imagenes/'.$nombre;
            }
        }


        $producto = new Product;

        $producto->visitas              =    $request->visitas;
        $producto->ventas               =    $request->ventas;
        $producto->category_id          =    $request->category_id;
        $producto->cantidad             =    $request->cantidad;
        $producto->nombre               =    $request->nombre;
        $producto->slug                 =    $request->slug;
        $producto->precio_anterior      =    $request->precioanterior;
        $producto->precio_actual        =    $request->precioactual;
        $producto->porcentaje_descuento =    $request->porcentajededescuento;
        $producto->descripcion_corta    =    $request->descripcion_corta;
        $producto->descripcion_larga    =    $request->descripcion_larga;
        $producto->especificaciones     =    $request->especificaciones;
        $producto->datos_de_interes     =    $request->datos_de_interes;
        $producto->estado               =    $request->estado;
        
        if ($request->activo) {
            $producto->activo = "Si";
        } else {
            $producto->activo = "No";
        }

        if ($request->sliderprincipal) {
             $producto->sliderprincipal = "Si";
        } else {
             $producto->sliderprincipal = "No";
        }


        $producto->save();

        $producto->images()->createMany($urlimagenes);

        // return $producto->images;

        return redirect()->route('admin.product.index')->with('datos','ha sido creado con éxito.');

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
