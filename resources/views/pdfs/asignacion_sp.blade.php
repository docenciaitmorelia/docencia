<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Asignación de Sinodales</title>
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
	<table align="right">
			<tr>
				<td colspan="2" align="right"><b>Morelia, Mich.,&nbsp; {{$date}}</b></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><b>DEPENDENCIA:&nbsp;</b>SUB. ACADÉMICA</td>
			</tr>
			<tr>
				<td colspan="2" align="right"><b>SECCIÓN:&nbsp;</b>{{$secc}}</td>
			</tr>
			<tr>
				<td colspan="2" align="right"><b>OFICIO:&nbsp;</b>{{$nof}}</td>
			</tr>
			<tr>
				<td colspan="2" align="right">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" align="right"><b>ASUNTO:&nbsp;</b> Asignación de sinodales</td>
			</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="col-md-12" id="den">
		<p>
			<strong>
				@foreach($jefediv as $div) {{ $div->jefe_area}} @endforeach
				<br>
				@foreach($gjdiv as $genero) @if($genero->sexo_empleado=='M') JEFE @else JEFA @endif @endforeach DE LA DIVISIÓN DE ESTUDIOS PROFESIONALES
				<br>
			</strong>
		</p>
		<p align="justify">
			De acuerdo a la solicitud presentada por el alumno(a) <strong>@foreach($data3 as $alumno) {{$alumno->completo}} @endforeach</strong>, con número de control {{$nc}} pasante de la carrera de: @foreach($data2 as $carrera) {{$carrera->nombre}} @endforeach con registro de la opción @foreach($data as $opc) {{$opc->opcion}}; @endforeach se le informa a usted que la asignación de sinodales queda de la siguiente manera:
			</p>
			<p align="justify">
			<br>
			@foreach($data as $revisores)
			PRESIDENTE:    {{$t_presidente}} {{$revisores->presidente}} <br>
			SECRETARIO:    {{$t_secretario}}{{$revisores->secretario}} <br>
			VOCAL PROP.:   {{$t_vocalp}}{{$revisores->vocal_propietario}} <br>
			VOCAL SUPL.:   {{$t_vocals}}{{$revisores->vocal_suplente}} <br>
			@endforeach
		</p>
			<br>
			<p align="justify">
				Agradezco la atención al presente y aprovecho para enviar un afectuoso saludo.
			</p>
		</div>
		<div class="col-md-12" id="firmas">
					<p align="justify"><strong>ATENTAMENTE</strong><br>
						<i id="tec">"Técnica, progreso de México"</i>
					</p>
					<br>
					<br>
					<br>
					{{$jefedepto}}
					<br>
					Jefe del {{ mb_convert_case($dep, MB_CASE_TITLE, "utf8")}}</td>
					</div>
				<br>
				<br>
				<br>
				<br>
	</div>
			<div class="col-md-12">
					<p id="cp">Cp. Integrantes del jurado<br>Alumno interesado<br>Archivo</p>
			</div>
	</div>
</body>
</html>
