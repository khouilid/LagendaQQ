@extends('layouts.back.admin')

@section('title',"Ajout d'une fonction")
@section('page_title',"Ajout d'une fonction")

@section('content')
    <form method="POST" action="{{route('admin.settings.security.roles.index')}}" accept-charset="UTF-8">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="row">
          <div class="col-sm-12 col-md-8">
              <div class="card">
                  <div class="card-header bg-primary">
                      <h2 class="card-title font-weight-bold">Informations de base</h2>
                      <div class="card-tools">
                        <a href="{{route('admin.settings.security.roles.index')}}" class="btn btn-success"><i class="fa fa-angle-double-left"></i> Retourner vers la liste</a>
                      </div>
                  </div>
                  <div class="card-body row">
                      <div class="col-12 form-group row">
                      <label for="name *" class="col-sm-12 col-md-3">Nom de la fonction *</label>
                      <input class="col-sm-12 col-md-9" name="name" type="text" value="{{old('name')}}">
                        {!! $errors->first('name', '<div class="error-message col-12">:message</div>') !!}
                      </div>
                      <div class="col-12 form-group row justify-content-center bg-light">
                        <label for="free_events" class="col-sm-6 col-md-6">Événements Gratuits</label>
                        <label class="label col-sm-6 col-md-6">
                          <input class="label__checkbox" id="free_events" name="free_events" type="checkbox" value="{{old('free_events')}}">
                          <span class="label__text">
                            <span class="label__check">
                              <i class="fa fa-check icon"></i>
                            </span>
                          </span>
                        </label>
                      </div>
                      <div class="col-12 form-group row justify-content-center bg-light">
                        <label for="free_annoncements" class="col-sm-6 col-md-6">Annonces Gratuites</label>
                        <label class="label col-sm-6 col-md-6">
                          <input class="label__checkbox" id="free_annoncements" name="free_annoncements" type="checkbox" value="{{old('free_annoncements')}}">
                          <span class="label__text">
                            <span class="label__check">
                              <i class="fa fa-check icon"></i>
                            </span>
                          </span>
                        </label>
                      </div>
                      <div class="col-6 form-group row">
                        <label for="Prix par événement" class="col-sm-12 col-md-6">Prix Par événement</label>
                        <div class="input-group mb-3 col-sm-12 col-md-6">
                        <input class="form-control" name="events_price" type="number" value="{{old('events_price') ?: 500}}">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon1"><i class="fa fa-coins"></i> </span>
                            </div>
                        </div>
                        {!! $errors->first('events_price', '<div class="error-message col-12">:message</div>') !!}
                      </div>
                      <div class="col-6 form-group row">
                        <label for="Date " class="col-sm-12 col-md-6 text-right">Date </label>
                        <div class="input-group mb-3 col-sm-12 col-md-6">
                          <input class="form-control" min="1" name="date_credit" type="number" value="{{old('date_credit') ?: 1}}">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-coins"></i> </span>
                          </div>
                        </div>
                        {!! $errors->first('date_credit', '<div class="error-message col-12">:message</div>') !!}
                      </div>
                      

                      <div class="col-12 form-group row">
                        <label for="Prix par annonce" class="col-sm-12 col-md-3">Prix Par Annonce</label>
                        <div class="input-group mb-3 col-sm-12 col-md-9">
                          <input class="form-control" name="annoucements_price" type="number" value="{{old('annoucements_price') ?: 100}}">
                          <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon3"><i class="fa fa-coins"></i> </span>
                          </div>
                        </div>
                        {!! $errors->first('annoucements_price', '<div class="error-message col-12">:message</div>') !!}
                      </div>
                      <div class="col-md-3 row col-sm-12">
                        <label for="paid_credit" class="col-md-12"> Nombre des posts disponible </label>
                           <div class="input-group mb-3 col-md-12 col-sm-6">
                              <input class="form-control" min="0" name="posts" type="number" value="{{old('posts')}}">
                          </div>
                        {!! $errors->first('paid_credit', '<div class="error-message col-12">:message</div>') !!}
                      </div>
                      <div class="col-12 row bg-gradient-light">
                        <div class="col-md-6 col-sm-12">
                            <label for="free_credit" class="col-md-12">Monnaie de la fonction</label>
                            <div class="input-group mb-3 col-md-12 col-sm-6">
                              <select name="currency_id" id="currency_id" class="form-control">
                                <option value="">Sélectionnez la monnaie pour cette fonction.</option>
                                @foreach($currencies as $key => $currency)
                                  <option value="{{$key}}">{{$currency}}</option>
                                @endforeach
                              </select>
                            </div>
                            {!! $errors->first('free_credit', '<div class="error-message col-12">:message</div>') !!}
                        </div>
                      
                        <div class="col-md-3 col-sm-12">
                          <label for="paid_credit" class="col-md-12"> Montant gratuit </label>
                          <div class="input-group mb-3 col-md-12 col-sm-6">
                              <input class="form-control" min="0" name="free_credit" type="number" value="{{old('free_credit')}}">
                          </div>
                          {!! $errors->first('paid_credit', '<div class="error-message col-12">:message</div>') !!}
                      </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="paid_credit" class="col-md-12"> Montant payant </label>
                            <div class="input-group mb-3 col-md-12 col-sm-6">
                                <input class="form-control" min="0" name="paid_credit" type="number" value="{{old('paid_credit')}}">
                            </div>
                            {!! $errors->first('paid_credit', '<div class="error-message col-12">:message</div>') !!}
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-sm-12 col-md-4"> <!-- column to add prices -->
            <div class="card" id="description-card">
                <div class="card-header bg-primary">
                    <h2 class="card-title font-weight-bold">Description</h2>
                </div>
                <div class="card-body">
                    <div class="">
                        <textarea class="form-control ckeditor" name="description" id="description" cols="30" rows="5" placeholder="ajouter une description de la fonction">{{old('description')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="card">
                  <div class="card-header bg-primary">
                      <h2 class="card-title font-weight-bold">Liste des prix</h2>
                  </div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <label for="Prix $" class="col-sm-12">Prix $</label>
                        </div>
                        <div class="col-xm-6">
                          <label for="Credits" class="col-sm-12">Montant</label>
                        </div>
                        <div id="credit_price_wrapper"></div>
                        <input type="hidden" name="nbr_price_fields" id="nbr_price_fields" value="0" />
                        <div class="col-12 my-5 justify-content-center row">
                          <button type="button" name="add_credit_price" id="add_credit_price" class="btn btn-primary">Ajouter un prix</button>
                        </div>
                      </div>
                  </div>
            </div>
          </div>
          <div class="col-sm-12">
              <div class="card">
                  <div class="card-header bg-primary">
                      <h2 class="card-title font-weight-bold">Permissions</h2>
                  </div>
                  <div class="card-body row">
                    @foreach($permission_array as $key => $groupe)
                      <div class="col-4 form-group border row px-4">
                        <h4 class="col-12">{{$groupe}}</h4>
                        @foreach($permissions as $permission)
                          @if($permission->permission_group == strtolower($key))
                            <div class="col-12 row">
                              <label class="label">
                                <input class="col-sm-2 label__checkbox" id="{{'permission_'.$permission->id}}" name="{{'permission_'.$permission->id}}" type="checkbox" value="{{$permission->id}}">
                                <span class="label__text">
                                  <span class="label__check">
                                    <i class="fa fa-check icon"></i>
                                  </span>
                                </span>
                              </label>
                              <label for="permission_{{$permission->id}}" style="font-weight: normal;" class="">{{$permission->name}}</label>
                            </div>
                          @endif
                        @endforeach
                      </div>
                    @endforeach
                  </div>
              </div>
          </div>
          <div class="col justify-content-end row justify-content-end m-2">
            <button type="submit" name="save" class="btn btn-sm btn-block btn-primary">
              <i class="fa fa-save"></i> Enregistrer
            </button>
          </div>
      </div>
    </form>
@stop
@push('scripts')

    <script>
        $(function() {
           $("#add_credit_price").on("click", function(e){
             e.preventDefault();
             
             $nbr = parseInt($("#nbr_price_fields").val());//We get the that help us know how many price is set
             ++$nbr;
             $("#nbr_price_fields").val($nbr);//we set the new value for the field

             $fields = `<div class="justify-content-between row my-2" id="price_wrapper-${$nbr}">
             <input class="form-control col-sm-5" name="price-${$nbr}" id="price-${$nbr}" type="number" value="">
             <input class="form-control col-sm-5" name="credit_amount-${$nbr}" id="credit_amount-${$nbr}" type="number" value=""><button class="btn btn-danger delete-price" data-target="price_wrapper-${$nbr}" id="delete-price-${$nbr}"><i class="fa fa-trash"></i></button> </div>`;
            $("#credit_price_wrapper").append($fields);

           });
        });
    </script>

@endpush
