<?php

namespace App\Http\Resources\API\V1\WEB;

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
            'excerpt' => $this->{$this->lang('excerpt')},
            'keywords' => $this->keywords,
            'url' => $this->url,
            'image' => $this->image,
        ];
    }
}
