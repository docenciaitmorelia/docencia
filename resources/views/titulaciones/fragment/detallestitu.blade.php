@extends('layout')

@section('content')
@foreach($alumno as $al)
<center>
<div class="col-md-12">
<h3> <b>{{$al->no_de_control}} — {{$al->apellido_paterno}} {{$al->apellido_materno}} {{$al->nombre_alumno}}</b></h3>
</div>
</center>
@endforeach
@foreach($titulacion as $titu)
<hr>
<center><h5><i>{{$titu->nombre_opcion}}<br>Estatus de proceso de Titulación: {{$estatus}}</i></h5></center>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><center>Asesor</center></th>
				<th colspan="4"> <center>Sinodales</center></th>
				<th colspan="1"></th>
			</tr>
		</thead>
		<tbody>
			
				<tr>
					<td>{{ $titu->asesor }}</td> 
					
					<td>
						{{ $titu->presidente }}
					</td>
					
					<td>
						{{ $titu->secretario }}
					</td>
					
					<td>
						{{ $titu->vocal_propietario}}
					</td>
                    
                    <td>
						{{ $titu->vocal_suplente}}
					</td>
                    
					<td>
						<a href="{{ route('titulaciones.edit', $titu->id) }}" class="btn btn-raised btn-primary"><i class="material-icons">create</i></a>
					</td>
				</tr>
		</tbody>
	</table>
	<br>
@endforeach
    <div class="col-md-6">
    <p>Proceso de titulación: </p>
    
    @foreach($proceso as $p)
        <input type="checkbox" name="proceso" value="{{$p->orden}}" @if($orden >= $p->orden) checked='' disabled=''> <p class="label label-success">{{$p->descripcion}} @else disabled=''> <p class="label label-default">{{$p->descripcion}}@endif</p><br>
    @endforeach
    </div>
    <div class="col-md-6">
    @if($estatus=='ACTIVO')
	<form action="{{ route('gen_documentos', $al->no_de_control) }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="col-md-12">
			<label for="documento" class="control-label">Tipo de Documento</label>
			<select id="documento" name="documento" class="form-control">
      			<option value="">Seleccione documento a generar</option>
		      	<option value="1">Asignación de Sinodales</option>
		      	<option value="2">Impresión definitiva</option>
		      	<option value="3">Asignación de revisor</option>
		      	<option value="4">Liberación de proyecto</option>
                <option value="5">Cambio de Sinodales</option>
		    </select>
		</div>
		<p class="col-md-12">
			<button type="submit" class="btn btn-raised btn-primary">Generar Documento</button>
			<a href="{{ route('titulaciones.index') }}" class="btn btn-raised btn-primary">Regresar</a>
		</p>
	</form>
    </div>
@else
    <p class="col-md-12">
			<a href="{{ route('titulaciones.index') }}" class="btn btn-raised btn-primary">Regresar</a>
		</p>
@endif
@endsection