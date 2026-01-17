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
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'titulo'    => $this->title,
            'slug'      => $this->slug,
            'resumo'    => str($this->content)->limit(150),
            'publicado' => $this->created_at->format('d/m/Y H:i'),
            'categoria' => [
                'nome' => $this->category->name,
                'cor'  => $this->category->color,
                'slug' => $this->category->slug,
            ],
            'autor'     => [
                'nome'   => $this->author->name,
                'origem' => "{$this->author->city}/{$this->author->state}",
            ],
            'links'     => [
                'instagram' => $this->instagram_url,
            ]
        ];
    }
}
