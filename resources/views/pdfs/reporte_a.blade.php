<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Reporte por año</title>
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

	<p align="justify">
		El que suscribe, Jefe del Departamento de Sistemas y Computación, hace constar que de acuerdo a la documentación que existe en registro de este departamento, se realizaron en el año las Titulaciones que a continuación se detallan:
		</p>
	<br>
	<br>

			@for($j = 1; $j <= 2; $j++)
			@if($j==1 && count($titu1))
			<h5>SEMESTRE: ENERO-JUNIO</h5>

			<table class="table table-bordered" bordercolor="black">
				@foreach($su1 as $s1)
				<thead>
					<tr>
						<th colspan="3"><center>{{ $s1->opcion }}: {{ $s1->total }}</center></th>
					<tr>
						<th><center>Proyecto</center></th>
						<th>Asesor</th>
						<th>Estatus</th>
					</tr>
				</thead>
				<tbody>
					@foreach($titu1 as $t)
						@if($t->opc_titu == $s1->opc_titu)
							<tr>
								<td>{{ $t->proyecto }}</td>
								<td>
									<strong>{{ $t->asesor }}</strong>
								</td>
								<td>
									<strong>{{ $t->estatus }}</strong>
								</td>
							</tr>
						@endif
					@endforeach
				</tbody>
				@endforeach
			</table>
<br>
<br>
			@elseif($j==2 && count($titu2))
			<h5>SEMESTRE: AGOSTO-DICIEMBRE</h5>
			<table class="table table-bordered">
				@foreach($su1 as $s1)
				<thead>
					<tr><th colspan="3"><center>{{ $s1->opcion }}: {{ $s1->total }}</center></th>
					<tr>
						<th><center>Proyecto</center></th>
						<th>Asesor</th>
						<th>Estatus</th>
					</tr>
				</thead>
				<tbody>
					@foreach($titu1 as $t)
						@if($t->opc_titu == $s1->opc_titu)
							<tr>
								<td>{{ $t->proyecto }}</td>
								<td>
									<strong>{{ $t->asesor }}</strong>
								</td>
								<td>
									<strong>{{ $t->estatus }}</strong>
								</td>
							</tr>
						@endif
					@endforeach
				</tbody>
				@endforeach
			</table>
			@endif
			@endfor
			<br>
			<br>
			<p>Sin otro particular, le reitero mi consideración distinguida.</p>
			<div id="firmas">
            <p align="center"><strong>ATENTAMENTE</strong><br>
              <i id="tec">"Técnica, progreso de México"</i>
            </p>
            <br>
            <br>
            <br>
            <div class="col-md-12">
              <table align="center">
                <thead>
                  <tr>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center">@foreach($data5 as $docente) {{ $docente->especializacion}} @endforeach @foreach($data5 as $docente) {{ $docente->completo}} @endforeach</td>
                  </tr>
                  <tr>
                    <td align="center" id="titulo">@foreach($data5 as $docente) @if($docente->sexo=='M')Jefe @else Jefa @endif @endforeach del Departamento de Sistemas y Computación</td>
                  </tr>
                </tbody>
                </table>
            </div>
		        <p id="cp">Cp. Archivo</p>
			</div>
		</div>
	</div>
</body>
</html>
