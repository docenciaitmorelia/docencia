@extends('layouts.app')
@section('content')
@if(Auth::user()->rol == 'DivEstProf')
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
				<div class="col-md-4">
					<a href="{{ route('procesotitulacion.create') }}" class="btn btn-raised btn-primary"><i class="material-icons">add</i></a>
				</div>
				<form action="" method="GET" class="form-horizontal">
  				<div class="col-md-6 form-group">
  					<input maxlength="255" type="text" id="s" name="s" style="text-transform:uppercase;" placeholder="Buscar..." class="form-control">
  				</div>
  				<div class="col-md-2">
  					<button type="submit" class="btn btn-raised btn-primary"><i class="material-icons">search</i></button>
  				</div>
				</form>
  			<br>
  			<br>
  			<br>
  			<br>
        @include('procesotitulacion.fragment.info')
  			<h3>Proceso de Titulaciones</h3>

                  <!--Acordion para planes de estudio -->
                  <div id="accordion1">
                    <?php $id=0; ?>
                    @foreach($opciones as $item)
                      <?php $id++; ?>
                      <div class="card">
                        <div class="card-header" id="heading{{$id}}">
                          <h3 class="mb-0">
                            <a class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$id}}" aria-expanded="true" aria-controls="collapse{{$id}}">
                              {{$item->opcion_titulacion}}. {{$item->nombre_opcion}}
                              ( @foreach($reticulas as $ret)
                                  @if($item->id == $ret->id_opcion_titulacion)
                                    {{$ret->reticula}}
                                  @endif
                              @endforeach )
                            </a>
                          </h3>
                        </div>

                        <div id="collapse{{$id}}" class="collapse" aria-labelledby="heading{{$id}}" data-parent="#accordion1">
                          <div class="card-body">
                            <table class="table table-striped table-hover ">
                              <thead>
                                <tr>
                                  <th>No. Paso</th>
                                  <th>Descripción</th>
                                  <th colspan="1">&nbsp;</th>
                                  <th colspan="1">&nbsp;</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($procesotitulacion as $procesot)
                                  @if($item->nombre_opcion != $procesot->nombre_opcion)
                                    @continue
                                  @endif
                                  <tr>
                                    <td>
                                      <strong>{{ $procesot->orden }}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $procesot->descripcion}}</strong>
                                    </td>
                                    <td width="20px">
                                      <a href="{{ route('procesotitulacion.edit', $procesot->id) }}"class="btn btn-raised btn-primary">
                                        <i class="material-icons">create</i>
                                      </a>
                                    </td>
                                    <td width="20px">
                                      <form action="{{ route('procesotitulacion.destroy', $procesot->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-raised btn-primary"><i class="material-icons">clear</i></button>
                                      </form>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                    @endforeach
                  </div> <!--end accordion-->



      </div> <!--end card body-->
    </div> <!--end card-->
  </div> <!--end col-->
</div> <!--end row-->
@endif
@endsection
