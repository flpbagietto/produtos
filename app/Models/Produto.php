<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    /**
     * Relacionamento: Produto possui muitas Categorias
     */
    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class, 'produto_categoria');
    }

    /**
     * Relacionamento: Produto possui muitas Marcas
     */
    public function marcas(): BelongsToMany
    {
        return $this->belongsToMany(Marca::class, 'produto_marca');
    }
}

