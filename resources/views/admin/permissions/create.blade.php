@extends('admin.layout')

@section('title', 'إضافة صلاحية')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة صلاحية</h2>
        <form method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf
            @include('admin.permissions._form', ['buttonText' => 'حفظ الصلاحية'])
        </form>
    </section>
@endsection
