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
				<td colspan="2" align="right"><b>ASUNTO:&nbsp;</b> Asignación de sinodales</td>
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
			</strong>
		</p>
		<p align="justify">
			De acuerdo a la solicitud presentada por @if($alumno->sexo=='M') el&nbsp;egresado: @else la&nbsp;egresada: @endif <strong> {{$alumno->completo}} </strong>, con número de control {{$alumno->no_de_control}} pasante de la carrera de: {{$carrera->nombre}} con registro de la opción @if($alumno->reticula < 2010) {{$titu->op}}.{{$titu->nombre_opcion}}; @else {{$titu->nombre_opcion}}; @endif se le informa a usted que la asignación de sinodales queda de la siguiente manera:
			</p>
			<p align="justify">
				<table>
				<tr> <td> PRESIDENTE: </td> <td>    {{$titu->presidente}} </td><tr>
				<tr> <td>SECRETARIO:   </td> <td>  {{$titu->secretario}} </td><tr>
				<tr> <td>VOCAL PROP.:  </td> <td>  {{$titu->vocal_propietario}} </td><tr>
				<tr> <td>VOCAL SUPL.:  </td> <td>  @if($ae->asesor_externo != 'N') {{$titu->asesor_externo}} @else {{$titu->vocal_suplente}} @endif</td><tr>
				<tr> <td>  ASESOR:     </td> <td>    {{$titu->asesor}} </td><tr>
				</table>
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
					{{$jefedsc}}
					<br>
					Jefe del {{$jefedsc->descripcion_area}}</td>
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
