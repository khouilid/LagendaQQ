<div class="bg-white mt-4 p-4 row">

    @if(session()->get('role') !== null)
    <div class="row g-0">
        <div class="col-md-4">
            <h3 class="py-0 pt-4 text-center">{{ucfirst(session()->get('role')->name)}}</h3>
            @php
            $crs = \App\Models\Currency::where("id", session()->get('role')->currency_id)->get();
            @endphp
            <h4 class='badge badge-warning mx-auto'><i class='fa fa-coins'></i> Monnaie utilisée : {{$crs[0]["name"]}}
            </h4>
            {!! session()->get('role')->free_events ? "<span class='badge badge-success mx-auto'><i
                    class='fa fa-dot-circle'></i> Activités gratuites</span>":'' !!}
            {!! session()->get('role')->free_annoncements ? "<span class='badge badge-success mx-auto'><i
                    class='fa fa-dot-circle'></i> Annonces gratuites</span>":'' !!}
            <ul class="list-group">
                <li class="list-group-item">
                    <strong class="card-text">{{$crs[0]["name"]}} par événement :
                        {{intval(- session()->get('role')->events_price)}} </strong>
                </li>
                <li class="list-group-item">
                    <strong class="card-text">{{$crs[0]["name"]}} par annonce :
                        {{intval(- session()->get('role')->annoucements_price)}} </strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="card-title">{!! session()->get('role')->description !!}</div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
    @else
    @foreach (auth()->user()->roles as $role)

    <div class="row g-0">
        <div class="col-md-4">
            <h3 class="mb-5">{{ucfirst($role->name)}}</h3>
            @php
            $crs = \App\Models\Currency::where("id", $role->currency_id)->get();
            @endphp
            <h4 class='badge badge-warning mx-auto'><i class='fa fa-coins'></i> Monnaie utilisée : {{$crs[0]["name"]}}
            </h4>
            {!! $role->free_events ? "<span class='badge badge-success mx-auto'><i class='fa fa-dot-circle'></i>
                Activités gratuites</span>":'' !!}
            {!! $role->free_annoncements ? "<span class='badge badge-success mx-auto'><i class='fa fa-dot-circle'></i>
                Annonces gratuites</span>":'' !!}
            <ul class="list-group">
                <li class="list-group-item">
                    <strong class="card-text">{{$crs[0]["name"]}} par événement : {{intval(- $role->events_price)}}
                    </strong>
                </li>
                <li class="list-group-item">
                    <strong class="card-text">{{$crs[0]["name"]}} par annonce : {{intval(- $role->annoucements_price)}}
                    </strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="card-title">{!! $role->description !!}</div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
    @endforeach

    @endif

    {{--  --}}
</div>