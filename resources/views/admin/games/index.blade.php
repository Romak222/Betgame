@extends('layouts.admin')

@section('title', 'Games')

@section('content')

<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">Games</h1>
            </div>

            <div class="col-sm-6 text-end">

                <a href="{{ route('admin.games.create') }}"
                   class="btn btn-primary">

                    <i class="fas fa-plus"></i>

                    Add Game

                </a>

            </div>

        </div>

    </div>
</div>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Game List

        </h3>

    </div>

    <div class="card-body">

        <table id="gameTable"
               class="table table-bordered table-striped w-100">

            <thead>

            <tr>

                <th width="60">#</th>

                <th>Game Type</th>

                <th>Name</th>

                <th>Code</th>

                <th>Open</th>

                <th>Close</th>

                <th>Result</th>

                <th>Status</th>

                <th width="180">Action</th>

            </tr>

            </thead>

        </table>

    </div>

</div>

@endsection

@push('scripts')

<script>

$(document).ready(function(){

    let table = $('#gameTable').DataTable({

        processing:true,

        serverSide:true,

        responsive:true,

        ajax:"{{ route('admin.games.datatable') }}",

        columns:[

            {
                data:'DT_RowIndex',
                orderable:false,
                searchable:false
            },

            {
                data:'game_type',
                name:'gameType.name'
            },

            {
                data:'name',
                name:'name'
            },

            {
                data:'code',
                name:'code'
            },

            {
                data:'open_time',
                name:'open_time'
            },

            {
                data:'close_time',
                name:'close_time'
            },

            {
                data:'result_time',
                name:'result_time'
            },

            {
                data:'status_badge',
                orderable:false,
                searchable:false
            },

            {
                data:'action',
                orderable:false,
                searchable:false
            }

        ]

    });

});
$(document).on('click', '.btn-delete', function () {

    let id = $(this).data('id');

    Swal.fire({

        title: 'Delete Game?',

        text: 'This action cannot be undone.',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#d33',

        cancelButtonColor: '#3085d6',

        confirmButtonText: 'Delete'

    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({

                url: "{{ url('admin/games') }}/" + id,

                type: "DELETE",

                data: {

                    _token: $('meta[name="csrf-token"]').attr('content')

                },

                success: function (response) {

                    Swal.fire(
                        'Deleted!',
                        response.message,
                        'success'
                    );

                    table.ajax.reload(null, false);

                },

                error: function (xhr) {

                    Swal.fire(
                        'Error',
                        xhr.responseJSON?.message ?? 'Something went wrong.',
                        'error'
                    );

                }

            });

        }

    });

});
</script>

@endpush