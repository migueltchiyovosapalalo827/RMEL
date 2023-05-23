<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professores extends Model
{
    use HasFactory;

    protected $fillable = [
        'classe_id','disciplina_id','pessoal_administrativos_professore_id',
    ];

    protected  $table = 'p_frente_as';


    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    public function Pessoal_administrativos_professore()
    {
        return $this->belongsTo(Pessoal_administrativos_professore::class);
    }
}
