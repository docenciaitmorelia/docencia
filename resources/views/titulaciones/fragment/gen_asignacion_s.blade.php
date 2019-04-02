@extends('layout')

@section('content')
@foreach($alumno as $al)
<center>
<div class="col-md-12">
<h3><strong>Asignación de Sinodales</strong></h3>
<br>
<h4> <b>{{$al->no_de_control}} — {{$al->apellido_paterno}} {{$al->apellido_materno}} {{$al->nombre_alumno}}</b></h4>
</div>
</center>
@endforeach
@foreach($titulacion as $titu)
<hr>
<center><h5><i>{{$titu->nombre_opcion}}</i></h5></center>

	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th><center>Asesor</center></th>
				<th colspan="3"> <center>Sinodales</center></th>
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
						{{ $titu->vocal_suplente }}
					</td>
                    
                    <td>
						{{ $titu->vocal_suplente }}
					</td>
				</tr>
		</tbody>
	</table>
	<br>
@endforeach
	<form action="../crear_asignacion_s/{{$al->no_de_control}}" method="POST" target="_blank">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="col-md-6">
			<label for="oficio" class="control-label">Oficio</label>
			<input type="text" id="oficio" name="oficio" class="form-control" placeholder="DSC-D-001/2018">
		</div>
		<p class="col-md-12">
			<button type="submit" class="btn btn-raised btn-primary">Generar PDF</button>
			<a href="{{ route('titulaciones.index') }}" class="btn btn-raised btn-primary">Regresar</a>
		</p>
	</form>
@endsection