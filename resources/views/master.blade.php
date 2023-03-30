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
            @endguest
            @auth
                <h3>Bonjour {{Auth::user()->login}}</h3>
                <a href="/">Accueil</a>
                <a href="/user/{{Auth::user()->id}}">Mon Profil</a>
                <a href="/logout">Logout</a>
            @endauth
            
        </div>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>