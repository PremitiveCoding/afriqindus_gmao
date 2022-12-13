<?php

namespace App\Models;
// use App\Models\Document;
// use App\Models\Site;
// use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Intervention extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'titre',
        'user_id',
        'site_id',
        'document_id',
        'type',
        'desc',
        'urgence',
        'status',
        'dateDb',
        'dateFn',
        'etat',
        'tempsNes',
        'frequence',
    ];
    /**
     * Get all of the comments for the interventions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }
    /**
     * Get the user that owns the interventions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
    /**
     * The user that belong to the interventions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
