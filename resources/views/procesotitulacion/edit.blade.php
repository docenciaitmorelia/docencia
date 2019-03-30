@extends('layouts.app')
@section('content')
@if(Auth::user()->rol == 'DivEstProf')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title"> Editar Etapa para Proceso de Titulación</h3>
          <form action="{{ route('procesotitulacion.update', $procesotitulacion->id) }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('PUT')}}

              <div class="col-md-4">
                  <label for="opcion" class="control-label">Opción de titulación</label>
                  <select id="opcion" name="opcion" class="form-control" required>
                      <option value="{{$procesotitulacion->id}}" selected>{{ $procesotitulacion->nombre_opcion }}</option>
                      @foreach($opcion as $op)
                      <option value="{!! $op->id !!}" {{(old('opcion',$procesotitulacion->id_opcion)==$op->id)? 'selected':''}}>{!! $op->nombre_opcion !!}</option>
                      @endforeach
                  </select>
              </div>

              <div class="col-md-4">
                  <label class="control-label" for="orden">Paso número:</label>
                  <input class="form-control" type="number" id="orden" name="orden" value="{{ old('orden', $procesotitulacion->orden) }}" required>
              </div>

              <div class="col-md-4">
                  <label class="control-label" for="descripcion">Descripción del paso:</label>
                  <input class="form-control" type="text" id="descripcion" name="descripcion" value="{{ old('descripcion', $procesotitulacion->descripcion) }}" required>
              </div>

              <p class="col-md-12 form-group">
                  <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
                  <a name="cancel" id="cancel" data-toggle="modal" data-target="#modal1" href="#modal1" class="btn btn-raised btn-primary">Cancelar</a>
              </p>

              <!-- Modal Structure -->
              <div id="modal1" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title">Eliminar</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('procesotitulacion.index') }}" method="POST" id='form-modal1'>
                          {{ csrf_field() }}
                      </form>
                      <p>¿Seguro de que desea cancelar?</p>
                    </div>
                    <div class="modal-footer">
                      <a href="{{ route('procesotitulacion.index') }}" type="button" class="btn btn-primary" >Aceptar</a>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                  </div>
                </div>
              </div> <!-- end modal structure -->
          </form>
        </div>
      </div>
    </div>
  </div>
@endif
@endsection
