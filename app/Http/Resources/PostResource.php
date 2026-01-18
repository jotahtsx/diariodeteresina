<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'slug'          => $this->slug,
            'content'       => $this->content,
            'image_url'     => $this->image ? asset('storage/' . $this->image) : null,
            'instagram_url' => $this->instagram_url,
            'category'      => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
            ],
            'author'        => [
                'id'   => $this->author->id,
                'name' => $this->author->name,
            ],
            'created_at'    => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}
