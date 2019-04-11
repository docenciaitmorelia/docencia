@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ __('Editar al Usuario') }} {{ $Usuario->name }}</h3>
                    <form method="POST" action="{{ route('usuariosCtl.update', $Usuario->id) }}">
                        @csrf
                        {{ method_field('PUT')}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $Usuario->name }}" placeholder="Introduzca Su Nombre Completo" required autofocus>
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
                                  <option value="{{ $Usuario->rol }}" selected>{{ $Usuario->rol }}</option>
                                  <option value="Alumno">Alumno</option>
                                  <option value="Docente">Docente</option>
                                  <option value="DivEstProf">Jefe de División de Estudios Profesionales</option>
                                  <option value="Jefe de Docencia">Jefe de Docencia</option>
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
                                  <option value="{{ $Usuario->clave_area }}">{{ $Usuario->descripcion_area }}</option>
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
                                  <option value="{{$Usuario->carrera}}" selected>{{$Usuario->carrera}}-{{$Usuario->nombre_reducido}}</option>
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
                                <input readonly id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $Usuario->email }}" required>

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
                </div>
            </div>
        </div>
    </div>
@endsection
