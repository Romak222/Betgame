@extends('layouts.admin')

@section('title', 'Game Rounds')

@section('content')

<div class="card">

    <div class="card-header">

        <div class="d-flex justify-content-between align-items-center">

            <h3 class="card-title">

                Game Rounds

            </h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoundModal">

                <i class="fas fa-plus"></i>

                Create Round

            </button>

        </div>

    </div>

    <div class="card-body">

        <table id="roundTable" class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Game</th>

                    <th>Round No</th>

                    <th>Start Time</th>

                    <th>End Time</th>

                    <th>Status</th>
                    <th>Result</th>

                    <th width="180">

                        Action

                    </th>

                </tr>

            </thead>

        </table>

    </div>

</div>

{{-- Create Modal --}}

<div class="modal fade" id="createRoundModal" tabindex="-1">

    <div class="modal-dialog">

        <form id="createRoundForm">

            @csrf

            <div class="modal-content">

                <div class="modal-header">

                    <h5>

                        Create Round

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">

                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label>

                            Select Game

                        </label>

                        <select name="game_id" class="form-control" required>

                            <option value="">

                                Select

                            </option>

                            @foreach($games as $game)

                            <option value="{{ $game->id }}">

                                {{ $game->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-success">

                        Create

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection

@push('scripts')

<script>

let table;

$(document).ready(function () {

    table = $('#roundTable').DataTable({

        processing: true,

        serverSide: true,

        responsive: true,

        ajax: "{{ route('admin.rounds.datatable') }}",

        order: [[2, 'desc']],

        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                data: 'game',
                name: 'game'
            },

            {
                data: 'round_no',
                name: 'round_no'
            },

            {
                data: 'start_time',
                name: 'start_time'
            },

            {
                data: 'end_time',
                name: 'end_time'
            },

            {
                data: 'status_badge',
                name: 'status_badge',
                orderable: false,
                searchable: false
            },
            {
                data: 'result',
                name: 'result',
                defaultContent: '-'
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }

        ]

    });

    $('#createRoundForm').submit(function (e) {

        e.preventDefault();

        $.ajax({

            url: "{{ route('admin.rounds.store') }}",

            type: "POST",

            data: $(this).serialize(),

            success: function (res) {

                bootstrap.Modal.getInstance(
                    document.getElementById('createRoundModal')
                ).hide();

                $('#createRoundForm')[0].reset();

                table.ajax.reload(null, false);

                Swal.fire({

                    icon: 'success',

                    title: 'Success',

                    text: res.message

                });

            },

            error: function (xhr) {

                let message = 'Something went wrong.';

                if (xhr.responseJSON && xhr.responseJSON.message) {

                    message = xhr.responseJSON.message;

                }

                Swal.fire({

                    icon: 'error',

                    title: 'Error',

                    text: message

                });

            }

        });

    });

    $(document).on('click', '.btn-delete', function () {

        let id = $(this).data('id');

        Swal.fire({

            title: 'Delete Round?',

            text: 'This action cannot be undone.',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#d33',

            cancelButtonColor: '#3085d6',

            confirmButtonText: 'Delete'

        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({

                    url: "{{ url('admin/rounds') }}/" + id,

                    type: "DELETE",

                    data: {

                        _token: $('meta[name="csrf-token"]').attr('content')

                    },

                    success: function (res) {

                        Swal.fire({

                            icon: 'success',

                            title: 'Deleted',

                            text: res.message

                        });

                        table.ajax.reload(null, false);

                    },

                    error: function (xhr) {

                        let message = 'Delete failed.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {

                            message = xhr.responseJSON.message;

                        }

                        Swal.fire({

                            icon: 'error',

                            title: 'Error',

                            text: message

                        });

                    }

                });

            }

        });

    });

    $(document).on('click', '.btn-close-round', function () {

        let id = $(this).data('id');

        Swal.fire({

            title: 'Close Round?',

            text: 'Retailers will not be able to place bets.',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Yes, Close'

        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({

                    url: "{{ url('admin/rounds') }}/" + id + "/close",

                    type: "POST",

                    data: {

                        _token: $('meta[name="csrf-token"]').attr('content')

                    },

                    success: function (res) {

                        Swal.fire({

                            icon: 'success',

                            title: 'Closed',

                            text: res.message || 'Round closed successfully.'

                        });

                        table.ajax.reload(null, false);

                    },

                    error: function (xhr) {

                        let message = 'Something went wrong.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {

                            message = xhr.responseJSON.message;

                        }

                        Swal.fire({

                            icon: 'error',

                            title: 'Error',

                            text: message

                        });

                    }

                });

            }

        });

    });

    $(document).on('click', '.btn-result', function () {

        let id = $(this).data('id');

        Swal.fire({

            title: 'Declare Result',

            input: 'select',

            inputOptions: {
                0: '0',
                1: '1',
                2: '2',
                3: '3',
                4: '4',
                5: '5',
                6: '6',
                7: '7',
                8: '8',
                9: '9'
            },

            inputPlaceholder: 'Select Winning Number',

            showCancelButton: true,

            confirmButtonText: 'Declare'

        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({

                    url: "{{ url('admin/rounds') }}/" + id + "/result",

                    type: "POST",

                    data: {

                        _token: $('meta[name="csrf-token"]').attr('content'),

                        result: result.value

                    },

                    success: function (res) {

                        Swal.fire({

                            icon: 'success',

                            title: 'Success',

                            text: res.message

                        });

                        table.ajax.reload(null, false);

                    },

                    error: function (xhr) {

                        let message = 'Something went wrong.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {

                            message = xhr.responseJSON.message;

                        }

                        Swal.fire({

                            icon: 'error',

                            title: 'Error',

                            text: message

                        });

                    }

                });

            }

        });

    });

});

</script>
@endpush