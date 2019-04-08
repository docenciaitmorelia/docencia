<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Horario</title>
  	<link rel="stylesheet" type="text/css" href="{{ url('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('bower_components/bootstrap-material-design/dist/css/bootstrap-material-design.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('bower_components/bootstrap-material-design/dist/css/ripples.min.css') }}">
    <script type="text/javascript" src=" {{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src=" {{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src=" {{ url('bower_components/bootstrap-material-design/dist/js/ripples.min.js') }}"></script>
    <script type="text/javascript" src=" {{ url('bower_components/bootstrap-material-design/dist/js/material.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/estilo.css') }}">
</head>
<body>

	<div class="panel panel-default">
		<div class="panel-body">
          
			<legend>Horario</legend>
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th> <center><b>Ciclo Escolar: @if($periodo == 'E-J') ENERO-JUNIO @else AGOSTO-DICIEMBRE  @endif {{$anio}}</b></center></th>
					<tr>
						<th><center>Materia</center></th>
						<th><center>Nombre</center></th>
						<th><center>Día</center></th>
						<th><center>Hora</center></th>
						<th><center>Salón</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($hor as $horario)
						<tr>
							<td rowspan="2">{{ $horario->materia }}</td>
							<td rowspan="2">{{ $horario->completo }}</td>
							<td>{{ $horario->dia1 }}</td>
							<td>{{ $horario->hora1 }}</td>
							<td>{{ $horario->salon1 }}</td>
						</tr>
						<tr>
							<td>{{ $horario->dia2 }}</td>
							<td>{{ $horario->hora2 }}</td>
							<td>{{ $horario->salon2 }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>