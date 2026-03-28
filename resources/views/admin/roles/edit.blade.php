@extends('admin.layout')

@section('title', 'تعديل الدور')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل الدور #{{ $role->id }}</h2>
        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            @csrf
            @method('PUT')
            @include('admin.roles._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
