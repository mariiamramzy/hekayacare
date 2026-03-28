@php
    $selectedPermissions = old('permissions', isset($role) ? $role->permissions->pluck('id')->all() : []);
@endphp

<div class="field">
    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{ old('name', $role->name ?? '') }}" required>
</div>

<div class="field">
    <label for="label">Label (Arabic name optional)</label>
    <input id="label" type="text" name="label" value="{{ old('label', $role->label ?? '') }}">
</div>

<div class="field">
    <label>Permissions</label>
    <div class="check-grid">
        @forelse ($permissions as $permission)
            <label>
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, $selectedPermissions, true) ? 'checked' : '' }}>
                {{ $permission->name }} {{ $permission->label ? "({$permission->label})" : '' }}
            </label>
        @empty
            <span class="muted">No permissions found.</span>
        @endforelse
    </div>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.roles.index') }}">Cancel</a>
</div>
