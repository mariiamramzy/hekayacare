@extends('admin.layout')

@section('title', 'إضافة دور')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة دور</h2>
        <form method="POST" action="{{ route('admin.roles.store') }}">
            @csrf
            @include('admin.roles._form', ['buttonText' => 'حفظ الدور'])
        </form>
    </section>
@endsection
