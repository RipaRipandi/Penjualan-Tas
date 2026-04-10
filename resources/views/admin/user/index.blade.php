@extends('layouts.admin.app')

@section('page-title', 'Kelola User')

@section('content')

<div class="content-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0 fw-semibold">Daftar User</h5>
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
            <i class="fa fa-user-plus me-1"></i> Tambah User
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id_user }}</td>
                    <td><strong>{{ $user->nama }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="badge bg-danger badge-status">Admin</span>
                        @else
                            <span class="badge bg-primary badge-status">User</span>
                        @endif
                    </td>
                    <td class="text-muted">{{ $user->alamat ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.user.edit', $user->id_user) }}"
                           class="btn btn-sm btn-warning me-1">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        @if($user->id_user != Auth::id())
                        <form action="{{ route('admin.user.destroy', $user->id_user) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin hapus user ini?')">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada user</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection