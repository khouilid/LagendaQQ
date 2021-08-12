<header class="">
    <!-- <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand ml-4 tw-nav-brand" href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            @php
                $menus = \App\Models\Menu::where('visible', 1)
                    ->orderby('position')
                    ->get();
                foreach ($menus as $menu) {
                    echo '
                                                    <li class="nav-item active">
                                                    <a class="nav-link" href="#top">' .
                        $menu->name .
                        '
                                                        <span class="sr-only">(current)</span>
                                                    </a>
                                                    </li>';
                }
            @endphp
          </ul>
        </div>
        <div class="ml-1">
            @if (Route::has('login'))
            @auth
                        <li class="nav-item dropdown"">
                            <a class="" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profil <i class="fa fa-user-shield"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @hasanyrole('super-admin')
                                    @include('layouts.front.partials.su-admin')
                                    @endrole
                                <a class="dropdown-item text-decoration-none" href="{{ route('user.infosperso') }}/infos-perso"><i class="fa fa-user mr-1"></i>Mon compte</a>
                                @hasanyrole('banquier')
                                    @include('layouts.front.partials.banker')
                                @endrole
                                @hasanyrole('chef-vendeur')
                                    @include('layouts.front.partials.cvendeur')
                                @endrole
                                @hasanyrole('vendeur')
                                    @include('layouts.front.partials.cvendeur')
                                @endrole
                                @hasanyrole('admin')
                                    @include('layouts.front.partials.admin')
                                @endrole
                                <hr>
                                {{-- @hasanyrole('vendeur|super-admin|annonceur|admin')
                            <a class="dropdown-item" href="{{route('user.my_events')}}"><i class="fas fa-calendar-check"></i>  Mes événements</a>
                            <a class="dropdown-item" href="{{route('user.my_announcements')}}"><i class="fa fa-bullhorn"></i> Mes Annonces</a>
                        @endrole --}}
                                <hr>
                                {{-- <a class="dropdown-item link-success" href="{{route('user.infosperso')}}/transactions" title="Lsite de mes transactions"><i class="fas fa-exchange-alt" aria-hidden="true"></i> Mes Transactions</a> --}}
                                {{-- <a class="dropdown-item link-primary" href="{{route('user.infosperso')}}/wallet" title="Mon Portefeuille"><i class="fa fa-wallet" aria-hidden="true"></i> Mon Portefeuille </a> --}}
                                <a class="dropdown-item link-primary" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fas fa-power-off mr-2"></i> Se déconnecter
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                            </li>
            @else
                    
                    <li class="nav-item dropdown tw-megamenu-wrapper">
                        <a href="{{ route('login') }}" class="" id="">
                            <i class="fa fa-user-circle-o mr-2"></i>
                        </a>
                    </li>
            @endauth
        @endif
        </div>
      </div>
      
    </nav> -->
</header>


{{-- <div class="d-flex justify-content-between align-items-center "> --}}
{{-- <div>
        <a class="navbar-brand ml-4 tw-nav-brand" href="{{ route('welcome') }}">
            <img src="{{asset('images/logo/logo.png')}}" alt="{{ config('app.name') }}">
        </a>
    </div> --}}

{{-- <div class="">
        <div class="">
            <div class="col-md-8 text-left">
                <div class="top-contact-info top-bar-link">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-row" id="top-header-links">
                @php 
                    $menus = \App\Models\Menu::where('visible',1)->orderby('position')->get();
                    foreach($menus as $menu){
                        echo '<li class="nav-item ml-2 dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> '.$menu->name.' <span class="icon icon-chevron-down"></span> </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                        if($menu->hasLinks()){
                            foreach($menu->menu_links as $link){
                                echo '<li><a class="dropdown-item" href="'.$link->url.'">'.$link->name.'</a></li>';
                            }
                        }
                        echo '  </ul>
                              </li>';
                    }
                @endphp
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link ml-2 dropdown-toggle">Publications</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu p-3 border-0 shadow">
                            <ul>
                                <h5 class="bold">Annonces Classées</h5>
                                
                                @foreach (\App\Models\Category::where('type', 'annonce')->skip(0)->take(10)->get()
    as $category)
                                    <li><a  class="dropdown-item" href="{{route('announcement_page',$category)}}">{{ $category->name }}</a></li>
                                @endforeach


                                <h5 class="mt-3">Événements par régions</h5>
                                
                                @foreach (\App\Models\Region::skip(6)->take(10)->get()
    as $region)
                                    <li><a class="dropdown-item" href="{{route('event_region',$region)}}">{{ $region->name }}</a></li>
                                @endforeach
                            </ul>
                        </ul>
                    </li>
                           
                    {{-- @auth
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link ml-2 dropdown-toggle">Fonctions</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <div class="accordion" id="accordionFlushExample">
                                @foreach ($user->roles as $role)
                                
                                     <ul>
                                        <li>
                                            <div class="col-12 row  " id="{{$role->id}}">
                                                <a href="#" class="dropdown-item " data-role_id="{{$role->id}}" data-role_description="{!! $role->description !!}" data-role_name="{{$role->name}}">{{$role->name}}</a>
                                            </div>
                                        </li>
                                    </ul>
                                @endforeach
                            </div>
                        </ul>
                    </li>
                    @endauth --}}
{{-- </ul> --}}

{{-- </div> --}}
{{-- </div> --}}


{{-- </div> --}}
<!-- Row End -->
{{-- </div> --}}

{{-- <div class="col-md-4 ml-auto row text-right"> --}}
{{-- <div class="top-contact-info mr-3">
            <span><i class="icon icon-chat"></i>Assistance en Ligne</span>
        </div> --}}
{{-- <div class="ml-1">
            @if (Route::has('login'))
            @auth
                <li class="nav-item dropdown"">
                    <a class="" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil <i class="fa fa-user-shield"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @hasanyrole('super-admin')
                            @include('layouts.front.partials.su-admin')
                            @endrole
                        <a class="dropdown-item text-decoration-none" href="{{route('user.infosperso')}}/infos-perso"><i class="fa fa-user mr-1"></i>Mon compte</a>
                        @hasanyrole('banquier')
                            @include('layouts.front.partials.banker')
                        @endrole
                        @hasanyrole('chef-vendeur')
                            @include('layouts.front.partials.cvendeur')
                        @endrole
                        @hasanyrole('vendeur')
                            @include('layouts.front.partials.cvendeur')
                        @endrole
                        @hasanyrole('admin')
                            @include('layouts.front.partials.admin')
                        @endrole
                        <hr> --}}
{{-- @hasanyrole('vendeur|super-admin|annonceur|admin')
                            <a class="dropdown-item" href="{{route('user.my_events')}}"><i class="fas fa-calendar-check"></i>  Mes événements</a>
                            <a class="dropdown-item" href="{{route('user.my_announcements')}}"><i class="fa fa-bullhorn"></i> Mes Annonces</a>
                        @endrole --}}
{{-- <hr> --}}
{{-- <a class="dropdown-item link-success" href="{{route('user.infosperso')}}/transactions" title="Lsite de mes transactions"><i class="fas fa-exchange-alt" aria-hidden="true"></i> Mes Transactions</a> --}}
{{-- <a class="dropdown-item link-primary" href="{{route('user.infosperso')}}/wallet" title="Mon Portefeuille"><i class="fa fa-wallet" aria-hidden="true"></i> Mon Portefeuille </a> --}}
{{-- <a class="dropdown-item link-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off mr-2"></i> Se déconnecter
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                    </li>
            @else
            
            <li class="nav-item dropdown tw-megamenu-wrapper">
                <a href="{{ route('login') }}" class="" id="">
                    <i class="fa fa-user-circle-o mr-2"></i>
                </a>
            </li>
            @endauth
        @endif
        </div>
    </div> --}}
<!-- Container End -->
{{-- </div> --}}
<!-- Top Bar end -->


<header class="">
    <!-- <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand ml-4 tw-nav-brand" href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            @php
                $menus = \App\Models\Menu::where('visible', 1)
                    ->orderby('position')
                    ->get();
                foreach ($menus as $menu) {
                    echo '
                                                    <li class="nav-item active">
                                                    <a class="nav-link" href="#top">' .
                        $menu->name .
                        '
                                                        <span class="sr-only">(current)</span>
                                                    </a>
                                                    </li>';
                }
            @endphp
          </ul>
        </div>
        <div class="ml-1">
            @if (Route::has('login'))
            @auth
                        <li class="nav-item dropdown"">
                            <a class="" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profil <i class="fa fa-user-shield"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @hasanyrole('super-admin')
                                    @include('layouts.front.partials.su-admin')
                                    @endrole
                                <a class="dropdown-item text-decoration-none" href="{{ route('user.infosperso') }}/infos-perso"><i class="fa fa-user mr-1"></i>Mon compte</a>
                                @hasanyrole('banquier')
                                    @include('layouts.front.partials.banker')
                                @endrole
                                @hasanyrole('chef-vendeur')
                                    @include('layouts.front.partials.cvendeur')
                                @endrole
                                @hasanyrole('vendeur')
                                    @include('layouts.front.partials.cvendeur')
                                @endrole
                                @hasanyrole('admin')
                                    @include('layouts.front.partials.admin')
                                @endrole
                                <hr>
                                {{-- @hasanyrole('vendeur|super-admin|annonceur|admin')
                            <a class="dropdown-item" href="{{route('user.my_events')}}"><i class="fas fa-calendar-check"></i>  Mes événements</a>
                            <a class="dropdown-item" href="{{route('user.my_announcements')}}"><i class="fa fa-bullhorn"></i> Mes Annonces</a>
                        @endrole --}}
                                <hr>
                                {{-- <a class="dropdown-item link-success" href="{{route('user.infosperso')}}/transactions" title="Lsite de mes transactions"><i class="fas fa-exchange-alt" aria-hidden="true"></i> Mes Transactions</a> --}}
                                {{-- <a class="dropdown-item link-primary" href="{{route('user.infosperso')}}/wallet" title="Mon Portefeuille"><i class="fa fa-wallet" aria-hidden="true"></i> Mon Portefeuille </a> --}}
                                <a class="dropdown-item link-primary" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fas fa-power-off mr-2"></i> Se déconnecter
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                            </li>
            @else
                    
                    <li class="nav-item dropdown tw-megamenu-wrapper">
                        <a href="{{ route('login') }}" class="" id="">
                            <i class="fa fa-user-circle-o mr-2"></i>
                        </a>
                    </li>
            @endauth
        @endif
        </div>
      </div>
      
    </nav> -->

    <!-- top-bar start -->
    <div id="topbar">
        <div class="topbar-styles container d-flex align-items-center justify-content-end">
                <div class="px-3">
                    <a class="text-white" href="#"><i class="fas fa-sign-in-alt mr-1"></i>Se connecter</a>
                </div>
                <div class="">
                    <a class="text-white" href="#"><i class="far fa-comment-dots mr-1"></i>Assistance</a>
                </div>
        </div>
    </div>
    <!-- top-bar end -->

    <!-- Navbar start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"> <img class="brand-size" src="{{ asset('images/logo/logo.png') }}" alt="{{ config('app.name') }}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item px-2 active">
                        <a class="nav-link" href="#">Accueil<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="#">Activité</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="#">Argent</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="#">Annonce</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Divers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mécanique</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="#">Travail</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" href="#">Publications</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->
</header>
