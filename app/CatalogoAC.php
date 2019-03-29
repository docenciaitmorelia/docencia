<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogoAC extends Model
{
  protected $table = 'catalogo_ac';
  protected $primaryKey = 'id';

  public function scopeSearch($query,$s)
  {
      $s= mb_strtoupper($s,'UTF-8');
    return $query->where('actividad', 'LIKE', "%$s%");
  }
}
