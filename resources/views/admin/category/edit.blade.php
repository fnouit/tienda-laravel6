@extends('plantilla.admin')
@section('titulo', 'Editar Categoría')


@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Categoría</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection


@section('contenido')

<form action="{{route('admin.category.update',$categoria->id)}}" method="post">
    @csrf
    @method('PUT')
    <div id="apicategory">
        <span style="display:none;" id="editar">{{$editar}}</span>
        <span style="display:none;" id="nombretemp">{{$categoria->nombre}}</span>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Administración de Categorías</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input v-model="nombre" type="text" @blur="getCategory" @focus="div_slug_aparecer = false"
                        name="nombre" id="nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control" cols="30"
                        rows="5">{{$categoria->descripcion}}</textarea>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input readonly v-model="generarSlug" type="text" name="slug" id="slug" class="form-control">
                </div>
                <div class="form-group">
                    <h5 class="mt-3">
                        <div v-if="div_slug_aparecer" v-bind:class="div_slug_class" v-text="div_slug_disponible"></div>
                    </h5>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="form-group">
                    <a class="btn btn-danger btn-sm" href="{{route('cancelar',['admin.category.index'])}}">
                        <i class="fas fa-trash"></i> Cancelar
                    </a>

                    <input type="submit" value="Guardar" class="btn btn-primary float-right" id="guardar">
                </div>
            </div><!-- /.card-footer-->
        </div><!-- /.card -->
    </div><!-- /.app -->
</form>
@endsection