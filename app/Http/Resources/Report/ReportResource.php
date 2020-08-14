<?php

namespace App\Http\Resources\Report;

use Illuminate\Http\Resources\Json\JsonResource;
use \App\Location;
use \App\ProjectUser;
use \App\User;
use \App\Project;

class ReportResource extends JsonResource
{


    public static $wrap = "report";

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
            'location_checkin' => $this->location_checkin,
            'location_checkout' => $this->location_checkout,
            'time_checkin' => $this->time_checkin,
            'time_checkout' => $this->time_checkout,
            'content' => $this->content,
            'time_working' => $this->time_working,
            'state' => $this->state,
            'project' => Project::find(ProjectUser::find($this->project_user_id)->project_id),
            'user' => User::find(ProjectUser::find($this->project_user_id)->user_id),
        ];
    }
}
