@extends('layouts.app')
@section('title', 'Verificar Usuario')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica tu dirección de E-MAIL') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un link de verificación ha sido enviado a tu correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceeder, por favor checha tu email para verificar la liga.') }}
                    {{ __('Si no recibiste el email') }}, <a href="{{ route('verification.resend') }}">{{ __('Da click aquí para intentar con otro') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
