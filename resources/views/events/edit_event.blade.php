@extends('layouts.front.app')
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="{{asset('dist/timepicker/clocklet.css')}}">
@section('content')
    <div class="row">
        <div class="offset-sm-2 col-10 text-blue mb-4"><h2><i class="fa fa-plus"></i> Modification de l'évènement {{$event->title}}</h2></div>
        @if(!$can_post and intval($event->purchased) === 0)
            <div class="badge text-danger badge-light mb-4 py-2" style="line-height: 2.4;">
                Vous n'avez pas assez de <strong>{{strtolower(@$role_currency->name)}}</strong> dans votre portefeuille pour publier votre évènement.<br>Vous pouvez tout de même l'enregistrer en brouillon. Vous pouvez aussi <a href="{{route('purchase_currency')}}" class="btn btn-sm btn-success"> recharger votre portefeuille.</a>
            </div>
        @endif
        <div class="col-8 tab-content mx-auto" id="nav-tabContent">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title font-weight-bold">- </h2>
                    <div class="card-tools">
                        <a href="{{route('user.my_events')}}" class="btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> Retour vers la liste</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('user.update_event', $event)}}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            @csrf
                            @method("PUT")
                            @if($user->hasAnyRole(['chef-vendeur','vendeur']))
                            <div class="offset-sm-0 col-12 form-group row">
                                <label for="owner" class="col-sm-12 col-md-12">Publiée l'évènement pour : {{@$announcement->owner}} </label>
                                <select name="owner" id="owner" class="form-control">
                                    <option value=""> --- </option>
                                    @forelse($children as $child)
                                    <option value="{{$child->id}}" {{intval(old("owner",@$event->owner)) === $child->id?'selected':'' }}> {{$child->username}} </option>
                                    @empty
                                    <option value="{{$user->id}}">Vous n'avez enregistré aucun équipier.</option>
                                    @endforelse
                                </select>
                            </div>
                            @endif
                            <input type="hidden" name="posted_by" value="{{$user->id}}">
                            @if(isset($announcement) && !empty($announcement))
                                <input type="hidden" name="announcement_id" value="{{@$announcement->id}}">
                                <h3>Enregistrement de l'événement<br>{{@$announcement->title}}</h3>
                            @endif
                            @include("events.includes.event_form")

                            <div class="col-sm-5 form-group row mt-5 mr-2">
                                <a href="{{route('user.show_event',$event->slug)}}" class="btn btn-light"><i class="fa fa-reply"></i> Annuler</a>
                            </div>
                            <div class="col-sm-7 form-group row mt-5">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregistrer</button>
                            </div>
                            @if(isset($announcement) && !empty($announcement))
                                <div class="col-sm-12 form-group row mt-5">
                                    <hr>
                                    <a href="{{route('user.edit_announcement',@$announcement->slug)}}" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Éditer l'événement à relier à cette activité</a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" defer></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" defer></script>
    <script src="{{asset('dist/multiple_dates_picker/jquery-ui.multidatespicker.js')}}" defer></script>
    <script src="{{asset('dist/timepicker/clocklet.js')}}" defer></script>
    <script>
        $(document).ready(function(){  
            $('#datePick').multiDatesPicker({
                dateFormat: "d/m/yy",
                minDate: 0, // today
            });

            //processing upload of image
            $(document).on("click", ".browse", function () {
                let file = $(this)
                    .parent()
                    .parent()
                    .parent()
                    .find("#images");
                file.trigger("click");
            });
            $('input[type="file"]').on('change', function (e) {
                let fileName = e.target.files[0].name;
                $("#file").val(fileName);

                let reader = new FileReader();
                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("preview").src = e.target.result;
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            });

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
    </script>
@endpush