@extends('layouts.back.admin')

@section('title','Historique des transferts de monnaies')
@section('page_title','Historique des transferts de monnaies')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title font-weight-bold">Liste des transferts</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="credits-table">
                        <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Envoyé par</th>
                            <th>Destinataire</th>
                            <th>Somme envoyé</th>
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
                { extend: 'excel', filename: 'LAgenda du Quebec - Liste des transfer logs_'+ today},
                { extend: 'pdf', filename: 'LAgenda du Quebec - Liste des transfer logs_'+ today }
        ],
                ajax: '{{ url('admin/get-credits-logs') }}',
                columns: [
                    { data: 'ref', name: 'ref' },
                    { data: null, name: 'sent_by',
                        render: data => {
                                return `<strong>${data.sent_by.username}</strong><br><span>Réserve initial: ${data.sender_initial_credit}</span><br><span>Réserve final: ${data.sender_new_credit}</span><br>`;
                            }
                    },
                    { data: null, name: 'sent_to',
                        render: data => { 
                                return `<strong>${data.sent_to.username}</strong><br><span>Réserve initial: ${data.recipient_initial_credit}</span><br><span>Réserve final: ${data.recipient_new_credit}</span><br>`;
                            }
                    },
                    { data: 'sent_value', name: 'sent_value' },
                    { data: 'updated_at', name: 'updated_at' }
                ],
                order: [[ 5, 'desc' ]],
                pageLength: 100,
            });
        });
    </script>

@endpush
