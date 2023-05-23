<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoal_administrativos_professore extends Model
{
    use HasFactory;


     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'datainicio','instituiçãoondeestudou','contacto','disciplina','actividadequeexerce',
        'numeroagente',	'sexo',	'numerobi','categoria','cargahorária','numeroINSS','nome',
        'nivelacademico','classequeleciona','idade',	'temposervico','escola_id'];

    public function escola()
    {
        return $this->belongsTo(Escola::class);
    }

    public function professores()
    {
           return $this->hasOne(professores::class,'pessoal_administrativos_professore_id');

    }

}
