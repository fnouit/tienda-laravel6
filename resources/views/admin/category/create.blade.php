@extends('plantilla.admin')
@section('titulo', 'Crear Categoría')
@section('contenido')

<div id="apicategory">
  <!-- Default box -->
  <div class="card">
      <form action="" method="get">
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
                      rows="5"></textarea>
              </div>
              <div class="form-group">
                  <label for="slug">Slug</label>
                  <input readonly v-model="generarSlug" type="text" name="slug" id="slug" class="form-control">
              </div>
              <div class="form-group">
                  <div v-if="div_slug_aparecer" v-bind:class="div_slug_class" v-text="div_slug_disponible"></div>
              </div>


          </div>
          <!-- /.card-body -->
          <div class="card-footer">
              <div class="form-group">
                  <input type="submit" value="Guardar" class="btn btn-primary float-right" id="guardar"
                      :disabled="btn_terms">
              </div>
          </div><!-- /.card-footer-->
      </form>
  </div><!-- /.card -->
</div><!-- /.app -->
@endsection