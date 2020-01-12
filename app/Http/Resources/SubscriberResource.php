<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var \App\User $subscriber */
        $subscriber = $this->resource;

        return [
            'id'         => $subscriber->id,
            'first_name' => $subscriber->first_name,
            'last_name'  => $subscriber->last_name,
            'email'      => $subscriber->email,
        ];
    }
}
