<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Resources\Json\JsonResource;

use \App\Http\Resources\User\UserResource;
use \App\Http\Resources\User\UserCollection;

class ProjectResource extends JsonResource
{
    public static $wrap = "projects";
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'project_name' => $this->project_name,
            'manager' => $this->manager,
            'number_worker' => $this->number_worker,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'time_checkin' => $this->time_checkin,
            'time_checkout' => $this->time_checkout,
            'location' => $this->location,
            'users' => $this->users()->get(),
        ];
    }
}
