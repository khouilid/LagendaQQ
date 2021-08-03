 <div class="row">
    <div style="width: 410% !important" class="bg-white  justify-content-evenly row py-4">
        <div class="accordion" id="accordionFlushExample">
        @foreach($fonctions as $fonction)
            
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading{{$fonction->id}}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$fonction->id}}" aria-expanded="false" aria-controls="flush-collapse{{$fonction->id}}">
                    @hasanyrole($fonction->name)
                        <i class="nav-icon fa fa-user-check text-success"></i>
                        @else
                        <i class="nav-icon fa fa-user-plus"></i>
                    @endrole
                        &nbsp; {{ucfirst($fonction->name)}} </button>
                </h2>
            


        
                <div id="flush-collapse{{$fonction->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$fonction->id}}" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body ">
                        {!! $fonction->description !!}
                        <div class="align-items-center d-flex">

                           <p> Nombre des posts disponible : </p>
                           @if($fonction->posts - $fonction->users_count > 0)
                             <p class="btn btn-danger rounded-lg">{!! $fonction->posts - $fonction->users_count !!}</p>
                          
                            @else
                            <p class="btn btn-danger rounded-lg">Aucun posts desponible</p>
                          
                            @endif
                        </div>
                        @hasanyrole($fonction->name)
                            <div class="col-12 row aq-card-action">
                                <a href="#" class="btn btn-success btn-sm">Vouse êtes déjà {{strtolower($fonction->name)}}</a>
                            </div>
                        @else
                            <hr size="60%" class="mx-auto">
                            <div class="aq-card-action" id="{{$fonction->id}}">
                                @if($fonction->posts - $fonction->users_count > 0)
                                {{-- <p class="btn btn-danger rounded-lg">{!! $fonction->posts - $fonction->users_count !!}</p> --}}
                                <a href="#" class="btn btn-primary btn-sm subscribe_role" data-role_id="{{$fonction->id}}" data-role_description="{!! $fonction->description !!}" data-role_name="{{$fonction->name}}"><i class="fa fa-plus"></i> S'inscrire à cette fonction</a>
                             
                               @else
                               {{-- <p class="btn btn-danger rounded-lg">Aucun posts desponible</p> --}}
                             
                               @endif
                            </div>
                        @endrole
                    </div>
                </div>
            </div>
        @endforeach  
        </div>
    </div>
</div>
<!-- Full screen modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{route('user.assign_role')}}" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title text-center" id="exampleModalLabel">Vous allez vous inscrire à la fonction <span id="role_name"></span></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <input type="hidden" name="role_id" id="form_role_id">
                    <input type="hidden" name="user_id" id="form_user_id">
                    <input type="hidden" name="form_payment_title" id="form_payment_title">
                <div class="mb-3" id="confirm_role_description"></div>
                <div class="mb-3 row" id="price">
                    <input type="hidden" name="price" value="5" id="price">
                    <div type="button" class="btn btn-primary">
                       <h3>Prix de l'inscription : <span class="badge bg-warning">$5.00</span></h3>
                    </div>
                </div>
                <hr size="70%" class="mx-auto">
                <div class="mb-3 text-primary"> Confirmer votre inscription à la fonction <span id="confirm_role_name"></span></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Confimer</button>
            </div>
        </form>
    </div>
  </div>
</div>
<script defer>
$(function(){
    const btn = $("#toggle__modal");
    $('.subscribe_role').on('click',function(ev){
        ev.preventDefault();
        const role_id   = $(this).data('role_id');
        const role_name = $(this).data('role_name');
        const role_desc = $(this).data('role_description');

        $("#role_name").text(role_name);
        //$("#confirm_role_description").text(role_desc);
        
        $("#form_role_id").val(role_id);
        $("#form_user_id").val({{$user->id}});
        $("#form_payment_title").val(`Inscription à la fonction ${role_name}`);
        const myModal = new bootstrap.Modal(document.getElementById('myModal'));

        myModal.show();
    });
});
</script>