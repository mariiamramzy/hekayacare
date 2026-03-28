<div class="field">
    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{ old('name', $permission->name ?? '') }}" required>
</div>

<div class="field">
    <label for="label">Label (Arabic name optional)</label>
    <input id="label" type="text" name="label" value="{{ old('label', $permission->label ?? '') }}">
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.permissions.index') }}">Cancel</a>
</div>
