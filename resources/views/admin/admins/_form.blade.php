@php
    $selectedRoles = old('roles', isset($admin) ? $admin->roles->pluck('id')->all() : []);
@endphp

<div class="field">
    <label for="name">الاسم</label>
    <input id="name" type="text" name="name" value="{{ old('name', $admin->name ?? '') }}" required>
</div>

<div class="field">
    <label for="email">البريد الإلكتروني</label>
    <input id="email" type="email" name="email" value="{{ old('email', $admin->email ?? '') }}" required>
</div>

<div class="field">
    <label for="phone">الهاتف</label>
    <input id="phone" type="text" name="phone" value="{{ old('phone', $admin->phone ?? '') }}">
</div>

<div class="field">
    <label for="password">كلمة المرور {{ isset($admin) ? '(اتركها فارغة للإبقاء على الحالية)' : '' }}</label>
    <input id="password" type="password" name="password" {{ isset($admin) ? '' : 'required' }}>
</div>

<div class="field">
    <label for="password_confirmation">تأكيد كلمة المرور</label>
    <input id="password_confirmation" type="password" name="password_confirmation" {{ isset($admin) ? '' : 'required' }}>
</div>

<div class="field">
    <label>
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($admin) ? $admin->is_active : true) ? 'checked' : '' }}>
        نشط
    </label>
</div>

<div class="field">
    <label>الأدوار</label>
    <div class="check-grid">
        @forelse ($roles as $role)
            <label>
                <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, $selectedRoles, true) ? 'checked' : '' }}>
                {{ $role->label ?: $role->name }}
            </label>
        @empty
            <span class="muted">لا توجد أدوار.</span>
        @endforelse
    </div>
</div>

<div class="actions">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a class="btn btn-secondary" href="{{ route('admin.admins.index') }}">إلغاء</a>
</div>
