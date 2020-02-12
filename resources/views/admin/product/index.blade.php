@extends('plantilla.admin')
@section('titulo', 'Administración de Productos')

@section('breadcrumb')
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
<!-- /.row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sección de productos</h3>

                <div class="card-tools">

                    <form action="" method="get">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="nombre" class="form-control float-right" placeholder="Buscar..." value="{{request()->get('nombre')}}" >

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>                    
                    </form>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 800px;">
                <a href="{{route('admin.product.create')}}" class="m-2 float-right btn btn-success btn-sm"><i
                        class="fas fa-plus"></i>&nbspCrear nueva</a>
                <table class="table table-head-fixed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Slug</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Activo</th>
                            <th>Sliderprincipal</th>
                            <th>Cantidad</th>
                            <th colspan="3">Configuración</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                        <tr>


                            <td>{{$producto->id}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->category->nombre}}</td>
                            <td>${{$producto->precio_actual}}</td>
                            <td>{{$producto->slug}}</td>
                            <td>{{$producto->descripcion_corta}}</td>
                            <td>{{$producto->estado}}</td>
                            <td>{{$producto->activo}}</td>
                            <td>{{$producto->sliderprincipal}}</td>
                            <td>{{$producto->cantidad}}</td>










                            <td class="project-actions text-right">
                                <form class="form-inline"
                                    action="{{route('admin.product.destroy',[$producto->slug])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-primary btn-sm"
                                        href="{{route('admin.product.show',[$producto->slug])}}">
                                        <i class="fas fa-folder"></i> Ver
                                    </a>&nbsp;
                                    <a class="btn btn-info btn-sm"
                                        href="{{route('admin.product.edit',[$producto->slug])}}">
                                        <i class="fas fa-pencil-alt"></i> Editar
                                    </a>&nbsp;
                                    <button type="button" class="btn btn-danger  btn-sm" data-toggle="modal"
                                        data-target="#modal-sm">
                                        <i class="fas fa-trash"></i> Borrar
                                    </button>
                                    <div class="modal fade" id="modal-sm">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Borrar</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Seguro que deseas borrar esta categoría &hellip;</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Borrar</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <div class="form-group">
                    {{ $productos->appends($_GET)->links() }}
                </div>
            </div><!-- /.card-footer-->











        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->
@endsection