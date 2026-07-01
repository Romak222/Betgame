@extends('layouts.admin')

@section('title', 'Retailer Management')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0">
                    Retailer Management
                </h1>

            </div>

            <div class="col-sm-6 text-end">

                <a href="{{ route('admin.retailers.create') }}"
                   class="btn btn-primary">

                    <i class="fas fa-plus"></i>

                    Add Retailer

                </a>

            </div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Retailer List

        </h3>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table id="retailerTable"
                   class="table table-bordered table-striped table-hover w-100">

                <thead>

                <tr>

                    <th width="60">#</th>

                    <th>Login ID</th>

                    <th>Shop Name</th>

                    <th>Owner</th>

                    <th>Mobile</th>

                    <th>Status</th>

                    <th width="170">Action</th>

                </tr>

                </thead>

            </table>

        </div>

    </div>

</div>

@endsection

@push('styles')

<link rel="stylesheet"
      href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">

@endpush

@push('scripts')

<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.min.js"></script>

<script>

    $(document).on('click', '.btn-delete', function () {

    let id = $(this).data('id');

    Swal.fire({

        title: 'Delete Retailer?',

        text: "This action cannot be undone.",

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#d33',

        cancelButtonColor: '#3085d6',

        confirmButtonText: 'Delete'

    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({

                url: '/admin/retailers/' + id,

                type: 'DELETE',

                data: {

                    _token: $('meta[name="csrf-token"]').attr('content')

                },

                success: function (response) {

                    Swal.fire(

                        'Deleted!',

                        response.message,

                        'success'

                    );

                    $('#retailerTable').DataTable().ajax.reload(null, false);

                },

                error: function (xhr) {

                    Swal.fire(

                        'Error',

                        xhr.responseJSON.message,

                        'error'

                    );

                }

            });

        }

    });

});

$(function () {

    $('#retailerTable').DataTable({

        processing: true,

        serverSide: true,

        responsive: true,

        ajax: "{{ route('admin.retailers.datatable') }}",

        order: [[1, 'asc']],

        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                data: 'login_id',
                name: 'login_id'
            },

            {
                data: 'shop_name',
                name: 'shop_name'
            },

            {
                data: 'owner_name',
                name: 'owner_name'
            },

            {
                data: 'mobile',
                name: 'mobile'
            },

            {
                data: 'status_badge',
                name: 'status',
                orderable: false,
                searchable: false
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }

        ],

        language: {

            processing: "Loading Retailers..."

        }

    });

});

</script>

@endpush