<?php
namespace App\Traits;

use Illuminate\Http\Request;

/**
 *
 */
trait estaticaTrait
{

    public function Taxa_aproveitamento(Request $request)
    {
        # code...
        return ($request->aprovados * 100)/ $request->avaliados;
    }


    public function Taxa_rendimento(Request $request)
    {
        # code...
        return ($request->aprovados * 100)/ $request->matriculados;
    }


    public function Taxa_reprovacao(Request $request)
    {
        # code...
        return ($request->reprovado * 100)/ $request->avaliados;
    }

    public function Taxa_abandono(Request $request)
    {
        # code...
        return ($request->desistidos * 100)/ $request->matriculados;
    }
}
