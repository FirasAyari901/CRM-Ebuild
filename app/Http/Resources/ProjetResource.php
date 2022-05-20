<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjetResource extends JsonResource
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
            'project_name' => $this->project_name,
            'attributes' => [
                'description' => $this->description,
                'deadline' => $this->deadline,
                'date_debut' => $this->date_debut,
                'etat' => $this->etat,
                'file_cdc' => $this->file_cdc,
                'capture_dc' => $this->capture_dc
            ] 
        ];
    }
}
