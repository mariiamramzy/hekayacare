@extends('admin.layout')

@section('title', 'تعديل الوسم')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل الوسم #{{ $blogTag->id }}</h2>
        <form method="POST" action="{{ route('admin.blog-tags.update', $blogTag) }}">
            @csrf
            @method('PUT')
            @include('admin.blog-tags._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
