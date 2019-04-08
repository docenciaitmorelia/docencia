<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Lista de asistencia</title>
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
	<div id="contenido">
          
			<legend>Lista de asistencia de asesores de círculos de estudios</legend>
			<table class="table table-bordered table-sm"">
				<thead>
					<tr>
						<th> <center><b>Ciclo Escolar: @if($periodo == 'E-J') ENERO-JUNIO @else AGOSTO-DICIEMBRE  @endif {{$anio}}</b></center></th>
					<tr>
						<th><center>Nombre</center></th>
						@for($i =1; $i<=15; $i++)
						<th colspan="2">&nbsp;</th>
						@endfor
					</tr>
				</thead>
				<tbody>
					@foreach($alu as $al)
						<tr>
							<td>{{ $al->completo }}</td>
							@for($i =1; $i<=15; $i++)
							<th colspan="2">&nbsp;</th>
							@endfor
						</tr>
					@endforeach
					@for($j=1; $j<=5; $j++)
						<tr>
							<td colspan="1"></td>
							@for($i =1; $i<=15; $i++)
							<th colspan="2">&nbsp;</th>
							@endfor
						</tr>
					@endfor
				</tbody>
			</table>
	</div>
</body>
</html>