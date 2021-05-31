<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TaskResource
 * @package App\Http\Resources
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $status
 */
class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return
            [
                'task id '.$this->id => [
                    'name' => $this->name,
                    'description' => $this->description,
                    'status' => $this->status,
                ]
            ];
    }
}
