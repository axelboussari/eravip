<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> -->

    
</head>
<script>
    // Empêche le retour arrière après déconnexion
    if (window.history && window.history.pushState) {
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function () {
            window.history.go(1);
        };
    }
</script>

<body>
    <input type="checkbox" id="menu-toggle">

    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="side-header">
            <img src={{ asset('assets/img/logo.png') }} alt="Logo" style="width: 50%;">

            <!-- <div class="ejdjdn" style="background-image: url({{ asset('assets/img/logo.png') }})"></div> -->
            <!-- <h3>M<span>odern</span></h3> -->
        </div>

        <div class="side-content">
            <!-- <div class="profile">
                <div class="profile-img bg-img" style="background-image: url({{ asset('assets/img/person.png') }})"></div>
                <h4>{{ Auth::user()->nom ?? 'Utilisateur' }}</h4>
                <small>{{ Auth::user()->prenom ?? 'Admin' }}</small>
            </div> -->

            <div class="side-menu">
                <ul style="padding-left: 0rem !important;">
                    <li>
                        <a href="{{ route('citizens.index') }}" class="{{ request()->routeIs('citizens.index') ? 'active' : '' }}">
                        
                            <span class="las la-home"></span>
                            <small>Tableau de bord</small>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('citizens.create') }}" class="{{ request()->routeIs('citizens.create') ? 'active' : '' }}">
                        
                            <span class="las la-user-alt"></span>
                            <small>Citoyens</small>
                        </a>
                    </li>
                    <!-- <li>
                         <a href="{{ route('citizens.index') }}" class="{{ request()->routeIs('citizens.index') ? 'active' : '' }}">
                            <span class="bi bi-folder-plus"></span>
                            <small>Projets</small>
                        </a>
                    </li> -->
                    <!-- <li>
                     
                            <span class="bi bi-plus-circle"></span>
                            <small>Ajouter un équipement</small>
                        </a>
                    </li> -->
                    <!-- <li>
                  
                            <span class="las la-tasks"></span>
                            <small>Liste des équipements</small>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>

    {{-- Contenu principal --}}
    <div class="main-content">
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">
                     <div>
                        <i class="fa-solid fa-user"></i>
                        <!-- <span>{{ Auth::user()->nom ?? 'Utilisateur' }}</span> -->
                        <!-- <small> {{ Auth::user()->nom ?? 'Utilisateur' }} {{ Auth::user()->prenom ?? 'Admin' }}</small> -->
                     </div>
                    <div class="user">
                        <form method="POST" action="#">
                            @csrf
                            <button class="btn-logout" type="submit">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <!-- <span>Déconnexion</span> -->
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>
     <script src="{{ asset('assets/js/script.js') }}"></script>
    @stack('scripts') 

</body>
</html>