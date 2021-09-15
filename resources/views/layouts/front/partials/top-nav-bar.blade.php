<header>
    <!-- top-bar start -->
    <div id="topbar">
        <div class="topbar-styles container d-flex align-items-center justify-content-end">
            <div class="px-3">
                @guest
                <a class="text-white" href="{{ route('login') }}"><i class="fas fa-sign-in-alt mr-1"></i>Se
                    connecter</a>
                @endguest
                @auth
                <div class="d-flex align-items-center top-bar-links">
                    {{-- start --}}

                    <a class="mr-4" href="{{route('user.dashboard')}}" class="dropdown-item">
                        <i class="fas fa-tachometer-alt mr-2"></i> Adminstration
                    </a>

                    <a class="mr-4" href="{{route('user.infosperso')}}">
                        <i class="fas fa-user mr-2"></i> Mon Profil
                    </a>

                    <a class="mr-4" href="{{route('user.infosperso','security')}}">
                        <i class="fas fa-lock mr-2"></i> Securité
                    </a>
                    {{-- end --}}

                    <div class="">
                        <a class="text-white" href="#"><i class="far fa-comment-dots mr-1"></i>Assistance</a>
                    </div>

                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-deconnecter" type="submit" class="text-white"><i
                                class="fas fa-sign-out-alt mr-1"></i>Se
                            Déconnecter</button>
                    </form>
                </div>
                @endauth
            </div>

            <!-- profile start -->
            <!-- <div class="ml-1">
                @php 
            $menus = \App\Models\Menu::where('visible',1)->orderby('position')->get();
        
            foreach($menus as $menu){
                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false"> '.$menu->name.' <span class="icon icon-chevron-down"></span> </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">';
                if($menu->hasLinks()){
                    foreach($menu->menu_links as $link){
                        $linkToArray =  explode("/", $link->url);               
                        echo '<li><a class="dropdown-item" href="/pages/'. end($linkToArray).'">'.$link->name.'</a></li>';
                    }
                }
                                echo '  </ul>
                                </li>';
            }
                                @endphp
            </div> -->
            <!-- profile end -->
        </div>
    </div>
    <!-- top-bar end -->

    <!-- Navbar start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}"> <img class="brand-size"
                    src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @php
                    $menus = \App\Models\Menu::where('visible',1)->orderby('position')->get();

                    foreach($menus as $menu){
                    echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarSecond" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"> '.$menu->name.' </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarSecond">';
                            if($menu->hasLinks()){
                            foreach($menu->menu_links as $link){
                            $linkToArray = explode("/", $link->url);
                            echo '<li><a class="dropdown-item" href="/pages/'. end($linkToArray).'">'.$link->name.'</a>
                            </li>';
                            }
                            }
                            echo ' </ul>
                    </li>';
                    }
                    @endphp
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->
</header>