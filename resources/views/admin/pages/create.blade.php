@extends('admin.layout')

@section('title', 'إضافة صفحة')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة صفحة</h2>
        <form method="POST" action="{{ route('admin.pages.store') }}">
            @csrf
            @include('admin.pages._form', ['buttonText' => 'حفظ الصفحة'])
        </form>
    </section>
@endsection
