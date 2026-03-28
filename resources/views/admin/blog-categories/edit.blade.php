@extends('admin.layout')

@section('title', 'تعديل تصنيف المقال')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل تصنيف المقال #{{ $blogCategory->id }}</h2>
        <form method="POST" action="{{ route('admin.blog-categories.update', $blogCategory) }}">
            @csrf
            @method('PUT')
            @include('admin.blog-categories._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
