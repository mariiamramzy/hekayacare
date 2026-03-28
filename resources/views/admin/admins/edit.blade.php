@extends('admin.layout')

@section('title', 'تعديل الأدمن')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل الأدمن #{{ $admin->id }}</h2>
        <form method="POST" action="{{ route('admin.admins.update', $admin) }}">
            @csrf
            @method('PUT')
            @include('admin.admins._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
