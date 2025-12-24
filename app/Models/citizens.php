<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class citizens extends Model
{
        use HasFactory, HasUuids;

    protected $fillable = [
        'numero',
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'nationalite',
        'photo',
        'email',
        'phone',
        'adresse',
        'date_dexpire',
        'filiation',
        'commune_id',
        'quartier_id',
        'arrondissement_id',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_dexpire' => 'date',
        'filiation' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($citizen) {
            if (empty($citizen->numero)) {
                $citizen->numero = self::generateUniqueNumero();
            }
        });
    }

    /**
     * Générer un numéro unique
     */
    public static function generateUniqueNumero()
    {
        do {
            // Format: CIT-YYYYMMDD-XXXXX (ex: CIT-20231223-12345)
            $numero = 'CIT-' . date('Ymd') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        } while (self::where('numero', $numero)->exists());
        
        return $numero;
    }

    /**
     * Relation: Un citoyen appartient à une commune
     */
    public function commune()
    {
        return $this->belongsTo(communes::class);
    }

    /**
     * Relation: Un citoyen appartient à un quartier
     */
    public function quartier()
    {
        return $this->belongsTo(quartiers::class);
    }

    /**
     * Relation: Un citoyen appartient à un arrondissement
     */
    public function arrondissement()
    {
        return $this->belongsTo(arrondissements::class);
    }

    /**
     * Accessor: Obtenir le nom complet
     */
    public function getFullNameAttribute()
    {
        return "{$this->prenom} {$this->nom}";
    }

    /**
     * Accessor: Vérifier si la carte est expirée
     */
    public function getIsExpiredAttribute()
    {
        return $this->date_dexpire < now();
    }
}
