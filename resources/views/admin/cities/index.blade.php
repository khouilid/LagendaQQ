@extends('layouts.back.admin')

@section('title','Villes ')
@section('page_title','Villes ')

@section('content')

    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header bg-primary">
                    @if(Route::currentRouteName() == 'admin.settings.cities.index')
                    <h2 class="card-title font-weight-bold">Ajouter une ville</h2>
                    @endif
                    @if(Route::currentRouteName() == 'admin.settings.cities.edit')
                    <h2 class="card-title font-weight-bold">Modifier la ville</h2>
                    @endif
                </div>
                <div class="card-body">
                    {!! form($form) !!}
                </div>
                @if(Route::currentRouteName() == 'admin.settings.cities.edit')
                    <div class="card-footer">
                        <a class="btn btn-link float-right text-dark font-weight-bold" href="{{ route('admin.settings.cities.index') }}">
                            <i class="mr-2 fa fa-plus"></i>
                            Créer une nouvelle ville
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title font-weight-bold">Liste des villes</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label><strong>Regions :</strong></label>
                        <select id='filter_region_id' class="form-control" style="width: 200px">
                            <option value="">--Filtrer par region--</option>
                            @foreach($regions as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <table class="table table-bordered" id="roles-table">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Region</th>
                            <th>Dernière modification</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.back.alerts.delete-confirmation')

@stop

@push('scripts')

    <script>
         var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = dd + '_' + mm + '_' + yyyy +'_' + today.getHours() +'_'+ today.getMinutes() ;

        $(function() {
            let table = $('#roles-table').DataTable({
                            processing: true,
                            serverSide: true,
                            dom: 'Bfrliptip',
                             buttons: [
                                { extend: 'excel', filename: 'LAgenda du Quebec - Villes_'+ today},
                                { extend: 'pdf', filename: 'LAgenda du Quebec - Villes_'+ today }
                            ],
                            ajax: {
                                url: '{{ url('admin/settings/cities') }}',
                                data: function (d) {
                                    d.region_id = $('#filter_region_id').val(),
                                    d.search = $('input[type="search"]').val()
                                }
                            },
                            columns: [
                                { data: 'full_name', name: 'full_name' },
                                { data: 'region', name: 'region' },
                                { data: 'updated_at', name: 'updated_at' },
                                { data: 'action', name: 'action', orderable: false, searchable: false }
                            ],
                            order: [[ 0, 'asc' ]],
                            pageLength: 100,
                            responsive: true,
                            "oLanguage":{
                                  "sProcessing":     "<i class='fa fa-2x fa-spinner fa-pulse'>",
                                  "sSearch":         "Rechercher&nbsp;:",
                                  "sLengthMenu":     "Afficher   <select name=\"event-users-table_length\" aria-controls=\"event-users-table\" class=\"\"><option value=\"10\">10</option><option value=\"25\">25</option><option value=\"50\">50</option><option id='limit' value=\"100\">All</option></select> &eacute;l&eacute;ments",
                                  "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                                  "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                                  "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                                  "sInfoPostFix":    "",
                                  "sLoadingRecords": "Chargement en cours...",
                                  "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                                  "sEmptyTable":     "Aucune valeur disponible dans le tableau",
                                  "oPaginate": {
                                    "sFirst":      "<| ",
                                    "sPrevious":   "Prec",
                                    "sNext":       " Suiv",
                                    "sLast":       " |>"
                                  },
                                  "oAria": {
                                    "sSortAscending":  ": activez pour trier la colonne par ordre croissant",
                                    "sSortDescending": ": activez pour trier la colonne par ordre décroissant"
                                  }
                                }
                        });
                        
                        
                         table.on('draw', function (data) {
                 $('#limit').val(table.page.info().recordsDisplay);
     });
            $('#filter_region_id').change(function(){
                table.draw();
            });
            

            $('#modal-delete').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var link = button.data('whatever') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.yes-delete-btn').attr({'href' : link})
            })
        });
    </script>

@endpush
