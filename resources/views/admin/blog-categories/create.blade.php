@extends('admin.layout')

@section('title', 'إضافة تصنيف مقال')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة تصنيف مقال</h2>
        <form method="POST" action="{{ route('admin.blog-categories.store') }}">
            @csrf
            @include('admin.blog-categories._form', ['buttonText' => 'حفظ التصنيف'])
        </form>
    </section>
@endsection
