<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

use \App\Http\Resources\Report\ReportResource;

class UserResource extends JsonResource
{
    public static $wrap = 'user';
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
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'absents' => $this->absentApplication()->get(),
            'reports' => ReportResource::collection( $this->reports()->get()),
            'projects' => $this->projects()->get()
        ];
    }
}
