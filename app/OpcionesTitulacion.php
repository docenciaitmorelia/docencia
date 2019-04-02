<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpcionesTitulacion extends Model
{
    protected $table = 'opciones_titulacion';
    protected $primaryKey = 'id';
    public function scopePT($query,$s)
    {
      return $query->select('opciones_titulacion.*')
      ->where('id','LIKE',"%$s%")
      ->orwhere('nombre_opcion','LIKE',"%$s%");
    }

    //SCOPE Opcion de Titulación
    public function scopeOT($query,$plan)
    {
      $plan= mb_strtoupper($plan,'UTF-8');
      return $query->select('*')
                    ->where('reticula','LIKE',"%$plan%");
    }
}
