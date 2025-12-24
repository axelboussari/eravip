<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class communes extends Model
{

    use HasFactory, HasUuids;

    protected $fillable = [
        'nom_commune',
        'departement_id',
    ];

    /**
     * Relation: Une commune appartient à un département
     */
    public function departement()
    {
        return $this->belongsTo(departements::class);
    }

    /**
     * Relation: Une commune a plusieurs arrondissements
     */
    public function arrondissements()
    {
        return $this->hasMany(arrondissements::class);
    }

    /**
     * Relation: Une commune a plusieurs citoyens
     */
    public function citizens()
    {
        return $this->hasMany(citizens::class);
    }
}
