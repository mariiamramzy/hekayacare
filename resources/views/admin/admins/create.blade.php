@extends('admin.layout')

@section('title', 'إضافة أدمن')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة أدمن</h2>
        <form method="POST" action="{{ route('admin.admins.store') }}">
            @csrf
            @include('admin.admins._form', ['buttonText' => 'حفظ الأدمن'])
        </form>
    </section>
@endsection
