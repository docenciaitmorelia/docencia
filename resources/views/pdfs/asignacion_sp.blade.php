<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Asignación de Sinodales</title>
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
				<td colspan="2" align="right"><b>SECCIÓN:&nbsp;</b>{{$jefedsc->descripcion_area}}</td>
			</tr>
			<tr>
				<td colspan="2" align="right"><b>OFICIO:&nbsp;</b>{{$nof}}</td>
			</tr>
			<tr>
				<td colspan="2" align="right">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" align="right"><b>ASUNTO:&nbsp;</b> Autorización de opción de titulación y asignación de sinodales</td>
			</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="col-md-12" id="den">
		<p>
			<strong>
					 {{ $jefediv->jefe_area}}
				<br>
				@if($gjdiv->sexo_empleado=='M') JEFE @else JEFA @endif DE LA DIVISIÓN DE ESTUDIOS PROFESIONALES
				<br>
				PRESENTE
				<br>
			</strong>
		</p>
		<p align="justify">
			En respuesta a su oficio <b>{{$nofdiv}}</b> la solicitud de titulación; informo a usted que @if($alumno->sexo=='M') el @else la @endif <strong>C. {{$alumno->completo}}</strong>, pasante de la carrera de <b>{{$carrera->nombre}}</b> y con número de control <b>{{$alumno->no_de_control}}</b>, registró la opción de titulación: @if($alumno->reticula < 2010) <b>{{$titu->op}}. {{$titu->nombre_opcion}}</b>; @else <b>{{$titu->nombre_opcion}}</b>; @endif el cual ha sido analizado en reunión de Academia, llegando a la siguiente conclusión: <b>SE APRUEBA</b>; quedando integrado el jurado de la siguiente manera:
		</p>
			<p align="justify">
				<table>
					@if($ae->asesor_externo != 'N')
					<tr> <td><b>PRESIDENTE:</b> </td> <td>    {{$titu->revisor1}} </td><tr>
	        <tr> <td><b>SECRETARIO:</b>   </td> <td>  {{$titu->revisor2}} </td><tr>
	        <tr> <td><b>VOCAL PROP.:</b>  </td> <td>  {{$titu->revisor3}} </td><tr>
	        <tr> <td><b>VOCAL SUPL.:</b>  </td> <td>  {{$titu->asesor}} </td><tr>
					@else
	        <tr> <td><b>PRESIDENTE:</b> </td> <td>    {{$titu->asesor}} </td><tr>
	        <tr> <td><b>SECRETARIO:</b>   </td> <td>  {{$titu->revisor1}} </td><tr>
	        <tr> <td><b>VOCAL PROP.:</b>  </td> <td>  {{$titu->revisor2}} </td><tr>
	        <tr> <td><b>VOCAL SUPL.:</b>  </td> <td>  {{$titu->revisor3}} </td><tr>
					@endif
				</table>
		</p>
			<br>
			<p align="justify">
				Agradezco la atención al presente y aprovecho para enviar un afectuoso saludo.
			</p>
			<br>
		</div>
		<div class="col-md-12" id="firmas">
					<p align="center"><strong>ATENTAMENTE</strong><br>
						<i id="tec">"Técnica, progreso de México"</i>
					<br>
					<br>
					<br>
					<br>
					{{$jefedsc->jefe_area}}
					<br>
					JEFE DEL {{$jefedsc->descripcion_area}}
					</p>
			</div>
				<br>
				<br>
				<br>
				<br>
				<div class="col-md-12">
						<p id="cp">c.c.p. Alumno interesado<br>c.c.p. Archivo</p>
				</div>
	</div>

	</div>
</body>
</html>
