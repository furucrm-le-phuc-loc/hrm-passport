<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */


    public static $wrap = "users";
    public $collects = 'App\Http\Resources\User\UserResource';

    public function toArray($request)
    {
        return [
            'users' => $this->collection,
            // 'meta' => 'moeomeok',
        ];
    }
}
