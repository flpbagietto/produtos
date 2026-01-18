<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marcas';

    protected $fillable = [
        'nome',
    ];

    /**
     * Relacionamento: Marca possui muitos Produtos
     */
    public function produtos(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class, 'produto_marca');
    }
}

