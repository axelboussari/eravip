<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class quartiers extends Model
{
     use HasFactory, HasUuids;

    protected $fillable = [
        'nom_quartier',
        'arrondissement_id',
    ];

    /**
     * Relation: Un quartier appartient à un arrondissement
     */
    public function arrondissement()
    {
        return $this->belongsTo(arrondissements::class);
    }

    /**
     * Relation: Un quartier a plusieurs citoyens
     */
    public function citizens()
    {
        return $this->hasMany(citizens::class);
    }
}
