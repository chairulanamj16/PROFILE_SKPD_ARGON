<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PPIDResource extends JsonResource
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
            'ppid_category' => $this->ppid_category,
            'uuid' => $this->uuid,
            'title' => $this->title,
            'terbitkan_sebagai' => $this->terbitkan_sebagai,
            'jenis' => $this->jenis,
            'type_file' => $this->type_file,
            'file' => $this->file,
            'status' => $this->status,
            'status_file' => $this->status_file,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'office' => new OfficeResource($this->office),
            'didownload' => $this->didownload,
        ];
    }
}
