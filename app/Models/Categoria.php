<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nome',
    ];

    /**
     * Relacionamento: Categoria possui muitos Produtos
     */
    public function produtos(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class, 'produto_categoria');
    }
}

