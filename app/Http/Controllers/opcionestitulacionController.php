<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OpcionesTitulacion;
use Illuminate\Support\Facades\DB;
use App\Carrera;
use App\opctitxret;

class opcionestitulacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $Array = OpcionesTitulacion::PT($request->s)->orderBy('id','ASC')->paginate();
      return view('opcionestitulacion.index',['Array' => $Array]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $Array = Carrera::select('reticula')
      ->distinct()
      ->where('nivel_escolar','=','L')
      ->orderBy('reticula','desc')
      ->get();
      return view('opcionestitulacion.create',['Array' => $Array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $opciontitulacion = new OpcionesTitulacion;
      $opciontitulacion->opcion_titulacion = $request->opcion_titulacion;
      $opciontitulacion->nombre_opcion = $request->nombre_opcion;
      $opciontitulacion->detalle_opcion = $request->detalle_opcion;
      $opciontitulacion->save();
      foreach($request->reticulas as $reticula){
        $opcxret = new opctitxret;
        $opcxret->reticula = $reticula;
        $opcxret->id_opcion_titulacion = $opciontitulacion->id;
        $opcxret->save();
      }
      return redirect()->route('opcionestitulacionCtl.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $Array = OpcionesTitulacion::select('opciones_titulacion.*')
      ->where('id','=',$id)
      ->get();
      $Reticulas = Carrera::select('reticula')
      ->distinct()
      ->where('nivel_escolar','=','L')
      ->orderBy('reticula','desc')
      ->get();
      return view('opcionestitulacion.edit',['Array' => $Array[0], 'Reticulas' => $Reticulas]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      DB::table('opciones_titulacion')
          ->where('id', $id)
          ->update([
            'opcion_titulacion' => $request->opcion_titulacion,
            'nombre_opcion' => $request->nombre_opcion,
            'detalle_opcion' => $request->detalle_opcion,
            'reticula' => $request->reticula,
          ]);
      return redirect()->route('opcionestitulacionCtl.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
