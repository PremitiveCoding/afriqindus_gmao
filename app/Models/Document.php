<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Document extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];
    protected $appends = ['full_url'];
    /**
     * The roles that belong to the documents
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getFullUrlAttribute(){
        return url('storage/app/public/documents/' . $this->nom);
    }
}
