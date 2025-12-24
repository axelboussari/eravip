@extends('index')

@section('title', 'Modifier le citoyen')

@section('content')
<div class="container mt-4">
    <!-- <div class="card"> -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Modifier le citoyen</h2>
            <a href="{{ route('citizens.index') }}" class="btn btn-secondary">
                <i class="las la-arrow-left"></i> Retour
            </a>
        </div>
        
        <div class="card-body">
            <form action="{{ route('citizens.update', $citizen->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Informations personnelles -->
                    <div class="col-md-12">
                        <h4 class="mb-3">Informations personnelles</h4>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                               id="nom" name="nom" value="{{ old('nom', $citizen->nom) }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                               id="prenom" name="prenom" value="{{ old('prenom', $citizen->prenom) }}" required>
                        @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                               id="date_naissance" name="date_naissance" 
                               value="{{ old('date_naissance', $citizen->date_naissance) }}" required>
                        @error('date_naissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="lieu_naissance" class="form-label">Lieu de naissance <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('lieu_naissance') is-invalid @enderror" 
                               id="lieu_naissance" name="lieu_naissance" 
                               value="{{ old('lieu_naissance', $citizen->lieu_naissance) }}" required>
                        @error('lieu_naissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nationalite" class="form-label">Nationalité <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nationalite') is-invalid @enderror" 
                               id="nationalite" name="nationalite" 
                               value="{{ old('nationalite', $citizen->nationalite) }}" required>
                        @error('nationalite')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- <div class="col-md-6 mb-3">
                        <label for="age" class="form-label">Âge <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('age') is-invalid @enderror" 
                               id="age" name="age" value="{{ old('age', $citizen->age) }}" required>
                        @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> -->
                    
                    <div class="col-md-12 mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        @if($citizen->photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $citizen->photo) }}" 
                                     alt="Photo actuelle" 
                                     class="img-thumbnail" 
                                     style="max-width: 150px;">
                                <p class="text-muted small">Photo actuelle</p>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                               id="photo" name="photo" accept="image/*">
                        <small class="text-muted">Formats acceptés: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Contact -->
                    <div class="col-md-12 mt-3">
                        <h4 class="mb-3">Contact</h4>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $citizen->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ old('phone', $citizen->phone) }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label for="adresse" class="form-label">Adresse <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('adresse') is-invalid @enderror" 
                                  id="adresse" name="adresse" rows="3" required>{{ old('adresse', $citizen->adresse) }}</textarea>
                        @error('adresse')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Localisation administrative -->
                    <div class="col-md-12 mt-3">
                        <h4 class="mb-3">Localisation administrative</h4>
                    </div>


                    <div class="col-md-4 mb-3">
                        <label for="departement_id" class="form-label">Departement <span class="text-danger">*</span></label>
                        <select class="form-select @error('departement_id') is-invalid @enderror" 
                                id="departement_id" name="departement_id" required>
                            <option value="">Sélectionner un département</option>
                            @foreach($departements as $departement)
                                <option value="{{ $departement->id }}" 
                                    {{ old('departement_id', $citizen->departement_id) == $departement->id ? 'selected' : '' }}>
                                    {{ $departement->nom_departement }}
                                </option>
                            @endforeach
                        </select>
                        @error('departement_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="commune_id" class="form-label">Commune <span class="text-danger">*</span></label>
                        <select class="form-select @error('commune_id') is-invalid @enderror" 
                                id="commune_id" name="commune_id" required>
                            <option value="">Sélectionner une commune</option>
                            @foreach($communes as $commune)
                                <option value="{{ $commune->id }}" 
                                    {{ old('commune_id', $citizen->commune_id) == $commune->id ? 'selected' : '' }}>
                                    {{ $commune->nom_commune }}
                                </option>
                            @endforeach
                        </select>
                        @error('commune_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="arrondissement_id" class="form-label">Arrondissement <span class="text-danger">*</span></label>
                        <select class="form-select @error('arrondissement_id') is-invalid @enderror" 
                                id="arrondissement_id" name="arrondissement_id" required>
                            <option value="">Sélectionner un arrondissement</option>
                            @foreach($arrondissements as $arrondissement)
                                <option value="{{ $arrondissement->id }}" 
                                    {{ old('arrondissement_id', $citizen->arrondissement_id) == $arrondissement->id ? 'selected' : '' }}>
                                    {{ $arrondissement->nom_arrondissement }}
                                </option>
                            @endforeach
                        </select>
                        @error('arrondissement_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="quartier_id" class="form-label">Quartier <span class="text-danger">*</span></label>
                        <select class="form-select @error('quartier_id') is-invalid @enderror" 
                                id="quartier_id" name="quartier_id" required>
                            <option value="">Sélectionner un quartier</option>
                            @foreach($quartiers as $quartier)
                                <option value="{{ $quartier->id }}" 
                                    {{ old('quartier_id', $citizen->quartier_id) == $quartier->id ? 'selected' : '' }}>
                                    {{ $quartier->nom_quartier }}
                                </option>
                            @endforeach
                        </select>
                        @error('quartier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Filiation -->
                    <div class="col-md-12 mt-3">
                        <h4 class="mb-3">Filiation</h4>
                    </div>
                    
                    @php
                        $filiation = json_decode($citizen->filiation, true);
                    @endphp
                    
                    <div class="col-md-6 mb-3">
                        <label for="filiation_parent1" class="form-label">Parent 1 <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('filiation.parent1') is-invalid @enderror" 
                               id="filiation_parent1" name="filiation[parent1]" 
                               value="{{ old('filiation.parent1', $filiation['parent1'] ?? '') }}" required>
                        @error('filiation.parent1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="filiation_parent2" class="form-label">Parent 2</label>
                        <input type="text" class="form-control @error('filiation.parent2') is-invalid @enderror" 
                               id="filiation_parent2" name="filiation[parent2]" 
                               value="{{ old('filiation.parent2', $filiation['parent2'] ?? '') }}">
                        @error('filiation.parent2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Date d'expiration -->
                    <div class="col-md-12 mt-3">
                        <h4 class="mb-3">Date d'expiration</h4>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="date_dexpire" class="form-label">Date d'expiration <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date_dexpire') is-invalid @enderror" 
                               id="date_dexpire" name="date_dexpire" 
                               value="{{ old('date_dexpire', $citizen->date_dexpire) }}" required>
                        @error('date_dexpire')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Buttons -->
                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="las la-save"></i> Enregistrer les modifications
                        </button>
                        <a href="{{ route('citizens.show', $citizen->id) }}" class="btn btn-secondary">
                            <i class="las la-times"></i> Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    <!-- </div> -->
</div>
@endsection

@push('scripts')
<script>
    // AJAX pour charger les arrondissements en fonction de la commune sélectionnée
    document.getElementById('commune_id').addEventListener('change', function() {
        const communeId = this.value;
        const arrondissementSelect = document.getElementById('arrondissement_id');
        const quartierSelect = document.getElementById('quartier_id');
        
        // Réinitialiser les sélections
        arrondissementSelect.innerHTML = '<option value="">Sélectionner un arrondissement</option>';
        quartierSelect.innerHTML = '<option value="">Sélectionner un quartier</option>';
        
        if (communeId) {
            fetch(`/arrondissements/${communeId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(arrondissement => {
                        const option = document.createElement('option');
                        option.value = arrondissement.id;
                        option.textContent = arrondissement.nom;
                        arrondissementSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur:', error));
        }
    });
    
    // AJAX pour charger les quartiers en fonction de l'arrondissement sélectionné
    document.getElementById('arrondissement_id').addEventListener('change', function() {
        const arrondissementId = this.value;
        const quartierSelect = document.getElementById('quartier_id');
        
        // Réinitialiser la sélection
        quartierSelect.innerHTML = '<option value="">Sélectionner un quartier</option>';
        
        if (arrondissementId) {
            fetch(`/quartiers/${arrondissementId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(quartier => {
                        const option = document.createElement('option');
                        option.value = quartier.id;
                        option.textContent = quartier.nom;
                        quartierSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur:', error));
        }
    });
</script>
@endpush