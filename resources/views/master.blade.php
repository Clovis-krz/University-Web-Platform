<html>
    <head>
        <title>UPEC - @yield('title')</title>
    </head>
    <body>
        <div class="container">
            @if(session()->has('etat'))
                <p class="etat">{{session()->get('etat')}}</p>
            @endif

            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @guest
                <a href="/">Accueil</a>
                <a href="/login">Login</a>
                <a href="/register">S'enregistrer</a>
            @endguest
            @auth
                <h3>Bonjour {{Auth::user()->login}}</h3>
                <a href="/">Accueil</a>
                <a href="/user/{{Auth::user()->id}}">Mon Profil</a>
                @if(Auth::user()->type == "admin")
                    <a href="/cours/list">Cours</a>
                    <a href="/planning/list">Planning</a>
                    <a href="/formation">Formations</a>
                    <a href="/user/list">Utilisateurs</a>
                @endif
                @if(Auth::user()->type == "etudiant")
                    <a href="/cours/my">Mes Cours</a>
                    <a href="/planning/list/student">Mon Planning</a>
                    <a href="/cours/formation/my">Cours</a>
                @endif
                @if(Auth::user()->type == "enseignant")
                    <a href="/cours/iteach">Mes Cours</a>
                    <a href="/planning/list/teacher">Planning</a>
                @endif
                <a href="/logout">Logout</a>
            @endauth
            
        </div>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>