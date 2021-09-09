<div class="bg-white mt-4 p-4 row">

    @if(session()->get('role') !== null)
    <div class="">
        <div class="d-flex flex-column">
            {{-- <h3 class="py-0 pt-4 text-center">{{ucfirst(session()->get('role')->name)}}</h3> --}}
            @php
            $crs = \App\Models\Currency::where("id", session()->get('role')->currency_id)->get();
            @endphp
            <h4 class='mon-compt-monai'><i class='fa fa-coins'></i> Monnaie utilisée : {{$crs[0]["name"]}}
            </h4>
            {!! session()->get('role')->free_events ? "<span class='badge badge-success mx-auto'><i
                    class='fa fa-dot-circle'></i> Activités gratuites</span>":'' !!}
            {!! session()->get('role')->free_annoncements ? "<span class='badge badge-success mx-auto'><i
                    class='fa fa-dot-circle'></i> Annonces gratuites</span>":'' !!}
            <ul class="list-group">
                <li class="list-group-item custom-monai-style d-flex mb-1">
                    <span class="card-text mr-auto">{{$crs[0]["name"]}} par événement : </span>
                    <span>{{intval(- session()->get('role')->events_price)}} </span>
                </li>
                <li class="list-group-item custom-monai-style d-flex">
                    <span class="card-text mr-auto">{{$crs[0]["name"]}} par annonce :</span>
                    <span>{{intval(- session()->get('role')->annoucements_price)}} </span>
                </li>
            </ul>
        </div>
        <div class="col-md-8 mt-4">
            <div class="card-body">
                <div class="card-title">{!! session()->get('role')->description !!}</div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
    @else
    @foreach (auth()->user()->roles as $role)

    <div class="row g-0">
        <div class="col d-flex flex-column">

            <div>
                {{-- <h3 class="mb-5">{{ucfirst($role->name)}}</h3> --}}
                @php
                $crs = \App\Models\Currency::where("id", $role->currency_id)->get();
                @endphp
                <h4 class='mon-compt-monai'>Monnaie utilisée :
                    {{$crs[0]["name"]}}
                </h4>
                {!! $role->free_events ? "<span class='badge badge-success mx-auto'><i class='fa fa-dot-circle'></i>
                    Activités gratuites</span>":'' !!}
                {!! $role->free_annoncements ? "<span class='badge badge-success mx-auto'><i
                        class='fa fa-dot-circle'></i>
                    Annonces gratuites</span>":'' !!}
                <ul class="">
                    <li class="d-flex custom-monai-style mb-2">
                        <span class="mr-auto">{{$crs[0]["name"]}} par événement :</span>
                        <span>{{intval(- $role->events_price)}}</span>

                    </li>
                    <li class="d-flex custom-monai-style">
                        <span class="mr-auto">{{$crs[0]["name"]}} par annonce :</span>
                        <span>{{intval(- $role->annoucements_price)}}</span>

                    </li>
                </ul>
            </div>
            <div>
                <div class="card-body">
                    <div class="card-title">{!! $role->description !!}</div>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
    @endforeach

    @endif

    {{--  --}}
</div>