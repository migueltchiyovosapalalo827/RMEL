<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome','descricao'];


    public function professores()
    {

        return $this->belongsTo(Professores::class);
    }

    public function aproveitamento()
    {
        return $this->hasMany(aproveitamento::class);
    }

    public function escolas()
    {
        # code...
        return $this->belongsToMany(Escola::class,'matriculas')->withPivot('total_alunos','anolectivo','ciclo',
        'alunos_masculinos','alunos_femininos');
    }
}
