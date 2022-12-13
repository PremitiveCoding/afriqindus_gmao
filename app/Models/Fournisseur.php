<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Commande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fournisseur extends Model
{
    use HasFactory;
    protected $fillable=[
    'nom',
    'tel',
    'email',
    'tauxTVA',
    'code',
    'remarque',
    'adresse',
    'telSec',
    'numTVA',
    'active',
            ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class);
    }
}
