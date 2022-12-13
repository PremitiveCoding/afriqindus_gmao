<?php

namespace App\Models;
use App\Models\Site;
use App\Models\Document;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Client extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nom',
        'prenom',
        'ntva',
        'email',
        'emailSs',
        'emailFact',
        'adresse',
        'adresseSs',
        'tele',
        'observation',
        'siteInternet',
    ];

    /**
     * Get the user that owns the clients
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sites(): HasMany
    {
        return $this->hasMany(Site::class);
    }
    /**
     * Get all of the comments for the clients
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
