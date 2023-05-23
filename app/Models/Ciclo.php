<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    use HasFactory;
    protected $fillable = ['nome','descricao'];

    public function escolas()
    {
        # code...
        return $this->belongsToMany(Escola::class,'escola_ciclo')->withPivot('escola_id','ciclo_id');;
    }

   public function documentos()
   {
       # code...
       return $this->hasMany(Documento::class,'ciclo_id');
   }

}
