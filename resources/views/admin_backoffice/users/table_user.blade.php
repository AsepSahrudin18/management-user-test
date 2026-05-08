@extends('admin_backoffice.index')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <div class="card p-4">
        <div class="d-flex justify-content-between mb-3">
            <h3>User Management</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                Tambah User
            </button>
        </div>

        <table id="users-table" class="display">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($users as $user)
                    <tr id="row-{{ $user->id }}">

                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <td>

                            <button class="btn btn-warning btn-edit" data-id="{{ $user->id }}">
                                Edit
                            </button>

                            <button class="btn btn-danger btn-delete" data-id="{{ $user->id }}">
                                Delete
                            </button>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>



    {{-- MODAL --}}

    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Form User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="user-form">
                        <input type="hidden" id="user_id">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" id="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            // DATATABLE

            $('#users-table').DataTable({
                pageLength: 10,
                responsive: true
            });


            // CSRF

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // CREATE & UPDATE

            $('#user-form').submit(function(e) {

                e.preventDefault();

                let id = $('#user_id').val();

                let url = id ?
                    '/users/' + id :
                    '/users';

                let type = id ?
                    'PUT' :
                    'POST';

                $.ajax({

                    url: url,
                    type: type,

                    data: {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        password: $('#password').val()
                    },

                    success: function(response) {

                        // tutup modal dulu
                        $('#userModal').modal('hide');

                        // location.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {

                            location.reload();

                        });

                    },

                    error: function(xhr) {

                        console.log(xhr.responseText);

                    }

                });

            });


            // EDIT

            $(document).on('click', '.btn-edit', function() {

                let id = $(this).data('id');

                $.get('/users/' + id + '/edit', function(user) {

                    $('#user_id').val(user.id);
                    $('#name').val(user.name);
                    $('#email').val(user.email);

                    $('#userModal').modal('show');

                });

            });


            // DELETE

            $(document).on('click', '.btn-delete', function() {

                let id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin?',
                    text: "Data akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajax({

                            url: '/users/' + id,
                            type: 'DELETE',

                            success: function(response) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {

                                    location.reload();

                                });

                            },

                            error: function(xhr) {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Gagal menghapus data'
                                });

                            }

                        });

                    }

                });

            });
        });
    </script>
@endsection
