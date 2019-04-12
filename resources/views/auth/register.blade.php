@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-1">
          <div class="card">
              <div class="card-body">
                <h3 class="card-title">{{ __('Registrar Nuevo Usuario') }}</h3>
                  <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true">Personal</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="alumnos-tab" data-toggle="tab" href="#alumnos" role="tab" aria-controls="alumnos" aria-selected="false">Alumnos</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                      <form method="POST" action="{{ route('register') }}">
                          @csrf
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre/RFC de Personal') }}</label>
                              <div class="col-md-6">
                                  <select id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name">
                                    @foreach($Docentes as $docente)
                                      <option value="{{$docente->rfc}}">{{$docente->apellidos_empleado}} {{$docente->nombre_empleado}}, {{$docente->rfc}}</option>
                                    @endforeach
                                  </select>
                                  @if ($errors->has('name'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>
                              <div class="col-md-6">
                                  <select id="rol" type="text" class="form-control{{ $errors->has('rol') ? ' is-invalid' : '' }}" name="rol">
                                    <option value="Alumno">Alumno</option>
                                    <option value="Docente">Docente</option>
                                    <option value="Jefe de Docencia" selected>Jefe de Docencia</option>
                                    <option value="DivEstProf">Jefe de División de Estudios Profesionales</option>
                                    <option value="Administrador">Administrador</option>
                                  </select>
                                  @if ($errors->has('rol'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('rol') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="clave_area" class="col-md-4 col-form-label text-md-right">{{ __('Área') }}</label>
                              <div class="col-md-6">
                                  <select id="clave_area" type="text" class="form-control{{ $errors->has('clave_area') ? ' is-invalid' : '' }}" name="clave_area" required>
                                    @foreach($Areas as $area)
                                      <option value="{{$area->clave_area}}">{{$area->descripcion_area}}</option>
                                    @endforeach
                                  </select>
                                  @if ($errors->has('clave_area'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('clave_area') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="carrera" class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>
                              <div class="col-md-6">
                                  <select id="carrera" type="text" class="form-control{{ $errors->has('carrera') ? ' is-invalid' : '' }}" name="carrera" required>
                                    @foreach($Carreras as $carrera)
                                      <option value="{{$carrera->carrera}}">{{$carrera->reticula}}-{{$carrera->nombre_reducido}}</option>
                                    @endforeach
                                  </select>
                                  @if ($errors->has('carrera'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('carrera') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Dirección de E-Mail') }}</label>

                              <div class="col-md-6">
                                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                  @if ($errors->has('email'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Constraseña') }}</label>

                              <div class="col-md-6">
                                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                  <small id="passwordHelpBlock" class="form-text text-muted">
                                    Tu contraseña debe tener, al menos 8 caracteres.
                                  </small>
                                  @if ($errors->has('password'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirma tu Contraseña') }}</label>

                              <div class="col-md-6">
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="submit" class="btn btn-primary btn-flat" name="submit"><i class="material-icons right">send</i>
                                      {{ __('Registrar') }}
                                  </button>
                                  <a href="{{ route('admin') }}" class="btn btn-primary btn-flat" ><i class="material-icons right">cancel</i>
                                      {{ __('Cancelar') }}
                                  </a>
                              </div>
                          </div>
                      </form>
                    </div> <!-- fin tab-pane -->
                    <div class="tab-pane fade" id="alumnos" role="tabpanel" aria-labelledby="alumnos-tab">
                      <h3 class="card-title">{{ __('Registrar Nuevo Usuario Alumno') }}</h3>
                      <form method="POST" action="{{ route('register') }}">
                          @csrf
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre/RFC de Personal') }}</label>
                              <div class="col-md-6">
                                  <select id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name">
                                    @foreach($Docentes as $docente)
                                      <option value="{{$docente->rfc}}">{{$docente->apellidos_empleado}} {{$docente->nombre_empleado}}, {{$docente->rfc}}</option>
                                    @endforeach
                                  </select>
                                  @if ($errors->has('name'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>
                              <div class="col-md-6">
                                  <select id="rol" type="text" class="form-control{{ $errors->has('rol') ? ' is-invalid' : '' }}" name="rol">
                                    <option value="Alumno">Alumno</option>
                                    <option value="Docente">Docente</option>
                                    <option value="Jefe de Docencia" selected>Jefe de Docencia</option>
                                    <option value="DivEstProf">Jefe de División de Estudios Profesionales</option>
                                    <option value="Administrador">Administrador</option>
                                  </select>
                                  @if ($errors->has('rol'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('rol') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="clave_area" class="col-md-4 col-form-label text-md-right">{{ __('Área') }}</label>
                              <div class="col-md-6">
                                  <select id="clave_area" type="text" class="form-control{{ $errors->has('clave_area') ? ' is-invalid' : '' }}" name="clave_area" required>
                                    @foreach($Areas as $area)
                                      <option value="{{$area->clave_area}}">{{$area->descripcion_area}}</option>
                                    @endforeach
                                  </select>
                                  @if ($errors->has('clave_area'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('clave_area') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="carrera" class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>
                              <div class="col-md-6">
                                  <select id="carrera" type="text" class="form-control{{ $errors->has('carrera') ? ' is-invalid' : '' }}" name="carrera" required>
                                    @foreach($Carreras as $carrera)
                                      <option value="{{$carrera->carrera}}">{{$carrera->reticula}}-{{$carrera->nombre_reducido}}</option>
                                    @endforeach
                                  </select>
                                  @if ($errors->has('carrera'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('carrera') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Dirección de E-Mail') }}</label>

                              <div class="col-md-6">
                                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                  @if ($errors->has('email'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Constraseña') }}</label>

                              <div class="col-md-6">
                                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                  <small id="passwordHelpBlock" class="form-text text-muted">
                                    Tu contraseña debe tener, al menos 8 caracteres.
                                  </small>
                                  @if ($errors->has('password'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirma tu Contraseña') }}</label>

                              <div class="col-md-6">
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="submit" class="btn btn-primary btn-flat" name="submit"><i class="material-icons right">send</i>
                                      {{ __('Registrar') }}
                                  </button>
                                  <a href="{{ route('admin') }}" class="btn btn-primary btn-flat" ><i class="material-icons right">cancel</i>
                                      {{ __('Cancelar') }}
                                  </a>
                              </div>
                          </div>
                      </form>
                      </div> <!-- fin tab-pane -->
                    </div><!-- fin tab-content -->
                  </div> <!-- fin card-body -->
                </div> <!-- fin card -->
        </div> <!-- fin col -->
    </div> <!-- fin row -->
    <script type="text/javascript">
    $('#myTab a').on('click', function (e) {
      e.preventDefault()
      $(this).tab('show');
    });
    $('#myTab a[href="#personal"]').tab('show') // Select tab by name
    </script>
@endsection
