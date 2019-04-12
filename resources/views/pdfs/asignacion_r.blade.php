<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Asignación de Revisores</title>
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
      <p align="center">
        <strong>
          DEPTO de...
          <br>
          REVISORES PARA OPCIÓN DE TITULACIÓN
        </strong>
      </p>
      <br>
      <table class="table table-bordered" bordercolor="black">
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
              <td>{{$data->asesor}}</td>
            </tr>
          </tbody>
        </table>
        <p align="justify">
          <strong>REVISORES</strong>
        </p>
        <table class="table table-bordered" bordercolor="black">
          <thead>
            <tr>
              <th>Cargo</th>
              <th>Nombre del(la) profesor(a)</th>
              <th>Firma</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Presidente:</td>
              <td> {{$data->presidente}}</td>
              <td></td>
            </tr>
            <tr>
              <td>Secretario</td>
              <td>{{$data->secretario}}</td>
              <td></td>
            </tr>
            <tr>
              <td>Vocal Propietario</td>
              <td>{{$data->vocal_propietario}}</td>
              <td></td>
            </tr>
            <tr>
              <td>Vocal Suplente</td>
              <td>{{$data->vocal_suplente}}</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      <p align="justify">
          Después que revisen su proyecto y realice las correcciones necesarias, los revisores firmaran de conformidad. Entonces solicita el Oficio de Liberación de Proyecto.
        </p>
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
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
	                  </tr>
	                  <tr>
	                    <td align="center">Nombre</td>
	                    <td align="center">{{$data->asesor}}</td>
	                    <td align="center">Nombre</td>
	                  </tr>
	                  <tr>
	                    <td align="center" id="titulo">Jefe del {{ mb_convert_case('Depto', MB_CASE_TITLE, "utf8")}}</td>
	                    <td align="center">Asesor</td>
	                    <td align="center" id="titulo">Presidente de Academia</td>
	                  </tr>
	                </tbody>
	                </table>
	            </div>
    </div>
  </body>
</html>
