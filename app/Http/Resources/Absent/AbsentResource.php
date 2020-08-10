<?php

namespace App\Http\Resources\Absent;

use Illuminate\Http\Resources\Json\JsonResource;

class AbsentResource extends JsonResource
{
    public static $wrap = "absents";
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
            'state' => $this->state,
            'date_off' => $this->date_off,
            'number_off' => $this->number_off,
            'content' => $this->content,
            'user' => $this->user,
            'created_at' => $this->created_at,
        ];
    }
}
