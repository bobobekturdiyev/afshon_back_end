<?php

namespace App\Http\Resources\API\V1\APP;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
            'name' => $this->{$this->lang('name')},
            'excerpt_uz' => $this->excerpt,
            'keywords' => $this->keywords,
            'url' => $this->url,
            'image' => $this->image,
        ];
    }
}
