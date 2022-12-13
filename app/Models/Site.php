<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
use App\Models\Batiment;
use App\Models\Document;
use App\Models\Intervention;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Site extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'client_id',
        'nom',
        'email',
        'adresse',
        'tel',
        'observation',
    ];
    /**
     * Get all of the comment for the site
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function interventions(): HasMany
    {
        return $this->hasMany(Intervention::class);
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function batiments(): HasMany
    {
        return $this->hasMany(Batiment::class);
    }
    
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }
    
}
