@extends('layouts.back.admin')

@section('title','Historique des transferts de la monnaie '.@$currency->name)
@section('page_title','Historique des transferts de la monnaie '.@$currency->name)

@inject('credit', 'App\Models\Credit')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="{{$currency->icons}}"></i></span>
                <div class="info-box-content">
                    <h3>{{$currency->name}}</h3>
                    <div class="tiny-text mb-3"> {!!$currency->description!!}</div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title font-weight-bold">-</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="credits-table">
                        <thead class="table-light">
                        <tr>
                            <th>Envoyé par</th>
                            <th>Destinataire</th>
                            <th>Somme envoyé</th>
                            <th>Notes</th>
                            <th>Dernière modification</th>
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
            $('#credits-table').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrliptip',
                       buttons: [
                { extend: 'excel', filename: 'LAgenda du Quebec - Liste des currencies_'+ today},
                { extend: 'pdf', filename: 'LAgenda du Quebec - Liste des currencies_'+ today }
        ],
                ajax: '{{ url("admin/get-currency-logs/".$currency->id) }}',
                columns: [
                    { data: null, name: 'sent_by',
                        render: data => {
                                return `<strong>${data.sent_by?data.sent_by.name:"Utilisateur supprimé"}</strong><br><span>Réserve initial: ${data.sender_initial_credit}</span><br><span>Réserve final: ${data.sender_new_credit}</span><br>`;
                            }
                    },
                    { data: null, name: 'sent_to',
                        render: data => { 
                                return `<strong>${data.sent_to?data.sent_to.name:"Utilisateur supprimé"}</strong><br><span>Réserve initial: ${data.recipient_initial_credit}</span><br><span>Réserve final: ${data.recipient_new_credit}</span><br>`;
                            }
                    },
                    { data: 'sent_value', name: 'sent_value' },
                    { data: null, name: 'notes',
                        render: data => {
                                const notesHTML = data.notes?data.notes:'';
                                const notes = $("<div>").html(notesHTML).text();
                                return `<div class='log-notes'>${notes}</div>`;
                        }
                    },
                    { data: 'updated_at', name: 'updated_at' }
                ],
                order: [[ 4, 'desc' ]],
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
        });
    </script>

@endpush
