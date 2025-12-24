@extends('index')

@section('content')
<div class="container-sm" style="width: 60%;">
    <h1>Créer un nouveau citoyen</h1>

    <form action="{{ route('citizens.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                           id="nom" name="nom" value="{{ old('nom') }}" required>
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                           id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                    @error('prenom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="date_naissance">Date de naissance *</label>
                    <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                           id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                    @error('date_naissance')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="lieu_naissance">Lieu de naissance *</label>
                    <input type="text" class="form-control @error('lieu_naissance') is-invalid @enderror" 
                           id="lieu_naissance" name="lieu_naissance" value="{{ old('lieu_naissance') }}" required>
                    @error('lieu_naissance')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nationalite">Nationalité *</label>
                    <input type="text" class="form-control @error('nationalite') is-invalid @enderror" 
                           id="nationalite" name="nationalite" value="{{ old('nationalite') }}" required>
                    @error('nationalite')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                           id="photo" name="photo" accept="image/*">
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Téléphone *</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                           id="phone" name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse *</label>
            <textarea class="form-control @error('adresse') is-invalid @enderror" 
                      id="adresse" name="adresse" rows="3" required>{{ old('adresse') }}</textarea>
            @error('adresse')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_dexpire">Date d'expiration *</label>
            <input type="date" class="form-control @error('date_dexpire') is-invalid @enderror" 
                   id="date_dexpire" name="date_dexpire" value="{{ old('date_dexpire') }}" required>
            @error('date_dexpire')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Filiation -->
        <h4>Filiation</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="parent1">Parent 1 *</label>
                    <input type="text" class="form-control @error('filiation.parent1') is-invalid @enderror" 
                           id="parent1" name="filiation[parent1]" value="{{ old('filiation.parent1') }}" required>
                    @error('filiation.parent1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="parent2">Parent 2</label>
                    <input type="text" class="form-control @error('filiation.parent2') is-invalid @enderror" 
                           id="parent2" name="filiation[parent2]" value="{{ old('filiation.parent2') }}">
                    @error('filiation.parent2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Localisation en cascade -->
        <h4>Localisation</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="departement_id">Département *</label>
                    <select class="form-control @error('departement_id') is-invalid @enderror" 
                            id="departement_id" required>
                        <option value="">-- Sélectionner --</option>
                        @foreach($departements as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->nom_departement }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="commune_id">Commune *</label>
                    <select class="form-control @error('commune_id') is-invalid @enderror" 
                            id="commune_id" name="commune_id" required disabled>
                        <option value="">-- Sélectionner --</option>
                    </select>
                    @error('commune_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="arrondissement_id">Arrondissement *</label>
                    <select class="form-control @error('arrondissement_id') is-invalid @enderror" 
                            id="arrondissement_id" name="arrondissement_id" required disabled>
                        <option value="">-- Sélectionner --</option>
                    </select>
                    @error('arrondissement_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="quartier_id">Quartier *</label>
                    <select class="form-control @error('quartier_id') is-invalid @enderror" 
                            id="quartier_id" name="quartier_id" required disabled>
                        <option value="">-- Sélectionner --</option>
                    </select>
                    @error('quartier_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="{{ route('citizens.index') }}" class="btn btn-primary">Annuler</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const departementSelect = document.getElementById('departement_id');
    const communeSelect = document.getElementById('commune_id');
    const arrondissementSelect = document.getElementById('arrondissement_id');
    const quartierSelect = document.getElementById('quartier_id');

    // Quand un département est sélectionné
    departementSelect.addEventListener('change', function() {
        const departementId = this.value;
        
        // Réinitialiser les selects suivants
        communeSelect.innerHTML = '<option value="">-- Chargement... --</option>';
        communeSelect.disabled = true;
        arrondissementSelect.innerHTML = '<option value="">-- Sélectionner une commune d\'abord --</option>';
        arrondissementSelect.disabled = true;
        quartierSelect.innerHTML = '<option value="">-- Sélectionner un arrondissement d\'abord --</option>';
        quartierSelect.disabled = true;

        if (departementId) {
            // Charger les communes
            fetch(`/api/communes/departement/${departementId}`)
                .then(response => response.json())
                .then(data => {
                    communeSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                    data.data.forEach(commune => {
                        communeSelect.innerHTML += `<option value="${commune.id}">${commune.nom_commune}</option>`;
                    });
                    communeSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    communeSelect.innerHTML = '<option value="">-- Erreur de chargement --</option>';
                });
        }
    });

    // Quand une commune est sélectionnée
    communeSelect.addEventListener('change', function() {
        const communeId = this.value;
        
        // Réinitialiser les selects suivants
        arrondissementSelect.innerHTML = '<option value="">-- Chargement... --</option>';
        arrondissementSelect.disabled = true;
        quartierSelect.innerHTML = '<option value="">-- Sélectionner un arrondissement d\'abord --</option>';
        quartierSelect.disabled = true;

        if (communeId) {
            // Charger les arrondissements
            fetch(`/api/arrondissements/commune/${communeId}`)
                .then(response => response.json())
                .then(data => {
                    arrondissementSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                    data.forEach(arrondissement => {
                        arrondissementSelect.innerHTML += `<option value="${arrondissement.id}">${arrondissement.nom_arrondissement}</option>`;
                    });
                    arrondissementSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    arrondissementSelect.innerHTML = '<option value="">-- Erreur de chargement --</option>';
                });
        }
    });

    // Quand un arrondissement est sélectionné
    arrondissementSelect.addEventListener('change', function() {
        const arrondissementId = this.value;
        
        // Réinitialiser le select quartier
        quartierSelect.innerHTML = '<option value="">-- Chargement... --</option>';
        quartierSelect.disabled = true;

        if (arrondissementId) {
            // Charger les quartiers
            fetch(`/api/quartiers/arrondissement/${arrondissementId}`)
                .then(response => response.json())
                .then(data => {
                    quartierSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                    data.forEach(quartier => {
                        quartierSelect.innerHTML += `<option value="${quartier.id}">${quartier.nom_quartier}</option>`;
                    });
                    quartierSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    quartierSelect.innerHTML = '<option value="">-- Erreur de chargement --</option>';
                });
        }
    });
});
</script>
@endpush
@endsection