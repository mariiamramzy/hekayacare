@extends('admin.layout')

@section('title', 'إضافة وسم')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة وسم</h2>
        <form method="POST" action="{{ route('admin.blog-tags.store') }}">
            @csrf
            @include('admin.blog-tags._form', ['buttonText' => 'حفظ الوسم'])
        </form>
    </section>
@endsection
