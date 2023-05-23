<?php

namespace App\Http\Entities;

use Illuminate\Http\Request;

class Collection
{
    /**
     * Return data to colection map datatable.
     *
     * @param array $data
     * @param int   $recordsTotal
     * @param int   $recordsFiltered
     *
     * @return array
     */
    public static function datatable(object $data, int $recordsTotal, int $recordsFiltered,Request $request)
    {
        return [
            'draw'            => $request->get('draw'),
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ];
    }
}
