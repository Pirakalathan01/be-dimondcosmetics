<?php

namespace App\Http\Resources\AdminPortal\Document;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $expiration = now()->addMinutes(15);
        return [
            'id' => $this->id,
            'url' => Storage::disk('local')->temporaryUrl($this->file_name, $expiration),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
