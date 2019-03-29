@extends('layouts.app')
@section('content')
@if(Auth::user()->rol == 'DivEstProf')

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Registro de Opciones de Titulación</h3>
        @include('fragment.error')
        <form action="{{ route('opcionestitulacionCtl.store') }}" method="POST">
            @csrf
            <div class="form-group col-md-6">
                <label for="opcion_titulacion" class="bmd-label-floating col-form-label">{{ __('Opción de Titulación') }}</label>
                    <input id="opcion_titulacion" type="text" class="form-control{{ $errors->has('opcion_titulacion') ? ' is-invalid' : '' }}" name="opcion_titulacion" value="" placeholder="I" required autofocus>
                    @if ($errors->has('opcion_titulacion'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('opcion_titulacion') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group col-md-6">
                <label for="nombre_opcion" class="bmd-label-floating col-form-label">{{ __('Nombre') }}</label>
                    <input id="nombre_opcion" type="text" class="form-control{{ $errors->has('nombre_opcion') ? ' is-invalid' : '' }}" name="nombre_opcion" value="" placeholder="Titulación Integral Por ..." required>
                    @if ($errors->has('nombre_opcion'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nombre_opcion') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group col-md-6">
                <label for="detalle_opcion" class="bmd-label-floating col-form-label">{{ __('Descripción') }}</label>
                    <input id="detalle_opcion" type="text" class="form-control{{ $errors->has('detalle_opcion') ? ' is-invalid' : '' }}" name="detalle_opcion" value="" placeholder="Ejemplo: Producto de Investigación..." required>
                    @if ($errors->has('detalle_opcion'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('detalle_opcion') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group col-md-6">
                <label for="plan_de_estudios" class="bmd-label-floating col-form-label">{{ __('Plan de Estudios') }}</label>
                    <select id="plan_de_estudios" type="text" class="form-control{{ $errors->has('plan_de_estudios') ? ' is-invalid' : '' }}" name="plan_de_estudios" value="" required>
                      @foreach($Array as $item)
                        <option id="plan_de_estudios" value="{{ $item->clave_oficial }}">{{$item->clave_oficial}}, {{$item->nombre_reducido}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('plan_de_estudios'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('plan_de_estudios') }}</strong>
                        </span>
                    @endif
            </div>


          <p class="col-md-12 form-group">
              <button type="submit" class="btn btn-raised btn-primary">Guardar</button>
              <a name="cancel" id="cancel" data-toggle="modal" data-target="#modal1" href="#modal1" class="btn btn-raised btn-primary">Cancelar</a>
          </p>
        </form>

        <!-- Modal Structure -->
        <div id="modal1" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('opcionestitulacionCtl.index') }}" method="POST" id='form-modal1'>
                    {{ csrf_field() }}
                </form>
                <p>¿Seguro de que desea cancelar?</p>
              </div>
              <div class="modal-footer">
                <a href="{{ route('opcionestitulacionCtl.index') }}" type="button" class="btn btn-primary" >Aceptar</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
