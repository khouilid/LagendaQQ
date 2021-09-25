<header>
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

                    <div class="align-self-center">
                        @guest
                        <a class="connecter-btn" href="{{ route('login') }}">Se
                            connecter</a>
                        @endguest

                        @auth
                        <div style="margin-top: -5px;" class="d-flex align-items-center top-bar-links">
                            {{-- start --}}

                            {{-- <a class="mr-4" href="{{route('user.dashboard')}}" class="dropdown-item">
                            <i class="fas fa-tachometer-alt mr-2"></i> Adminstration
                            </a> --}}


                            <li class="nav-item dropdown has-megamenu">
                                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"
                                    class="nav-link dropdown-toggle newnav-color-padding">Publications</a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    @auth

                                    @if( session()->get('role') !== null && (session()->get('role')->name ==
                                    'super-admin'
                                    ||
                                    session()->get('role')->name == 'admin' || session()->get('role')->name ==
                                    'annonceur'
                                    ||
                                    session()->get('role')->name == 'vendeur' ))

                                    <div class="row border-bottom">
                                        <li class="nav-item">
                                            <h5 class="bold"> <a href="{{ route('user.my_events') }}"
                                                    class="nav-link {{ side_nav_bar_menu_status('events','active') }}">
                                                    Mes
                                                    événements</a></h5>
                                        </li>
                                        <li class="nav-item">
                                            <h5 class="bold"><a href="{{route('user.my_announcements')}}"
                                                    class="nav-link">
                                                    Mes annonces</a></h5>
                                        </li>

                                    </div>

                                    @endif
                                    @endauth
                                    <ul class="d-flex flex-wrap megamenu">




                                        @php
                                        $cats = ['evènement' => 'Evènement',
                                        'annonce' => 'Annonces Classées',
                                        'Automobile' => 'Automobile',
                                        'Commerciale' => 'Commerciale',
                                        'Construction' => 'Construction',
                                        'Décès' => 'Décès',
                                        'ÉcrivHeur' => 'ÉcrivHeur',
                                        'Emploi' => 'Emploi',
                                        'Gens du pays' => 'Gens du pays',
                                        'Hébergement' => 'Hébergement',
                                        'Immobilière' => 'Immobilière',
                                        'LAGENDA' => 'LAGENDA',
                                        'Politique' => 'Politique',
                                        'Rencontre' => 'Rencontre',
                                        'Service' => 'Service',
                                        // 'Bannière audio' => 'Bannière audio',
                                        // 'Bannière Vidéo' => 'Bannière Vidéo',
                                        // 'Bannière Web' => 'Bannière Web',
                                        ];
                                        @endphp

                                        @foreach($cats as $key => $value )
                                        <div class="mr-4">
                                            @php $result = \App\Models\Category::where('type',$key)->get(); @endphp
                                            @if (count($result) !== 0)
                                            <h5 class="bold">{{$value}}</h5>
                                            @foreach($result as $category)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{route('announcement_page',$category)}}">{{ $category->name }}</a>
                                            </li>
                                            @endforeach
                                            @endif
                                        </div>
                                        @endforeach
                                    </ul>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"
                                    class="nav-link dropdown-toggle newnav-color-padding">Profil</a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    <li>
                                        <a class="dropdown-item" href="{{route('user.infosperso')}}/account"><i
                                                class="fa fa-cogs"></i> Mon Compte</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('user.infosperso')}}/infos-perso"><i
                                                class="fa fa-user"></i> Infos personelles</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item link-success"
                                            href="{{route('user.infosperso')}}/transactions"
                                            title="Lsite de mes transactions"><i class="fas fa-exchange-alt"
                                                aria-hidden="true"></i>
                                            Mes Transactions</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item link-primary" href="{{route('user.infosperso')}}/wallet"
                                            title="Mon Portefeuille"><i class="fa fa-wallet" aria-hidden="true"></i> Mon
                                            Portefeuille </a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item link-primary"
                                            href="{{route('user.infosperso')}}/security" title="Mon Portefeuille"><i
                                                class="fa fa-wallet" aria-hidden="true"></i>
                                            Sécurité </a>
                                    </li>
                                </ul>
                            </li>

                            {{-- <a class="mr-4" href="{{route('user.infosperso','security')}}">
                            <i class="fas fa-lock mr-2"></i> Securité
                            </a> --}}
                            {{-- end --}}

                            <div class="ml-2">
                                <a style="color: #00000080" class="" href="#">Assistances</a>
                            </div>

                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="ml-2 btn btn-deconnecter text-primary" type="submit">Se
                                    Déconnecter</button>
                            </form>

                            <div class="ml-2">
                                

                                <span class="badge badge-secondary">
                                    

                                    @if(session()->get('role') !== null)
                                        <span class="badge bg-info">{{session()->get('role')->name}}</span>
                                    @else

                                    
                                </span>
                            </div>
                        </div>
                        @endauth
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->
</header>