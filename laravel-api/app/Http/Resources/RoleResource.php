<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'id'                    => $this->id,
            'role'                  => $this->role ?? "",
            'description'           => $this->description ?? "",
            'is_active'             => $this->is_active,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
            'deleted_at'            => $this->deleted_at,
            'created_by'            => $this->created_by,
            'updated_by'            => $this->updated_by,
            'deleted_by'            => $this->deleted_by,
            'detail_link'           => "roles/{$this->id}",
        ];
    }
}
