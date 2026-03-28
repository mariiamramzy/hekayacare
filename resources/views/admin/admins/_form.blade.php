@php
    $selectedRoles = old('roles', isset($admin) ? $admin->roles->pluck('id')->all() : []);
@endphp

<div class="field">
    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{ old('name', $admin->name ?? '') }}" required>
</div>

<div class="field">
    <label for="email">Email</label>
    <input id="email" type="email" name="email" value="{{ old('email', $admin->email ?? '') }}" required>
</div>

<div class="field">
    <label for="phone">Phone</label>
    <input id="phone" type="text" name="phone" value="{{ old('phone', $admin->phone ?? '') }}">
</div>

<div class="field">
    <label for="password">Password {{ isset($admin) ? '(leave empty to keep current)' : '' }}</label>
    <input id="password" type="password" name="password" {{ isset($admin) ? '' : 'required' }}>
</div>

<div class="field">
    <label for="password_confirmation">Confirm Password</label>
    <input id="password_confirmation" type="password" name="password_confirmation" {{ isset($admin) ? '' : 'required' }}>
</div>

<div class="field">
    <label>
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($admin) ? $admin->is_active : true) ? 'checked' : '' }}>
        Is Active
    </label>
</div>

<div class="field">
    <label>Roles</label>
    <div class="check-grid">
        @forelse ($roles as $role)
            <label>
                <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, $selectedRoles, true) ? 'checked' : '' }}>
                {{ $role->name }} {{ $role->label ? "({$role->label})" : '' }}
            </label>
        @empty
            <span class="muted">No roles found.</span>
        @endforelse
    </div>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.admins.index') }}">Cancel</a>
</div>
