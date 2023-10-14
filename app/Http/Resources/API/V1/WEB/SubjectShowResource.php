<?php

namespace App\Http\Resources\API\V1\WEB;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectShowResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->{$this->lang('title')},
            'files' => $this->files,
        ];
    }
}
