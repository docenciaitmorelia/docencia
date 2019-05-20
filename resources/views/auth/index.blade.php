@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-body">
      @if(Auth::user()->rol == 'Administrador')
        <h3 class="card-title">{{ __('Administrar Usuarios') }}</h3>
        <div class="row">
          <div class="col s12">

              <table class="table table-striped table-hover">
    						<thead>
    							<tr>
    								<th>Usuario</th>
    								<th>ID</th>
    								<th>ROL</th>
    								<th>Área</th>
    				        <th>Email</th>
    								<th colspan="1">&nbsp;</th>
    							</tr>
    						</thead>
    						<tbody>
    						@foreach($Usuarios as $usuario)
    								<tr>
    									<td> {{ $usuario->name }}</td>
    									<td>
    										<strong>{{ $usuario->id }}</strong>
    									</td>
    									<td>
    										<strong>{{ $usuario->rol }}</strong>
    									</td>
    									<td>
    										<strong>{{ $usuario->descripcion_area }}</strong>
    									</td>
    				          <td>
    				            {{ $usuario->email }}
    				          </td>
    									<td>
                        <a href="{{ route('usuariosCtl.edit',$usuario->id) }}" class="card-link"><i class="material-icons">create</i></a>
                        <a data-toggle="modal" data-target="#modal{{ $usuario->id }}" class="card-link modal-trigger" href="#modal{{ $usuario->id }}"><i class="material-icons">delete</i></a>
                        <!-- Modal Structure -->
                          <div id="modal{{ $usuario->id }}" class="modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Eliminar</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form action="{{ route('usuariosCtl.destroy',$usuario->id) }}" method="POST" id='form-{{ $usuario->id }}'>
                                      {{ csrf_field() }}
                                      {{ method_field('DELETE') }}
                                  </form>
                                  <p>¿Seguro que deseas eliminar el usuario {{ $usuario->name }}?</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('form-{{ $usuario->id }}').submit();">Sí, Quiero Eliminar el Registro</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                      </td>
    								</tr>
                    @endforeach
    						</tbody>
    					</table>

            </div>
          </div>
        @else
          <h3 class="card-title">{{ __('Usuario No Autorizado') }}</h3>
            <p class="card-text">No tienes los suficientes privilegios para acceder a este módulo.</p>
        @endif


        @if(Auth::user()->rol == 'Administrador')
          <a type="button" href="{{ route('usuariosCtl.create') }}" class="btn btn-primary bmd-btn-fab">
            <i class="material-icons">add</i>
          </a>
          <a type="button" href="{{ route('home') }}" class="btn btn-primary bmd-btn-fab">
            <i class="material-icons">home</i>
          </a>
        @endif
        <script type="text/javascript">
        $('.modal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
        })
        </script>
      </div>
    </div>
  </div>
</div>
@endsection
