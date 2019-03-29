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
}
