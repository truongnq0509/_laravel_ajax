@extends('layouts.app')

@section('content')
    <div>
        <div class="row">
            <div class="col-6">
                <h3>List User</h3>
            </div>
            <div class="col-6 ">
                <a id="btn-create-user" href="javascript:void(0)" class="btn btn-success float-end">Create User</a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">FullName</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Role</th>
                    <th scope="col">Email</th>
                    <th scope="col">Create At</th>
                    <th scope="col">Update At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            @php
                // dd($users);
            @endphp

            @forelse ($users as $key => $user)
                <tbody>
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $user->fullname }}</td>
                        <td>
                            <img class="image" src={{ $user->avatar }} />
                        </td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ date('d-m-Y h:i:s', strtotime($user->created_at)) }}</td>
                        <td>
                            @if (isset($user->updated_at))
                                {{ date('d-m-Y h:i:s', strtotime($user->updated_at)) }}
                            @else
                                Đang cập nhật
                            @endif
                        </td>
                        <td class="actions">
                            <a href="javascript:void(0)" data-id="{{ $user->id }}"
                                class="btn btn-warning btn-view-user">
                                <i class="bi bi-eyeglasses"></i>
                            </a>

                            <a href="javascript:void(0)" data-id="{{ $user->id }}" class="btn btn-info btn-update-user">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <a href="javascript:void(0)" data-id="{{ $user->id }}"
                                class="btn btn-danger btn-delete-user">
                                <i class="bi bi-x"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            @empty
                <tr>
                    <div class="alert alert-danger" role="alert">
                        No Data !!!
                    </div>
                </tr>
            @endforelse
        </table>

        {{-- modal create user --}}
        <div class="modal fade" id="modal-create-user" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-create-user">
                            <div class="mb-2">
                                <label for="fullname" class="col-form-label">FullName</label>
                                <input type="text" class="form-control" name="fullname" id="fullname">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-2">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-2">
                                <label for="avatar" class="col-form-label">Avatar</label>
                                <input type="text" class="form-control" name="avatar" id="avatar">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-2">
                                <label for="role_id" class="col-form-label">Role</label>
                                <select name='role_id' id='role_id' class="form-select" aria-label="-- role --">
                                    <option value="1" selected>admin</option>
                                    <option value="2">user</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="modal-footer ">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                    <span><i class="bi bi-x-square"></i></span>
                                    <span>Cancel</span>
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <span><i class="bi bi-save"></i></span>
                                    <span>Create</span>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        {{-- modal update user --}}
        <div class="modal fade" id="modal-update-user" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-update-user">
                            <div class="mb-2">
                                <label for="fullname" class="col-form-label">FullName</label>
                                <input type="text" class="form-control" name="fullname" id="fullname">
                                <div class="invalid-feedback"></div>
                            </div>

                            <input type="text" class="form-control" name="id" id="id"
                                style="display: none">
                            <div class="mb-2">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-2">
                                <label for="avatar" class="col-form-label">Avatar</label>
                                <input type="text" class="form-control" name="avatar" id="avatar">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-2">
                                <label for="role_id" class="col-form-label">Role</label>
                                <select name='role_id' id='role_id' class="form-select" aria-label="-- role --">
                                    <option value="1">admin</option>
                                    <option value="2">user</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="modal-footer ">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                    <span><i class="bi bi-x-square"></i></span>
                                    <span>Cancel</span>
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <span><i class="bi bi-save"></i></span>
                                    <span>Update</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal view user --}}
        <div class="modal fade" id="modal-view-user" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">View User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="user">
                            <div class="user-view">
                                <img src="" />
                            </div>
                            <h3 class="user-name"></h3>
                            <p class="user-email"></p>
                            <p class="user-role"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modal-delete-user" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Xóa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có muốn xóa user này không</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger">Oki</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .table {
            margin-top: 36px;
        }


        .image {
            width: 64px;
            height: 64px;
            border: 1px solid #ccc;
            border-radius: 50%;
        }

        .btn>i {
            color: #ffffff;
            font-size: 16px;
        }

        .modal-footer button {
            display: flex;
            gap: 8px;
        }

        .modal-footer button i {
            font-size: 12px;
        }

        .modal-footer {
            border: none !important;
            padding: 16px 0 8px 0 !important;
        }

        .user {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }

        .user-view img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // load data
            function loadData(id) {
                let data = null

                $.ajax({
                    type: "GET",
                    url: `/users/${id}`,
                    async: false,
                    dataType: "json",
                    success: function(res) {
                        if (res.code === 200) {
                            data = res.data
                        }
                    }
                });

                return data
            }

            // view user
            $('.btn-view-user').each((i, el) => {
                $(el).on('click', function() {
                    $('#modal-view-user').modal('show')
                    const id = $(this).data('id')
                    const data = loadData(id)

                    $('#modal-view-user').find('.user-view').find('img').attr('src', data.avatar)
                    $('#modal-view-user').find('.user-name').text(data.fullname)
                    $('#modal-view-user').find('.user-email').text(data.email)
                    $('#modal-view-user').find('.user-role').text(data.role_id)
                })
            })

            // create user
            $('#btn-create-user').on('click', function() {
                $('#modal-create-user').modal('show')
            });

            $('#form-create-user').on('submit', function(e) {
                e.preventDefault();

                const data = {
                    _token: "{{ csrf_token() }}",
                    fullname: $(this).find('input[name=fullname]').val(),
                    email: $(this).find('input[name=email]').val(),
                    avatar: $(this).find('input[name=avatar]').val(),
                    role_id: Number($(this).find('select[name="role_id"]').val()),
                }

                $.ajax({
                    url: '/users',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function(res) {
                        if (res.code === 400) {
                            const errors = res.errors;
                            return Object.entries(errors).map(([key, value], index) => {
                                const el = $(`label[for="${key}"]`).next(
                                    '.form-control')
                                el.addClass('is-invalid')
                                el.next('.invalid-feedback').text(value[0])
                            })
                        }

                        $('#modal-create-user').modal('hide');
                        location.reload();
                        window.location.hash = 'link';
                    }
                })
            })

            // update user
            $('.btn-update-user').each((i, el) => {
                $(el).on('click', function() {
                    $('#modal-update-user').modal('show')
                    const id = $(this).data('id')
                    const data = loadData(id)

                    $('#modal-update-user').find('input[name=id]').val(data.id)
                    $('#modal-update-user').find('input[name=fullname]').val(data.fullname)
                    $('#modal-update-user').find('input[name=email]').val(data.email)
                    $('#modal-update-user').find('input[name=avatar]').val(data.avatar)
                    $('#modal-update-user').find('select[name="role_id"]').val(data.role_id)
                })
            })

            $('#form-update-user').on('submit', function(e) {
                e.preventDefault();

                const id = $(this).find('input[name=id]').val()

                const data = {
                    _token: "{{ csrf_token() }}",
                    id: $(this).find('input[name=id]').val(),
                    fullname: $(this).find('input[name=fullname]').val(),
                    email: $(this).find('input[name=email]').val(),
                    avatar: $(this).find('input[name=avatar]').val(),
                    role_id: Number($(this).find('select[name="role_id"]').val()),
                }

                console.log('id', id)

                $.ajax({
                    url: `/users/${id}`,
                    type: 'PUT',
                    dataType: 'json',
                    data: data,
                    success: function(res) {
                        if (res.code === 400) {
                            const errors = res.errors;
                            return Object.entries(errors).map(([key, value], index) => {
                                const el = $(`label[for="${key}"]`).next(
                                    '.form-control')
                                el.addClass('is-invalid')
                                el.next('.invalid-feedback').text(value[0])
                            })
                        }

                        $('#modal-update-user').modal('hide');
                        location.reload();
                        window.location.hash = 'link';
                    }
                })
            })

            // delete user
            $('.btn-delete-user').each((i, el) => {
                $(el).on('click', function() {
                    $('#modal-delete-user').modal('show')
                    const id = $(this).data('id')

                    $('#modal-delete-user').find('.btn-danger').on('click', function() {
                        $.ajax({
                            type: "DELETE",
                            url: `/users/${id}`,
                            dataType: "json",
                            data: {
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(res) {
                                if (res.code === 400) return

                                $('#modal-delete-user').modal('hide');
                                location.reload();
                                window.location.hash = 'link';
                            }
                        });
                    })
                })
            })
        })
    </script>
@endsection
