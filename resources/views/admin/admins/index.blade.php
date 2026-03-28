@extends('admin.layout')

@section('title', 'Admins')

@section('content')
    <section class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">Admins</h2>
            <a class="btn btn-primary" href="{{ route('admin.admins.create') }}">Add Admin</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Roles</th>
                        <th>Last Login</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone ?: '-' }}</td>
                            <td>
                                <span class="badge {{ $admin->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $admin->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                @forelse ($admin->roles as $role)
                                    <span class="badge">{{ $role->name }}</span>
                                @empty
                                    <span class="muted">-</span>
                                @endforelse
                            </td>
                            <td>{{ optional($admin->last_login_at)?->format('Y-m-d H:i') ?: '-' }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.admins.edit', $admin) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.admins.destroy', $admin) }}" onsubmit="return confirm('Delete this admin?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="muted">No admins found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
