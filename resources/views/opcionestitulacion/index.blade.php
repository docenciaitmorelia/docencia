@extends('layouts.app')
@section('content')
@if(Auth::user()->rol == 'DivEstProf')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-4">
					<a href="{{ route('opcionestitulacionCtl.create') }}" class="btn btn-raised btn-primary"><i class="material-icons">add</i></a>
				</div>
        <!-- Elocuent para cuadro de búsqueda -->
				<form action="" method="GET" class="form-horizontal">
				<div class="col-md-6 form-group">
					<input maxlength="255" type="text" id="s" name="s" style="text-transform:uppercase;" placeholder="Buscar opción de titulación..." class="form-control">
				</div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-raised btn-primary"><i class="material-icons">search</i></button>
				</div>
				</form>
        <!-- Fin Elocuent para cuadro de búsqueda -->


			@include('fragment.info')
      <div class="card">
        <div class="card-body">
    			<h3 class="card-title">Opciones de Titulación</h3>
    			<table class="table table-striped table-hover">
    				<thead>
    					<tr>
    						<th>Opción de Titulación</th>
    						<th>Nombre</th>
    			      <th>Tipo</th>
    						<th>Retícula(s)</th>
    					</tr>
    				</thead>
    				<tbody>
    					@foreach($Array as $item)
    						<tr>
    							<td>
    								<strong>{{ $item->opcion_titulacion }}</strong>
    							</td>
    							<td>
    								<strong>{{ $item->nombre_opcion }}</strong>
    							</td>
                  <td>
                      <strong>{{ $item->detalle_opcion}}</strong>
                  </td>
                  <td>
                    @foreach($Reticulas as $ret)
                      @if($ret->id_opcion_titulacion == $item->id)
                        <strong>{{ $ret->reticula}}</strong>
                      @endif
                    @endforeach
                  </td>
    							<td width="20px">
    								<a href="{{ route('opcionestitulacionCtl.edit', $item->id) }}"class="btn btn-raised btn-primary">
    									<i class="material-icons">create</i>
    								</a>
    							</td>
    							<td width="20px">
    								<form action="{{ route('opcionestitulacionCtl.destroy', $item->id) }}" method="POST">
    									{{ csrf_field() }}
    									<input type="hidden" name="_method" value="DELETE">
    									<button class="btn btn-raised btn-primary"><i class="material-icons">clear</i></button>
    							</td>
    						</tr>
    					@endforeach
    				</tbody>
    			</table>
        </div>
      </div>
		</div>
	</div>
</div>
</div>
@endif
@endsection
