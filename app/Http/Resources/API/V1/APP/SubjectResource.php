<?php

namespace App\Http\Resources\API\V1\APP;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
            'title_uz' => $this->title,
            'title_ru' => $this->title,
            'title_en' => $this->title,
            'type' => $this->type,
        ];
    }
}
