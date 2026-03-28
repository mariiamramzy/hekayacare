@extends('admin.layout')

@section('title', 'تعديل الصلاحية')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل الصلاحية #{{ $permission->id }}</h2>
        <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
            @csrf
            @method('PUT')
            @include('admin.permissions._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
