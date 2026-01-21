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
            'visualizacoes' => $this->views ?? 0, // Adicionado para o contador de lidas
            'categoria' => optional($this->category)->name ?? 'Geral',
            'categoria_cor' => optional($this->category)->color ?? '#333333', // Cor para o design
            'autor' => [
                'nome' => $this->author?->name ?? 'Redação',
                'localizacao' => ($this->author?->city ?? 'Teresina') . '/' . ($this->author?->state ?? 'PI'),
            ],
            'publicado_em' => $this->created_at->format('d/m/Y H:i'),
            'links_externos' => [
                'instagram' => $this->instagram_url, // Corrigido para bater com o seu Model
                'telegram' => $this->telegram_message_id,
            ],
            'e_destaque' => (bool) $this->is_featured,
        ];
    }
}
