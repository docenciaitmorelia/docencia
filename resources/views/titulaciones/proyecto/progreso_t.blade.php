@extends('layouts.app')
@section('content')
  <div class="col-md-12">
    <div class="row">
    	<div class="col">
    		<div class="card">
    		  <div class="card-body">
    		    <h3 class="card-title">Proceso de titulación</h3>
            @if($proceso == 'N')
  					<br>
  					<h4>No existe expediente de titulación</h4>
  					@else
            <br>
            <p> Documentos generados por Proyecto Docencia:</p>
            @if($orden=='Alta')
              <p>
                No hay documentos generados
              </p>
            @else
            @foreach($proceso as $p)
                <input type="checkbox" name="proceso" value="{{$p->orden}}" @if($orden >= $p->orden) checked='' disabled=''> <p class="label label-success">{{$p->descripcion}} @else disabled=''> <p class="label label-default">{{$p->descripcion}}@endif</p><br>
            @endforeach
            @endif
            <br>
            @if($al->detalle_opcion == 'Recepcional')
            <a href="{{ route('showRevisiones',Auth::user()->name)}}" class="btn btn-raised btn-primary">Estatus de revisiones</a>
            @endif
            <a href="{{ route('home') }}" class="btn btn-raised btn-primary"><i class="material-icons">chevron_left</i>Regresar</a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
