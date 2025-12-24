<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class arrondissements extends Model
{
        use HasFactory, HasUuids;

    protected $fillable = [
        'nom_arrondissement',
        'commune_id',
    ];

    /**
     * Relation: Un arrondissement appartient à une commune
     */
    public function commune()
    {
        return $this->belongsTo(communes::class);
    }

    /**
     * Relation: Un arrondissement a plusieurs quartiers
     */
    public function quartiers()
    {
        return $this->hasMany(quartiers::class);
    }

    /**
     * Relation: Un arrondissement a plusieurs citoyens
     */
    public function citizens()
    {
        return $this->hasMany(citizens::class);
    }
}
