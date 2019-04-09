<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Invitacion a Ceremonia de Titulación</title>
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
			<center>
				<b>
				<h3>INSTITUTO TECNOLÓGICO DE MORELIA
				<br>
				<br>
				{{$dep}}
				<br>
				<br>
				PRÓXIMA CEREMONIA DE TITULACIÓN
			</b>
				<br>
				<br>
				<br>
				<br>
				{{$date}}
				<br>
				{{$lugar}}
				<br>
				{{$hora}}
				</h3>
				<br>
				<br>
				<br>
				<hr style="border-color:red;">
				@foreach($data3 as $alumno)
				<h3>{{$alumno->completo}}</h3>
				@endforeach
				<hr style="border-color:red;">
				<br>
				@foreach($data2 as $carrera)
				<h3>{{ $carrera->nombre }}</h3>
				@endforeach
				<br>
				<h3>OPCIÓN @foreach($data as $titulacion) {{ mb_strtoupper($titulacion->opcion,'UTF-8')}}</h3>
				<br>
				<h3> MESA DE SINODALES</h3>
				<br>
				<br>
				<br>

			</center>
			<h3>
			PRESIDENTE: &emsp;&emsp; &emsp;&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;   {{$t_presidente}}{{$titulacion->presidente}} <br>
			SECRETARIO: &emsp;&emsp; &emsp; &emsp; &emsp;&emsp; &emsp; &emsp; &emsp;&emsp;    {{$t_secretario}}{{$titulacion->secretario}} <br>
			VOCAL PROPIETARIO: &emsp;&emsp;  {{$t_vocalp}}{{$titulacion->vocal_propietario}} <br>
			VOCAL SUPLENTE: &emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; {{$t_vocals}}{{$titulacion->vocal_suplente}}
			@endforeach
		</h3>
</div>

</body>
</html>
