<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SousEquipement extends Model
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
        'equipement_id',
    ];
    public function equipement(): BelongsTo
    {
        return $this->belongsTo(Equipement::class);
    }
    
}
