<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'categoria_id',
        'marca_id',
    ];

    /**
     * Relacionamento: Produto pertence a uma Categoria
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Relacionamento: Produto pertence a uma Marca
     */
    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }
}

