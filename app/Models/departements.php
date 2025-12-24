<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class departements extends Model
{
    //
    use HasFactory, HasUuids;
    protected $fillable = [
        'nom_departement',
    ];

        public function communes()
    {
        return $this->hasMany(communes::class);
    }
}
