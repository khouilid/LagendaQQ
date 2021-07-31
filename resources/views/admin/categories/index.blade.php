@extends('layouts.back.admin')

@section('title','Catégories ')
@section('page_title','Catégories ')

@section('content')

    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="card">
                <div class="card-header bg-primary">
                    @if(Route::currentRouteName() == 'admin.settings.categories.index')
                    <h2 class="card-title font-weight-bold">Ajouter une catégorie</h2>
                    @endif
                    @if(Route::currentRouteName() == 'admin.settings.categories.edit')
                    <h2 class="card-title font-weight-bold">Modifier la catégorie</h2>
                    @endif
                </div>
                <div class="card-body">
                    {!! form($form) !!}
                </div>
                @if(Route::currentRouteName() == 'admin.settings.categories.edit')
                    <div class="card-footer">
                        <a class="btn btn-link float-right text-dark font-weight-bold" href="{{ route('admin.settings.categories.index') }}">
                            <i class="mr-2 fa fa-plus"></i>
                            Créer une nouvelle catégorie
                        </a>
                    </div>
                @endif
            </div>
        </div>


        <p>La <span style="color:hsl(0,75%,60%);"><strong>secrétaire publiciste</strong></span> avec son équipe vont envoyer une invitation pour chacune des activités de sa région C.T de toutes les activités des prochains dix jours.</p>
 
        <div class="col-sm-6 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title font-weight-bold">Catégories d'événements</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="event-categories-table">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Parent</th>
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
            $('#event-categories-table').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrliptip',
                 buttons: [
                    { extend: 'excel', filename: 'LAgenda du Quebec - Catégories_'+ today},
                    { extend: 'pdf', filename: 'LAgenda du Quebec - Catégories_'+ today }
                ],
                ajax: '{{ url('admin/settings/get-categories-data') }}',
                columns: [
                    { data: null, name: 'name',
                        render: data => {return `<strong>${data.name}</strong>`}
                    },
                    { data: null, name: 'type',
                        render: data => {return `${data.type}`}
                    },
                    { data: null, name: 'parent',
                        render: data => {return `${data.parent?data.parent.name:''}`}
                    },
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

            /* $('#announcement-categories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('admin/settings/get-announcement-categories-data') }}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'parent', name: 'parent' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            }); */

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
