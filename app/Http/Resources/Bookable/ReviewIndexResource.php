<?php

namespace App\Http\Resources\Bookable;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'created_at' => $this->created_at,
            'rating' => (int) $this->rating,
            'content' => $this->content
        ];
    }
}
