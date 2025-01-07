@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <body>
            @include('components.navbar')
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Users List</h1>

                    <!-- Tabel Daftar Pengguna -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Daftar Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <!-- Tombol Edit Role -->
                                                <button class="btn btn-sm btn-primary edit-role-btn" data-bs-toggle="modal"
                                                    data-bs-target="#editRoleModal" data-user-id="{{ $user->id }}"
                                                    data-user-role="{{ $user->role }}">
                                                    Edit Role
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </body>

        @include('components.footer')
    </div>

    <!-- Modal untuk Mengedit Role -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('users.updateRole') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoleModalLabel">Edit Role Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="editUserId">
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="editUserRole" class="form-select">
                                <option value="admin">Admin</option>
                                <option value="agent">Agent</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Modal Edit Role -->
    <script>
        const editRoleButtons = document.querySelectorAll('.edit-role-btn');
        const editUserIdInput = document.getElementById('editUserId');
        const editUserRoleSelect = document.getElementById('editUserRole');

        // Ketika tombol Edit Role diklik, set nilai modal sesuai dengan data pengguna
        editRoleButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const userId = button.getAttribute('data-user-id');
                const userRole = button.getAttribute('data-user-role');

                // Set nilai input di dalam modal
                editUserIdInput.value = userId;
                editUserRoleSelect.value = userRole;
            });
        });
    </script>
@endsection
