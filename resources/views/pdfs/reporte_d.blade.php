<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Reporte por docente</title>
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
				<td colspan="2" align="right"><b>DEPENDENCIA:&nbsp;</b>SUB. ACADÉMICA</td>
			</tr>
			<tr>
				<td colspan="2" align="right"><b>SECCIÓN:&nbsp;</b>SISTEMAS Y COMPUTACIÓN</td>
			</tr>
			<tr>
				<td colspan="2" align="right"><b>OFICIO:&nbsp;</b>DSC.</td>
			</tr>
			<tr>
				<td colspan="2" align="right"><b>Morelia, Mich.,&nbsp;{{$date}}</b></td>
			</tr>
			<tr>
				<td colspan="2" align="right">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" align="right"><b>ASUNTO:&nbsp;</b> Constancia de cumplimiento</td>
			</tr>
		</table>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
		<b>A QUIÉN CORRESPONDA:</b>
	<br>
	<br>
		<p align="justify">
		El que suscribe, Jefe del Departamento de Sistemas y Computación, hace constar que de acuerdo a la documentación que existe en registro de este departamento el (la) C. @foreach($nombrea as $a){{$a->grado}} {{$a->completo}},@endforeach Profesor adscrito al departamento a mi cargo de este Instituto, participó como <b>ASESOR</b>, en las Titulaciones que a continuación se detallan:
		</p>
	<br>
	<br>
			<table class="table table-bordered" bordercolor="black">
				<thead><tr><th colspan="3">Semestre: ENERO-JUNIO</th></tr></thead>
				@foreach($su as $s1)
				<thead>
					<tr>
						<th colspan="3"><center>{{ $s1->opcion }}: {{ $s1->total }}</center></th>
					<tr>
						<th>Alumno</th>
						<th>Plan</th>
						<th><center>Proyecto</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($titu as $t)
						@if($t->opc_titu == $s1->opc_titu)
							<tr>
								<td>{{$t->alumno}}</td>
								<td>{{$t->plan}}</td>
								<td>{{ $t->proyecto }}</td>
							</tr>
						@endif
					@endforeach
				</tbody>
				@endforeach
			</table>

			<br>
			<br>
			<p>Sin otro particular, le reitero mi consideración distinguida.</p>
			<div id="firmas">
		        <p align="center"><strong>ATENTAMENTE</strong><br>
		          <i id="tec">"Técnica, progreso de México"</i>
		        </p>
		        <br>
		        <div class="col-md-12">
		          <table align="center">
		            <thead>
		              <tr>
		                <th>&nbsp;</th>
		                <th>&nbsp;</th>
		                <th>&nbsp;</th>
		              </tr>
		            </thead>
		            <tbody>
		              <tr>
		                <td align="center">Nombre</td>
		                <td align="center">&nbsp;</td>
		                <td align="center">Nombre</td>
		              </tr>
		              <tr>
		                <td align="center" id="titulo"> Jefe del Departamento de Sistemas <br>y Computación</td>
		                <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		                <td align="center" id="titulo">Subdirector Académico</td>
		              </tr>
		            </tbody>
		            </table>
		        </div>
		        <p id="cp">Cp. Archivo</p>
		</div>
	</div>
</body>
</html>
