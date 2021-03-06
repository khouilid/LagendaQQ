@extends('layouts.back.user')

@section('title','Mes événements')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title font-weight-bold">Mes événements</h2>
                    <div class="card-tools">
                        <a href="{{ route('user.events.create') }}" class="btn btn-primary btn-sm">
                            <i class="mr-2 fa fa-plus-circle"></i>
                            Ajouter un évènement
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="events-table">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Dates</th>
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
            $('#events-table').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrliptip',
 buttons: [
                { extend: 'excel', filename: 'LAgenda du Quebec - Liste mes événements_'+ today},
                { extend: 'pdf', filename: 'LAgenda du Quebec - Liste mes événements_'+ today }
        ],
                ajax: '{{ url('get-events-data') }}',
                columns: [
                    { data: 'image', name: 'image' },
                    { data: 'title', name: 'title' },
                    { data: 'category', name: 'category' },
                    { data: 'dates', name: 'dates' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
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
