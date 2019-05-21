<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Reporte</title>
</head>
<body>
	@if($periodo == 'E-J')
		<h2>ENERO - JUNIO {{$a}}</h2>
		<h4>Titulaciones por opción de titulación</h4>
		@foreach($su as $s)
			{{$s->opcion}}: {{$s->total}}
			<br>
		@endforeach
		<hr>
		<table border="1px" bordercolor="black">
			@foreach($su as $s1)
			<thead>
				<tr>
					<th colspan="7"><center>{{ $s1->opcion }}: {{ $s1->total }}</center></th>
				<tr>
					<th>Egresado</th>
					<th>Reticula</th>
					<th><center>Proyecto</center></th>
					<th>Presidente</th>
					<th>Secretario</th>
					<th>Vocal Propietario</th>
					<th>Vocal Suplente</th>
					<th>Fecha de Ceremonia</th>
				</tr>
			</thead>
			<tbody>
				@foreach($titu as $t)

					@if($t->opc_titu == $s1->opc_titu)
						<tr>
							<td>{{ $t->completo }}</td>
							<td>{{ $t->reticula }}</td>
							<td>{{ $t->proyecto }}</td>
							@if($t->asesor_externo == 'N')
							@foreach($asesor as $a)
							@if($t->asesor == $a->rfc && $t->alumno == $a->alumno)
							<td>
								<strong>{{ $a->asesor }}</strong>
							</td>
							@endif
							@endforeach
							<td>
								<strong>{{ $t->revisor1 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor2 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor3 }}</strong>
							</td>
							<td>
								<strong>{{ date('d-m-Y',strtotime($t->fecha_cer)) }}</strong>
							</td>
							@else
							<td>
								<strong>{{ $t->revisor1 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor2 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor3 }}</strong>
							</td>
							<td>
								<strong>{{ $t->asesor_externo }}</strong>
							</td>
							<td>
								<strong>{{ date('d-m-Y',strtotime($t->fecha_cer)) }}</strong>
							</td>
							@endif
						</tr>
					@endif
				@endforeach
			</tbody>
			@endforeach
		</table>

		<h3>Titulaciones por carrera</h3>
		@foreach($carrera as $c)
		@foreach($sc as $s)
		@if($s->carrera == $c->carrera)
		{{$c->nombre_carrera}} : {{$s->total}}
		<br>
		@endif
		@endforeach
		@endforeach
		<hr>
		<table border="1px" bordercolor="black">
			@foreach($carrera as $c)
			@foreach($sc as $s)
			@if($s->carrera == $c->carrera)
			<thead>

				<tr>
					<th colspan="8"><center>{{$c->nombre_carrera}} : {{$s->total}}</center></th>
				<tr>
					<th>Egresado</th>
					<th><center>Proyecto</center></th>
					<th>Opción de titulación</th>
					<th>Presidente</th>
					<th>Secretario</th>
					<th>Vocal Propietario</th>
					<th>Vocal Suplente</th>
					<th>Fecha de Ceremonia</th>
				</tr>
			</thead>
			<tbody>
				@foreach($titu as $t)

					@if($t->carrera == $s->carrera)
						<tr>
							<td>{{ $t->completo }}</td>
							<td>{{ $t->proyecto }}</td>
							<td>{{ $t->nombre_opcion }}</td>
							@if($t->asesor_externo == 'N')
							@foreach($asesor as $a)
							@if($t->asesor == $a->rfc && $t->alumno == $a->alumno)
							<td>
								<strong>{{ $a->asesor }}</strong>
							</td>
							@endif
							@endforeach
							<td>
								<strong>{{ $t->revisor1 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor2 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor3 }}</strong>
							</td>
							<td>
								<strong>{{ date('d-m-Y',strtotime($t->fecha_cer)) }}</strong>
							</td>
							@else
							<td>
								<strong>{{ $t->revisor1 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor2 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor3 }}</strong>
							</td>
							<td>
								<strong>{{ $t->asesor_externo }}</strong>
							</td>
							<td>
								<strong>{{ date('d-m-Y',strtotime($t->fecha_cer)) }}</strong>
							</td>
							@endif
						</tr>
					@endif
					@endforeach
			</tbody>
			@endif
			@endforeach
			@endforeach
		</table>
	@elseif($periodo == 'A-D')
		<h2>AGOSTO - DICIEMBRE {{$a}}</h2>
		<h4>Titulaciones por opción de titulación</h4>
		@foreach($su as $s)
			{{$s->opcion}}: {{$s->total}}
			<br>
		@endforeach
		<hr>
		<table border="1px" bordercolor="black">
			@foreach($su as $s1)
			<thead>
				<tr>
					<th colspan="7"><center>{{ $s1->opcion }}: {{ $s1->total }}</center></th>
				<tr>
					<th>Egresado</th>
					<th>Reticula</th>
					<th><center>Proyecto</center></th>
					<th>Presidente</th>
					<th>Secretario</th>
					<th>Vocal Propietario</th>
					<th>Vocal Suplente</th>
					<th>Fecha de Ceremonia</th>
				</tr>
			</thead>
			<tbody>
				@foreach($titu as $t)

					@if($t->opc_titu == $s1->opc_titu)
						<tr>
							<td>{{ $t->completo }}</td>
							<td>{{ $t->reticula}}</td>
							<td>{{ $t->proyecto }}</td>
							@if($t->asesor_externo == 'N')
							@foreach($asesor as $a)
							@if($t->asesor == $a->rfc && $t->alumno == $a->alumno)
							<td>
								<strong>{{ $a->asesor }}</strong>
							</td>
							@endif
							@endforeach
							<td>
								<strong>{{ $t->revisor1 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor2 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor3 }}</strong>
							</td>
							<td>
								<strong>{{ date('d-m-Y',strtotime($t->fecha_cer)) }}</strong>
							</td>
							@else
							<td>
								<strong>{{ $t->revisor1 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor2 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor3 }}</strong>
							</td>
							<td>
								<strong>{{ $t->asesor_externo }}</strong>
							</td>
							<td>
								<strong>{{ date('d-m-Y',strtotime($t->fecha_cer)) }}</strong>
							</td>
							@endif
						</tr>
					@endif
				@endforeach
			</tbody>
			@endforeach
		</table>

		<h3>Titulaciones por carrera</h3>
		@foreach($carrera as $c)
		@foreach($sc as $s)
		@if($s->carrera == $c->carrera)
		{{$c->nombre_carrera}} : {{$s->total}}
		<br>
		@endif
		@endforeach
		@endforeach
		<hr>
		<table border="1px" bordercolor="black">
			@foreach($carrera as $c)
			@foreach($sc as $s)
			@if($s->carrera == $c->carrera)
			<thead>

				<tr>
					<th colspan="8"><center>{{$c->nombre_carrera}} : {{$s->total}}</center></th>
				<tr>
					<th>Egresado</th>
					<th><center>Proyecto</center></th>
					<th>Opción de titulación</th>
					<th>Presidente</th>
					<th>Secretario</th>
					<th>Vocal Propietario</th>
					<th>Vocal Suplente</th>
					<th>Fecha de Ceremonia</th>
				</tr>
			</thead>
			<tbody>
				@foreach($titu as $t)

					@if($t->carrera == $s->carrera)
						<tr>
							<td>{{ $t->completo }}</td>
							<td>{{ $t->proyecto }}</td>
							<td>{{ $t->nombre_opcion }}</td>
							@if($t->asesor_externo == 'N')
							@foreach($asesor as $a)
							@if($t->asesor == $a->rfc && $t->alumno == $a->alumno)
							<td>
								<strong>{{ $a->asesor }}</strong>
							</td>
							@endif
							@endforeach
							<td>
								<strong>{{ $t->revisor1 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor2 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor3 }}</strong>
							</td>
							<td>
								<strong>{{ date('d-m-Y',strtotime($t->fecha_cer)) }}</strong>
							</td>
							@else
							<td>
								<strong>{{ $t->revisor1 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor2 }}</strong>
							</td>
							<td>
								<strong>{{ $t->revisor3 }}</strong>
							</td>
							<td>
								<strong>{{ $t->asesor_externo }}</strong>
							</td>
							<td>
								<strong>{{ date('d-m-Y',strtotime($t->fecha_cer)) }}</strong>
							</td>
							@endif
						</tr>
					@endif
					@endforeach
			</tbody>
			@endif
			@endforeach
			@endforeach
		</table>

	@endif
</body>
</html>
