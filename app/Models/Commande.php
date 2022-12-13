<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Fournisseur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;
    protected $fillable= [
        'titre',
        'article_id',
        'description',
        'dateLivraison',
        'adresseLivraison',
        'quantite',
        'status',
        'total',
        'totalHTVA',
    ];

    /**
     * Get the articles that owns the Commande
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class );
    }

    public function fournisseur() : BelongsTo
    {
        return $this->belongsTo(Fournisseur::class );
    }
}
