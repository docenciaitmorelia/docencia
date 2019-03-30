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
    	 $procesotitulacion= ProcesoTitulacion::PT($request->s)->orderBy('proceso_titulacion.orden','asc')->paginate();
       $id=0;
       foreach ($procesotitulacion as $item) {
         $opcion[$id] = $item->nombre_opcion;
         $id++;
       }
       $opcion = array_unique($opcion);
       /*$opcion=OpcionesTitulacion::select('nombre_opcion')
       ->distinct()
       ->orderBy('nombre_opcion','asc')
       ->get();*/
       return view('procesotitulacion.index',compact('procesotitulacion','opcion'));
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
