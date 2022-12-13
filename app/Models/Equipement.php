<?php

namespace App\Models;
use App\Models\Document;
use App\Models\Batiment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Equipement extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'type',
        'qt',
        'tempsUtilEquip',
        'batiment_id',
        'document_id',
    ];
    /**
     * Get the batiment that owns the Equipements
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function batiment(): BelongsTo
    {
        return $this->belongsTo(Batiment::class);
    }

    /**
     * Get all of the comments for the Equipements
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * Get all of the comments for the Equipements
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sousequipements(): HasMany
    {
        return $this->hasMany(SousEquipement::class);
    }
    
}
