@extends('admin.layout')

@section('title', 'Permissions')

@section('content')
    <section class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px;">
            <h2 class="page-title" style="margin: 0;">Permissions</h2>
            <a class="btn btn-primary" href="{{ route('admin.permissions.create') }}">Add Permission</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Label</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->label ?: '-' }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('admin.permissions.edit', $permission) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}" onsubmit="return confirm('Delete this permission?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="muted">No permissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

@endsection
