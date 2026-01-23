<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    // Tradução básica para o botão e título da página de criação
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
