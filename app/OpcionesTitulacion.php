<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\opctitxret;

class OpcionesTitulacion extends Model
{
    protected $table = 'opciones_titulacion';
    protected $primaryKey = 'id';
    public function scopePT($query,$s)
    {
      return $query->select('opciones_titulacion.*','r.reticula as reticula')
      ->join('opctitxrets as r','r.id_opcion_titulacion','=','opciones_titulacion.id')
      ->where('opciones_titulacion.id','LIKE',"%$s%")
      ->orwhere('nombre_opcion','LIKE',"%$s%");
    }

    //SCOPE Opcion de Titulación
    public function scopeOT($query,$reticulas)
    {
      return $query->select('opciones_titulacion.id','r.reticula','opciones_titulacion.nombre_opcion')
                    ->join('opctitxrets as r','r.id_opcion_titulacion','=','opciones_titulacion.id')
                    ->whereIn('reticula',$reticulas);
    }
}
