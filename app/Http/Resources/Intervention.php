<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Intervention extends JsonResource
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
            'title' => strtoupper($this->titre),
            'start' => $this->dateDb,
            'end' => $this->dateFn,
            'user_id' => $this->user_id,
        ];
    }
}
