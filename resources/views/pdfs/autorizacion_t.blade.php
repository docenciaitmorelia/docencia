<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Autorización de tema y asignación de asesor</title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/estilo.css') }}">
</head>
  <body>
    <div id="contenido">
    <table align="right" width="50%">
        <tr>
          <td align="right"><b>Morelia, Mich.,&nbsp;{{$date}}</b></td>
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
          <td colspan="2" align="right"><b>ASUNTO:&nbsp;</b> Autorización de tema y asignación de asesor de proyecto para Titulación Integral</td>
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
        Por este medio le informo que el proyecto @if($alumno->sexo == 'M') del alumno @else de la alumna @endif <b>{{$alumno->completo}}</b>, con número de control {{$alumno->no_de_control}} de la carrera <b>{{$carrera->nombre}}</b> denominado <b>"{{$titu->nombre_proyecto}}"</b>, ha sido <b>REGISTRADO</b> y <b>AUTORIZADO</b> como tema para la <b>TITULACIÓN</b> bajo la opción: <b>{{$titu->nombre_opcion}}</b>, haciendo la designación del <b>{{$titu->ag}} {{$titu->asesor}}</b> como <b>ASESOR DEL PROYECTO</b>.
			</p>
				<br>
        <p align="justify">
          Agradezco la atención al presente y aprovecho para enviar un afectuoso saludo.
        </p>
      </div>
      <div class="col-md-12" id="firmas">
            <p align="center"><strong>ATENTAMENTE</strong><br>
              <i id="tec">"Técnica, progreso de México"</i>
            </p>
						<div class="col-md-12">
							<table align="center">
								<thead>
									<tr>
										<th width='30%'>&nbsp;</th>
										<th width='30%'>&nbsp;</th>
										<th width='30%'>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td align="center">{{$jefedsc->jefe_area}}</td>
										<td align="center">&nbsp;</td>
										<td align="center">{{$academia->grado}} {{$academia->nombre_empleado}} {{$academia->apellidos_empleado}}</td>
									</tr>
									<tr>
										<td align="center" id="titulo">JEFE DEL {{$jefedsc->descripcion_area}}</td>
										<td align="center">&nbsp;</td>
										<td align="center" id="titulo">PRESIDENTE DE ACADEMIA</td>
									</tr>
								</tbody>
								</table>
						</div>
          <br>
					<div class="col-md-12">
	            <p id="cp">Cp. Alumno interesado<br>Archivo</p>
	        </div>
    </div>

    </div>
  </body>
</html>
