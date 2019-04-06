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
      $Reticulas = DB::table('opctitxrets')->select('id_opcion_titulacion','reticula')->orderby('reticula','desc')->get();
      return view('opcionestitulacion.index',['Array' => $Array,'Reticulas'=>$Reticulas]);
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
      DB::beginTransaction();
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
      DB::commit();
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
      $Array = OpcionesTitulacion::select('opciones_titulacion.*','opctitxrets.reticula')
      ->join('opctitxrets','opciones_titulacion.id','opctitxrets.id_opcion_titulacion')
      ->where('opciones_titulacion.id','=',$id)
      ->get();
      $RetSel = Array();
      foreach ($Array as $item) {
        array_push($RetSel,$item->reticula);
      }
      $Reticulas = Carrera::select('reticula')
      ->distinct()
      ->where('nivel_escolar','=','L')
      ->orderBy('reticula','desc')
      ->get();
      return view('opcionestitulacion.edit',['Array' => $Array[0], 'Reticulas' => $Reticulas, 'RetSel' => $RetSel]);

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
      DB::beginTransaction();
        DB::table('opciones_titulacion')
          ->where('id', $id)
          ->update([
            'opcion_titulacion' => $request->opcion_titulacion,
            'nombre_opcion' => $request->nombre_opcion,
            'detalle_opcion' => $request->detalle_opcion,
          ]);
        DB::table('opctitxrets')
          ->where('id_opcion_titulacion',$id)->delete();
        foreach($request->reticulas as $reticula){
            $opcxret = new opctitxret;
            $opcxret->reticula = $reticula;
            $opcxret->id_opcion_titulacion = $id;
            $opcxret->save();
        }
      DB::commit();
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
      DB::beginTransaction();
      DB::table('opctitxrets')
        ->where('id_opcion_titulacion',$id)->delete();
      DB::table('opciones_titulacion')
        ->where('id',$id)->delete();
      DB::commit();
      return redirect()->route('opcionestitulacionCtl.index');

    }
}
