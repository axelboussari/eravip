@extends('index')

@section('title', 'Détails du citoyen')

@section('content')
<div class="container mt-4">
    <!-- <div class="card"> -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Détails du citoyen</h2>
            <div>
                <a href="{{ route('citizens.edit', $citizen->id) }}" class="btn btn-warning">
                    <i class="las la-edit"></i> Modifier
                </a>
                <a href="{{ route('citizens.index') }}" class="btn btn-secondary">
                    <i class="las la-arrow-left"></i> Retour
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <!-- Photo Section -->
                @if($citizen->photo)
                <div class="col-md-3 text-center mb-3">
                    <img src="{{ asset('storage/' . $citizen->photo) }}" 
                         alt="Photo de {{ $citizen->nom }}" 
                         class="img-fluid rounded" 
                         style="max-width: 200px;">
                </div>
                @endif
                
                <!-- Information Section -->
                <div class="col-md-{{ $citizen->photo ? '9' : '12' }}">
                    <h4 class="mb-3">Informations personnelles</h4>
                    
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Nom:</strong> {{ $citizen->nom }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Prénom:</strong> {{ $citizen->prenom }}</p>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Date de naissance:</strong> {{ \Carbon\Carbon::parse($citizen->date_naissance)->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Lieu de naissance:</strong> {{ $citizen->lieu_naissance }}</p>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Nationalité:</strong> {{ $citizen->nationalite }}</p>
                        </div>
                        @if(isset($citizen->age))
                        <div class="col-md-6">
                            <p><strong>Âge:</strong> {{ $citizen->age }} ans</p>
                        </div>
                        @endif
                    </div>
                    
                    <hr>
                    
                    <h4 class="mb-3">Contact</h4>
                    
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $citizen->email ?? 'Non renseigné' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Téléphone:</strong> {{ $citizen->phone ?? 'Non renseigné' }}</p>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <p><strong>Adresse:</strong> {{ $citizen->adresse }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h4 class="mb-3">Localisation administrative</h4>
                    
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <p><strong>Commune:</strong> {{ $citizen->commune->nom_commune ?? 'N/A' }}</p>
                        <div class="col-md-4">
                            <p><strong>Arrondissement:</strong> {{ $citizen->arrondissement->nom_arrondissement?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Departement:</strong> {{ $citizen->commune->departement->nom_departement ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Quartier:</strong> {{ $citizen->quartier->nom_quartier ?? 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h4 class="mb-3">Filiation</h4>
                    
                    @php
                        $filiation = json_decode($citizen->filiation, true);
                    @endphp
                    
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p><strong>Parent 1:</strong> {{ $filiation['parent1'] ?? 'Non renseigné' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Parent 2:</strong> {{ $filiation['parent2'] ?? 'Non renseigné' }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h4 class="mb-3">Date d'expiration</h4>
                    
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <p><strong>Date d'expiration:</strong> {{ \Carbon\Carbon::parse($citizen->date_dexpire)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="mt-4">
                <form action="{{ route('citizens.destroy', $citizen->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce citoyen ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="las la-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    <!-- </div> -->
</div>
@endsection