<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aproveitamento extends Model
{
    use HasFactory;



    protected $fillable = ['user_id','classe_id', 'escola_id','abandono','rendimento',
    'desistidos','reprovados','matriculados','avaliados','aproveitamento','aprovados',
    'trimestre','anolectivo'];

    public function classe()
    {
        # code...
        return $this->belongsTo(classe::class);
    }
    public function escola()
     {
        # code...
        return $this->belongsTo(Escola::class);
    }
}
