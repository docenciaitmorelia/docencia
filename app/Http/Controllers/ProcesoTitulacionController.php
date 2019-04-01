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
    	 $procesotitulacion= ProcesoTitulacion::PT($request->s)->orderBy('reticula', 'desc')->orderBy('nombre_opcion','asc')->orderBy('proceso_titulacion.orden','asc')->paginate();
       $opciones=Array();
       foreach ($procesotitulacion as $item) {
         $op = array_column($opciones,'nombre_opcion');
         if((string)array_search($item->nombre_opcion,$op) != "0") {
           array_push($opciones,['nombre_opcion'=>$item->nombre_opcion,'reticula'=>$item->reticula]);
         }
       }
       $reticulas = array_unique(array_column($opciones,'reticula'));
       return view('procesotitulacion.index',compact('procesotitulacion','opciones','reticulas'));
    }

    public function create()
    {
        $opcion=OpcionesTitulacion::select('nombre_opcion','id')->get();
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
        $opcion=OpcionesTitulacion::select('nombre_opcion','id')->get();
        return view('procesotitulacion.edit',compact('procesotitulacion','opcion'));
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
