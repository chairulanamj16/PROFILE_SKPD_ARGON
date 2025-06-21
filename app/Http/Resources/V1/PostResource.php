<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'office_id' => $this->office_id,
            'uuid' => $this->uuid,
            'title' => $this->title,
            'excercept' => $this->excercept,
            'thumb' => $this->thumb,
            'categories' => $this->postCategories,
            'office' => [
                'name' => $this->office->name,
                'subdomain' => $this->office->subdomain,
                'logo' => $this->office->logo,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
