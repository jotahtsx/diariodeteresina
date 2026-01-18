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
            'id' => $this->id,
            'titulo' => $this->title,
            'slug' => $this->slug,
            'conteudo' => $this->content,
            'imagem' => $this->image ? asset('storage/' . $this->image) : null,
            'categoria' => $this->category->name ?? 'Geral',
            'autor' => [
                'nome' => $this->author->name ?? 'Redação',
                'localizacao' => ($this->author->city ?? 'Teresina').'/'.($this->author->state ?? 'PI'),
            ],
            'publicado_em' => $this->created_at->format('d/m/Y H:i'),
            'links_externos' => [
                'instagram' => $this->instagram_post_url,
                'telegram' => $this->telegram_message_id,
            ],
            // Carrega as relacionadas apenas se você quiser (evita lentidão)
            'relacionadas' => $this->when($request->routeIs('*.show'), function () {
                return \App\Models\Post::where('category_id', $this->category_id)
                    ->where('id', '!=', $this->id)
                    ->limit(3)
                    ->get(['id', 'title', 'slug']);
            }),
        ];
    }
}
