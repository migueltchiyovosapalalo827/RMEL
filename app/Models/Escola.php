<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    use HasFactory;

           /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nomeescola','numeroescola'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   public function Pessoal_administrativos_professore()
   {
       # code...
       return  $this->hasMany(Pessoal_administrativos_professore::class);

   }

   public function classes()
   {
       # code...
       return $this->belongsToMany(Classe::class,'matriculas')->withPivot('total_alunos','anolectivo','ciclo',
         'alunos_masculinos','alunos_femininos'
    );
   }

   public function ciclos()
   {
       # code...
       return $this->belongsToMany(Ciclo::class,'escola_ciclo')->withPivot('escola_id','ciclo_id');
   }
   public function documentos()
   {
       # code...
       return $this->hasMany(Documento::class);
   }

     public function aproveitamento()
    {
        return $this->hasMany(aproveitamento::class);
    }
}
