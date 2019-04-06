<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProcesoTitulacion;
use App\OpcionesTitulacion;
use App\Http\Requests\ProcesoTitulacionRequest;
use Illuminate\Support\Facades\DB;

class ProcesoTitulacionController extends Controller
{
    public function index(Request $request)
    {
    	 $procesotitulacion= ProcesoTitulacion::PT($request->s)
       ->orderBy('nombre_opcion','asc')
       ->orderBy('proceso_titulacion.orden','asc')
       ->get();
       $opciones=DB::table('opciones_titulacion')
       ->select('id','opcion_titulacion','nombre_opcion')
       ->orderBy('opcion_titulacion','asc')
       ->get();
       $reticulas = DB::table('opctitxrets')->select('id_opcion_titulacion','reticula')->orderby('reticula','desc')->get();

       return view('procesotitulacion.index',compact('procesotitulacion','opciones','reticulas'));
    }

    public function create()
    {
        $opcion=OpcionesTitulacion::select('nombre_opcion','opciones_titulacion.id','reticula')
        ->join('opctitxrets','opciones_titulacion.id','opctitxrets.id_opcion_titulacion')
        ->orderBy('reticula','desc')
        ->orderBy('nombre_opcion','asc')
        ->get();
    	  return view('procesotitulacion.create',compact('opcion'));
    }

    public function store(ProcesoTitulacionRequest $request)
    {
    	$procesotitulacion = new ProcesoTitulacion;
    	$procesotitulacion->id_opcion       = $request->opcion;
    	$procesotitulacion->orden           = $request->orden;
      $procesotitulacion->descripcion     = $request->descripcion;
      $procesotitulacion->save();
    	return redirect()->route('procesotitulacion.index')->with('info', 'El paso para el proceso de titulación fue registrado');
    }

    public function edit($id)
    {
        $procesotitulacion  = ProcesoTitulacion::find($id);
        $opciones=OpcionesTitulacion::select('nombre_opcion','id')->get();
        $reticulas = DB::table('opctitxrets')->select('id_opcion_titulacion','reticula')->orderby('reticula','desc')->get();
        return view('procesotitulacion.edit',compact('procesotitulacion','opciones','reticulas'));
    }

    public function update(ProcesoTitulacionRequest $request, $id)
    {
        $procesotitulacion = ProcesoTitulacion::find($id);
        $procesotitulacion->id_opcion       = $request->opcion;
    	  $procesotitulacion->orden           = $request->orden;
        $procesotitulacion->descripcion     = $request->descripcion;

        $procesotitulacion->save();
        return redirect()->route('procesotitulacion.index')->with('info', 'El paso para el proceso de titulación fue editado');
    }

    public function destroy($id){
    	$procesotitulacion = ProcesoTitulacion::find($id);
    	$procesotitulacion-> delete();

    	return back()->with('info', 'El paso para el proceso de titulación fue eliminado');
    }
}
