@extends('index')

@section('title', 'Liste des citoyens')

@section('content')
<div class="container-fluid mt-4">
    <!-- <div class="card"> -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Liste des citoyens</h2>
            <a href="{{ route('citizens.create') }}" class="btn btn-primary">
                <i class="las la-plus"></i> Ajouter un citoyen
            </a>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <!-- <th>Date de naissance</th> -->
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Commune</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($citizens as $index => $citizen)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($citizen->photo)
                                        <img src="{{ asset('storage/' . $citizen->photo) }}" 
                                             alt="Photo" 
                                             class="rounded-circle" 
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="las la-user text-white"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $citizen->nom }}</td>
                                <td>{{ $citizen->prenom }}</td>
                                <!-- <td>{{ \Carbon\Carbon::parse($citizen->date_naissance)->format('d/m/Y') }}</td> -->
                                <td>{{ $citizen->email ?? 'N/A' }}</td>
                                <td>{{ $citizen->phone ?? 'N/A' }}</td>
                                <td>{{ $citizen->commune->nom_commune ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('citizens.show', $citizen->id) }}" 
                                           class="btn btn-sm btn-info" 
                                           title="Voir">
                                            <i class="las la-eye"></i>
                                        </a>
                                        <a href="{{ route('citizens.edit', $citizen->id) }}" 
                                           class="btn btn-sm btn-warning" 
                                           title="Modifier">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <form action="{{ route('citizens.destroy', $citizen->id) }}" 
                                              method="POST" 
                                              class="d-inline" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce citoyen ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    title="Supprimer">
                                                <i class="las la-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">
                                    <div class="alert alert-info mb-0">
                                        <i class="las la-info-circle"></i> Aucun citoyen enregistré pour le moment.
                                        <a href="{{ route('citizens.create') }}" class="alert-link">Ajouter un citoyen</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    <!-- </div> -->
</div>
@endsection