<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Lista de asistencia</title>
	<link rel="stylesheet" type="text/css" href="{{ url('css/estilo.css') }}">
</head>
<body>
	<div id="contenido">

			<h4>Lista de asistencia de asesores de círculos de estudios</h4>
			<table border="1" width="100%">
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
