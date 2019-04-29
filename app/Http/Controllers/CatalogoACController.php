<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatalogoAC;
use App\Http\Requests\CatalogoACRequest;

class CatalogoACController extends Controller
{
    public function index(Request $request)
    {
    	$catalogoac= CatalogoAC::Search($request->s)->orderBy('id','DESC')->paginate();
        return view('catalogoac.index',compact('catalogoac'));
    }

    public function create()
    {
    	return view('catalogoac.create');
    }

    public function store(CatalogoACRequest $request)
    {
    	$catalogoac = new CatalogoAC;
    	$catalogoac->actividad  = mb_strtoupper($request->actividad,'UTF-8');
    	$catalogoac->creditos = $request->creditos;

        $catalogoac->save();
    	return redirect()->route('catalogoac.index');
    }

    public function edit($id)
    {
        $catalogoac  = CatalogoAC::find($id);
        return view('catalogoac.edit',compact('catalogoac'));
    }

    public function update(CatalogoACRequest $request, $id)
    {
        $catalogoac = CatalogoAC::find($id);
        $catalogoac->actividad   = mb_strtoupper($request->actividad,'UTF-8');
        $catalogoac->creditos = $request->creditos;

        $catalogoac->save();
        return redirect()->route('catalogoac.index');
    }

    public function destroy($id){
    	$catalogoac = catalogoac::find($id);
    	$catalogoac-> delete();

    	return back()->with('info', 'La actividad fue eliminada');
    }
}
