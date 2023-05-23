<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;


        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ficheiro','tipo','nome','escola_id'	,'ciclo_id'	,'ano'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function escolas()
    {
        # code...
        return $this->belongsTo(Escola::class,'escola_id');
    }

    public function ciclos()
    {
        # code...
        return $this->belongsTo(Ciclo::class,'ciclo_id');
    }

}
