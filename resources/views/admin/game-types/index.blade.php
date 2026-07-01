@extends('layouts.admin')

@section('title', 'Game Types')

@section('content')

<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">Game Types</h1>
            </div>

            <div class="col-sm-6 text-end">

                <a href="{{ route('admin.game-types.create') }}" class="btn btn-primary">

                    <i class="fas fa-plus"></i>

                    Add Game Type

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

            Game Type List

        </h3>

    </div>

    <div class="card-body">

        <table id="gameTypeTable" class="table table-bordered table-striped w-100">

            <thead>

                <tr>

                    <th width="60">#</th>

                    <th>Name</th>

                    <th>Code</th>

                    <th>Description</th>

                    <th width="100">Sort</th>

                    <th width="120">Status</th>

                    <th width="180">Action</th>

                </tr>

            </thead>

        </table>
     

    </div>

</div>

@endsection

@push('scripts')

<script>
    
$(document).ready(function () {

    let table = $('#gameTypeTable').DataTable({
        processing: true, serverSide: true, responsive: true, ajax: "{{ route('admin.game-types.datatable') }}", columns: [ { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, { data: 'name', name: 'name' }, { data: 'code', name: 'code' }, { data: 'description', name: 'description', defaultContent: '-' }, { data: 'sort_order', name: 'sort_order' }, { data: 'status_badge', name: 'status_badge', orderable: false, searchable: false }, { data: 'action', name: 'action', orderable: false, searchable: false } ], order: [ [4, 'asc'] ]
    });

    $(document).on('click', '.btn-delete', function () {

        let id = $(this).data('id');

        Swal.fire({
            title: 'Delete Game Type?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({

                    url: "{{ url('admin/game-types') }}/" + id,

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

});
</script>

@endpush