<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingByReviewShowResource extends JsonResource
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
            'booking_id' => $this->id,
            'from' => $this->from->toDateString(),
            'to' => $this->to->toDateString(),
            'bookable' => new BookingByReviewBookableShowResource($this->bookable)
        ];
    }
}
