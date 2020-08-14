<?php

namespace App\Http\Resources\Absent;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AbsentCollection extends ResourceCollection
{
    public static $wrap = "absents";
    public $collects = 'App\Http\Resources\Absent\AbsentResource';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'absents' => $this->collection,
        ];
    }
}
