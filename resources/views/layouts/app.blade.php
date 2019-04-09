<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto Docencia</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Styles -->
    <style>

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('bower_components/bootstrap-material-design/dist/css/bootstrap-material-design.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('bower_components/bootstrap-material-design/dist/css/ripples.min.css') }}"></head>
<body>
        <div class="navbar navbar-default">
        <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
          <ul class="nav navbar-nav">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
              @if(Auth::user()->rol == "Jefe de Docencia")
              <!--
                <li class="dropdown">
                  <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Círc. Estudios
                    <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('grupocestudio.index') }}">Grupos Círculos de Estudios </a></li>
                    <li><a href="{{ route('gen_lista_c')}}">Lista de tutores</a></li>
                    <li><a href="{{ route('gen_horario')}}">Horario </a></li>
                  </ul>
                </li>
-->
                <li class="dropdown">
                  <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Titulaciones
                    <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('titulaciones.index') }}">Titulaciones </a></li>
                    <!--<li><a href="{{ route('gen_reporte_a')}}">Reporte por año </a></li>
                    <li><a href="{{ route('gen_reporte_d')}}">Reporte por docente </a></li>
                    <li><a href="{{ route('revisiones.index') }}">Revisiones </a></li> -->
                  </ul>
                </li>
                <!--
                <li><a href="{{ route('actividadescomp.index') }}">Actividades Complementarias</a></li>
                <li><a href="{{ route('catalogoac.index') }}">Catalogo Act.</a></li>
              -->
              @endif
              @if(Auth::user()->rol == "DivEstProf")
                <li><a href="{{ route('procesotitulacion.index') }}">Proceso de Titulacion </a></li>
                <li><a href="{{ route('opcionestitulacionCtl.index') }}">Opciones de Titulacion </a></li>
              @endif
              @if(Auth::user()->rol == "Administrador")
                <li><a href="{{ route('usuariosCtl.index') }}">Usuarios</a></li>
              @endif
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
          </ul>
        </div>
      </div>
    </div>
    <div class="container">
            @yield('content')
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src=" {{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src=" {{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src=" {{ url('bower_components/bootstrap-material-design/dist/js/ripples.min.js') }}"></script>
    <script type="text/javascript" src=" {{ url('bower_components/bootstrap-material-design/dist/js/material.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>
    <script>
      $(document).ready(function()
      {
        $('body').bootstrapMaterialDesign();
      });
      $.material.init();
    </script>
</body>
</html>
