<div class="row">
    <div class="col-md-12 col-sm-12">
        <div>
            <div class="card-header">
                <h2 class="card-title font-weight-bold">Mes transferts monnaie Vancl @hasanyrole('admin') (admin)
                    @endrole</h2>
            </div>
            <div class="card-body">
                <table class="table table-success table-striped table-borderless" id="my-transactions-table">
                    <thead class="table-light">
                        <tr>
                            <th>N°</th>
                            <th>ref</th>
                            <th>Actions</th>
                            <th>Transferts</th>
                            <th>Notes</th>
                            <th>Date d'envoie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                        <tr>
                            <td>{{$log->id}}</td>
                            <td>{{$log->ref}}</td>
                            <td>
                                <!-- let type_text = data.sent_by.id==={{$user->id}}?"<strong>Envoie</strong>":"<strong>Réception</strong>"; -->
                                <span><strong>{{@$log->sent_by->id === $user->id?"Envoie":"Réception"}}</strong><br>
                                    <i class="{{@$log->credit->icons}}"></i> {{@$log->credit->name}}</span>
                            </td>
                            <td>
                                @if(@$log->sent_by->id == $user->id)
                                <span class="sent_by">Vous avez</span> envoyé {{@$log->sent_value}}
                                {{@$log->credit->name}} à <span class="sent_to"> {{@$log->sent_to->username}}</span>
                                @else
                                <span class="sent_by">{{@$log->sent_by->username}}</span> vous a envoyé
                                {{@$log->sent_value}} {{@$log->credit->name}}
                                @endif
                            </td>
                            <td>
                                <div class='log-notes'>{!!@$log->notes!!}</div>
                            </td>
                            <td>{{@$log->updated_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script defer>
    var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = dd + '_' + mm + '_' + yyyy +'_' + today.getHours() +'_'+ today.getMinutes() ;


        $(function() {

        let table = $('#my-transactions-table').DataTable({
                processing: false,
                serverSide: false,
                dom: 'Bfrliptip',
                     buttons: [
                { extend: 'excel', filename: 'LAgenda du Quebec - Liste Mes transferts_'+ today},
                { extend: 'pdf', filename: 'LAgenda du Quebec - Liste Mes transferts_'+ today }
        ],
                method:'post',
                dom: 'Bfrliptip',
                /* ajax: '{{ route("user.userSentTransactions") }}', *
                columns: [
                    {data: 'ref',name: 'ref'},
                    { data: null, name: 'action',
                        render: data => {
                            let type_text = data.sent_by.id==={{$user->id}}?"<strong>Envoie</strong>":"<strong>Réception</strong>";
                            return `<span>${type_text} <br><i class="${data.credit.icons}"></i> ${data.credit?.name}</span>`;
                        }
                    },
                    { data: null, name: 'sent_to',
                        render: data => {
                            if(data.sent_by.id == "{{$user->id}}")
                                return `<span class="sent_by">Vous avez</span> envoyé ${data.sent_value} ${data.credit.name} à <span class="sent_to"> ${data.sent_to?data.sent_to.username:"Utilisateur supprimé"}</span>`;
                            else
                                return `<span class="sent_by">${data.sent_by?data.sent_by.username:"Utilisateur supprimé"}</span> vous a envoyé ${data.sent_value} ${data.credit.name}`;
                            }
                    },
                    { data: null, name: 'notes',
                        render: data => {
                                const notesHTML = data.notes?data.notes:'';
                                const notes = $("<div>").html(data.notes).text();
                                return `<div class='log-notes'>${notes}</div>`;
                        }
                    },
                    { data: 'updated_at', name: 'updated_at' }
                ],*/
     
                order: [[ 3, 'desc' ]],
                pageLength: 30,
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
                      "sEmptyTable":     "Vous n'avez pas encore de transaction.",
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