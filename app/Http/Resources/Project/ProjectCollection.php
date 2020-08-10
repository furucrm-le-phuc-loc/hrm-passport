<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public static $wrap = "projects";
    public $collects = 'App\Http\Resources\Project\ProjectResource';

    public function toArray($request)
    {

        return [
            'projects' => $this->collection,
        ];
    }
}
