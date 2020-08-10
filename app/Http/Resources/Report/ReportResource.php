<?php

namespace App\Http\Resources\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{


    public static $wrap = "reports";

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
