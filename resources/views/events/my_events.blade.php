@extends('layouts.front.app')

@section('content')
    <div class="row">
        <div class="my-4 col-12 row">
            <!-- <h2 class="my-0"> - </h2> -->
        </div>
        <div class="col-12 tab-content" id="nav-tabContent">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title font-weight-bold">Mes événements</h2>
                    <div class="card-tools">
                        <a href="{{route('user.create_event')}}" class="btn btn-primary btn-sm">
                            <i class="mr-2 fa fa-plus"></i> Ajouter un événement
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-success table-striped table-borderless" id="events-table">
                        <thead class="table-light">
                            <tr>
                                <th>Titre</th>
                                <th>Categorie</th>
                                <th>Dates</th>
                                <th>Heure</th>
                                <th>Proprietaire</th>
                                <th>Region et Ville</th>
                                <th>Etat Publication</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script defer>
    var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = dd + '_' + mm + '_' + yyyy +'_' + today.getHours() +'_'+ today.getMinutes() ;
        $(function() {
           $('#events-table').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrliptip',
                buttons: [
                    { extend: 'excel', filename: 'LAgenda du Quebec - Liste mes événements_'+ today},
                    { extend: 'pdf', filename: 'LAgenda du Quebec - Liste mes événements_'+ today }
                ],
                method:'post',
                dom: 'Bfrliptip',
                ajax: '{{ route("user.myEvents-data") }}',
                columns: [
                    { data: null, name: 'title',
                        render : data => {
                            const title = (data.title.length > 35) ? `${data.title.substring(0,35)}...` :data.title;
                            return `<img src="/voir/images/${data.images}" alt="{{@$event->title}}" style="width:50px; height: auto"><br><strong><a href="/mes_evenements/event/${data.slug}">${title}</a></strong>`;
                        }
                    },
                    { data: null, name: 'category_id',
                        render : data => {
                            return `${data.category?data.category.name:""}`;
                        }
                    },
                    { data: null, name: 'dates',
                        render : data => {
                            let formated_dates = '';
                            const dates = data.dates?data.dates.split(','):[data.dates];
                            for(let i = 0; i < dates.length; i++){
                                formated_dates += `<span class="badge badge-primary text-sm d-block my-1"> ${dates[i]} </span> ` ;
                            }
                            return formated_dates;
                        }
                    },
                    { data:"event_time",name: "event_time" },
                    { data: null, name: 'owner',
                        render : data => {
                            let retour = `${data.owned?data.owned.username:""}`;
                            if(data.owned.id !== data.posted.id)
                                retour += `<br><strong> Postée par : ${data.posted.username}</strong>`;

                            return `${retour}`
                        }
                    },
                    { data: null, name: 'region_id',
                        render: data => {
                            return `<strong>Region : </strong>${data.region?data.region.name:""}<br><strong>Ville : </strong>${data.city?data.city.name:""}`;
                        }
                    },
                    { data: null, name: 'updated_at',
                        render: data => {
                            let annonce_status = '';
                            switch (parseInt(data.publication_status)) {
                                case 0:
                                    annonce_status = `<span class="text-md badge badge-warning">Bouillon</div>`  ;
                                    break;
                                case 1:
                                    annonce_status = `<span class="text-md badge badge-success">Publiée</div>`  ;
                                    break;
                                case 2:
                                    annonce_status = `<span class="text-md badge badge-primary">Privée</div>`  ;
                                    break;
                                case 4:
                                    annonce_status = `<span class="text-md badge badge-danger">Suprimée</div>`  ;
                                    break;
                            
                                default:
                                    break;
                            }
                            return `${annonce_status}`
                            // return `${data.updated_at} <br> ${annonce_status}`
                        }
                    }
                ],
                order: [[ 6, 'desc' ]],
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
                      "sEmptyTable":     "Vous n'avez aucun événement.",
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