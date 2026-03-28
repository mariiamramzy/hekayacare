@extends('admin.layout')

@section('title', 'Roles')

@section('content')
    <section class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">Roles</h2>
            <a class="btn btn-primary" href="{{ route('admin.roles.create') }}">Add Role</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Label</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->label ?: '-' }}</td>
                            <td>
                                @forelse ($role->permissions as $permission)
                                    <span class="badge">{{ $permission->name }}</span>
                                @empty
                                    <span class="muted">-</span>
                                @endforelse
                            </td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.roles.edit', $role) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" onsubmit="return confirm('Delete this role?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="muted">No roles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
