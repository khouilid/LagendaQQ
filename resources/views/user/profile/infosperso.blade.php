@php use Carbon\Carbon;@endphp
@extends('layouts.front.app')

<!-- @ section('title','Informations personelles') -->

@section('content')

{{-- <div class="my-4 col-4"> --}}
{{-- <div class="col-1">
        
    </div> --}}

{{-- @php
        dd( auth()->user()->roles);  
        @endphp --}}
{{-- <div class="justify-content-between align-items-center d-flex"> --}}
{{-- <h2 class="my-0">{{$user->username}}</h2> --}}
{{-- <div> --}}

{{-- @if(session()->get('role') !== null)
                <span class="badge bg-info">{{session()->get('role')->name}}</span>
@else
@foreach ($user->roles as $role)
<span class="badge bg-info">{{$role->name}}</span>
@endforeach

@endif --}}
{{-- </div> --}}


{{-- </div> --}}

<div class="row">
    <div class="col d-flex justify-content-center">

        <div class="toggle mt-5" onclick="leftBar()">
            <div class="card shadow-none mr-3 left-bar">
                <div class="card-body d-flex flex-column position-relative">
                    @if ($user->avatar !== null)
                        <img style="height: 178px; width: 180px;  object-fit: cover;"
                            src="{{$user->avatar}}" alt="" class="rounded-circle align-self-center"
                            width="50">
                        
                    @else
                            <img style="height: 178px; width: 180px;  object-fit: cover;"
                            src="{{asset('dist/img/29213195-male-silhouette-avatar-profile-picture.jpg')}}" alt="" class="rounded-circle align-self-center"
                            width="50">
                    @endif



                    <img style="right: 10px;" class="position-absolute" src="{{asset('dist/img/Star-1.png')}}" alt="">
                    <img class="position-absolute" src="{{asset('dist/img/Star-1.png')}}" alt="">


                    {{-- @php 
                        dd($user);
                        
                    @endphp --}}
                    {{-- <h5 class="card-title">{{$user->username}}</h5> --}}
                    <p class="card-text">
                        <h4 class="font-weight-bold">{{$user->prenom}} {{$user->name}}</h4>
                        <h6 class="card-subtitle mb-1 custom-profile-color text-muted">{{$user->username}}</h6>
                        <h6 class="text-muted mb-1"> {{$user->mobile_phone}}</h6>
                        {{-- <h5 class="my-0 bold"><small></small>{{$user->num_civique}}</h5> --}}
                        <h6 class="my-0 text-muted mb-1">{{$user->email}}</h6>
                        <small class="text-muted">Compte crée {{$user->created_at}}</small>
                    </p>
                </div>
            </div>
        </div>



        {{-- </div> --}}
        <div class="">
            <nav>
                <div class="nav nav-tabs mt-5" id="nav-tab" role="tablist">
                    <a class="nav-link {{@$default_tab=='account'?'active':''}}" id="nav-account-tab"
                        data-bs-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-account"
                        aria-selected="true">Mon Compte</a>
                    <a class="nav-link {{@$default_tab=='wallet'?'active':''}}" id="nav-wallet-tab" data-bs-toggle="tab"
                        href="#nav-wallet" role="tab" aria-controls="nav-wallet" aria-selected="false"> Mon portefeuille
                    </a>
                    <a class="nav-link {{@$default_tab=='transactions'?'active':''}}" id="nav-transactions-tab"
                        data-bs-toggle="tab" href="#nav-transactions" role="tab" aria-controls="nav-transactions"
                        aria-selected="false">Mes transferts</a>
                    <a class="nav-link {{@$default_tab=='infos-perso'?'active':''}}" id="nav-infos-perso-tab"
                        data-bs-toggle="tab" href="#nav-infos-perso" role="tab" aria-controls="nav-infos-perso"
                        aria-selected="false">Informations Personelles</a>
                    <a class="nav-link {{@$default_tab=='security'?'active':''}}" id="nav-security-tab"
                        data-bs-toggle="tab" href="#nav-security" role="tab" aria-controls="nav-security"
                        aria-selected="false">Sécurité </a>
                    {{-- <a class="nav-link {{@$default_tab=='functions'?'active':''}}" id="nav-security-tab"
                    data-bs-toggle="tab" href="#nav-security" role="tab" aria-controls="nav-security"
                    aria-selected="false"><i class="fa fa-cogs"></i> </a> --}}
                    <a class="nav-link {{@$default_tab=='events'?'active':''}}" id="nav-events-tab" data-bs-toggle="tab"
                        href="#nav-events" role="tab" aria-controls="nav-events" aria-selected="false"> Mes
                        possibles</a>
                </div>
            </nav>


            <div class="card card-width shadow-none main">
                <div class="card-body">

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade {{@$default_tab=='account'?'show active':''}}" id="nav-account"
                            role="tabpanel" aria-labelledby="nav-account-tab">
                            @include("user.profile.includes.roleDisc")
                        </div>
                        <div class="tab-pane fade {{@$default_tab=='events'?'show active':''}}" id="nav-events"
                            role="tabpanel" aria-labelledby="nav-events-tab">
                            @include("user.profile.includes.account_fonctions")
                        </div>
                        <div class="tab-pane fade {{@$default_tab=='wallet'?'show active':''}}" id="nav-wallet"
                            role="tabpanel" aria-labelledby="nav-wallet-tab">
                            <div class="bg-white">
                                @include('user.profile.includes.my_wallet')
                            </div>
                        </div>
                        <div class="mt-4 tab-pane fade {{@$default_tab=='transactions'?'show active':''}}"
                            id="nav-transactions" role="tabpanel" aria-labelledby="nav-transactions-tab">
                            @include('user.profile.includes.my_transactions')
                        </div>
                        <div class="mt-4 tab-pane fade {{@$default_tab=='infos-perso'?'show active':''}}"
                            id="nav-infos-perso" role="tabpanel" aria-labelledby="nav-infos-perso-tab">
                            <div class="bg-white">
                                <h2 class="text-center mb-1 pt-4">Informations Personelles</h2>
                                <div class="text-center text-bold mb-4">*Requis pour postulant uniquement*</div>
                                <hr size="1" width="50%" class="mx-auto">
                                @include('user.profile.includes.infosperso_form')
                            </div>
                        </div>
                        <div class="mt-4 tab-pane fade {{@$default_tab=='security'?'show active':''}}" id="nav-security"
                            role="tabpanel" aria-labelledby="nav-security-tab">
                            <div class="bg-white">
                                <h2 class="text-center mb-1 pt-4">Modifier mon mot de passe</h2>
                                @include('user.profile.includes.change_pwd')
                            </div>
                        </div>
                    </div>


                </div>
            </div>



        </div>
    </div>
</div>

@endsection

@push('scripts')

<script defer>
    $(function() {
            //*** Select the cities of the selected region ***
            const regions = document.getElementById("region_id");
            document.getElementById("region_id").addEventListener('change', function (event) {
                const selected_region = this.value;
                $.ajax({
                    type: 'get',
                    url: `{{url('/select_cities')}}`,
                    data: {'id': selected_region},
                    success: function(res){
                        const entries = Object.entries(res);
                        const cities_field = document.getElementById("city_id");
                        cities_field.innerHTML = `<option value=""> --- </option>`;
                        for(const [key,region] of entries){
                            console.log(key);
                            cities_field.innerHTML += `<option value="${key}">${region}</option>`;
                        }
                    }
                });
            });
        });

        function leftBar(){
            let toggle = document.querySelector('.toggle');
            toggle.classList.toggle('active');

            let leftBar = document.querySelector('.left-bar');
            leftBar.classList.toggle('active');

            let main = document.querySelector('.main');
            main.classList.toggle('active');
        }
</script>

@endpush