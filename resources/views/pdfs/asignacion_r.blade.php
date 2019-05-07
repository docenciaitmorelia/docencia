<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Asignación de Revisores</title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/estilo.css') }}">
</head>
  <body>
    <div id="contenido">
			<p align='right'> Morelia, Mich. a {{$date}} </p>
      <p align="center">
        <strong>
          {{$seccion->descripcion_area}}
          <br>
          REVISORES PARA OPCIÓN DE TITULACIÓN
        </strong>
      </p>
      <br>
      <table border="1" bordercolor="black" width="100%">
          <tbody>
            <tr>
              <td>@if($data3->sexo == 'M')Alumno: @else Alumna: @endif</td>
              <td>{{$data3->completo}}</td>
            </tr>
            <tr>
              <td>Opción de Titulación:</td>
              <td>{{$data->nombre_opcion}}</td>
            </tr>
            <tr>
              <td>Título del trabajo</td>
              <td>"{{$data->nombre_proyecto}}"</td>
            </tr>
            <tr>
              <td>Asesor</td>
              <td> {{$data->asesor}}</td>
            </tr>
          </tbody>
        </table>
        <p align="justify">
          <strong>REVISORES</strong>
        </p>
        <table border="1" bordercolor="black" width="100%">
          <thead>
            <tr>
              <th>Cargo</th>
              <th>Nombre del(la) profesor(a)</th>
              <th>Firma</th>
            </tr>
          </thead>
          <tbody>
						@if($ae->asesor_externo != 'N')
            <tr>
              <td>Presidente</td>
              <td> {{$data->revisor1}}</td>
              <td width="20%"></td>
            </tr>
            <tr>
              <td>Secretario</td>
              <td>{{$data->revisor2}}</td>
              <td></td>
            </tr>
            <tr>
              <td>Vocal Propietario</td>
              <td>{{$data->revisor3}}</td>
              <td></td>
            </tr>
            <tr>
              <td>Vocal Suplente</td>
              <td> {{$data->asesor}}</td>
              <td></td>
            </tr>
						@else
						<tr>
              <td>Presidente</td>
              <td> {{$data->asesor}}</td>
              <td width="20%"></td>
            </tr>
            <tr>
              <td>Secretario</td>
              <td>{{$data->revisor1}}</td>
              <td></td>
            </tr>
            <tr>
              <td>Vocal Propietario</td>
              <td>{{$data->revisor2}}</td>
              <td></td>
            </tr>
            <tr>
              <td>Vocal Suplente</td>
              <td> {{$data->revisor3}}</td>
              <td></td>
            </tr>
						@endif
          </tbody>
        </table>
				<br>
				<div id="firmas">
	            <p align="center"><strong>ATENTAMENTE</strong><br>
	              <i id="tec">"Técnica, progreso de México"</i>
	            </p>
	            <br>
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
	                    <td align="center">{{$seccion->jefe_area}}</td>
	                    <td align="center">&nbsp;</td>
	                    <td align="center">{{$academia->grado}} {{$academia->nombre_empleado}} {{$academia->apellidos_empleado}}</td>
	                  </tr>
	                  <tr>
	                    <td align="center" id="titulo">JEFE DEL {{$seccion->descripcion_area}}</td>
	                    <td align="center">&nbsp;</td>
	                    <td align="center" id="titulo">PRESIDENTE DE ACADEMIA</td>
	                  </tr>

										<tr>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                  </tr>

										<tr>
	                    <td>&nbsp;</td>
	                    <td align="center">{{$data->asesor}}</td>
	                    <td>&nbsp;</td>
	                  </tr>
										<tr>
	                    <td>&nbsp;</td>
	                    <td align="center">ASESOR</td>
	                    <td>&nbsp;</td>
	                  </tr>
	                </tbody>
	                </table>
	            </div>
    </div>
  </body>
</html>
