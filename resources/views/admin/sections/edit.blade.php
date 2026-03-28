@extends('admin.layout')

@section('title', 'تعديل القسم')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل القسم #{{ $section->id }} للصفحة: {{ $page->title_ar }}</h2>
        <form method="POST" action="{{ route('admin.pages.sections.update', [$page, $section]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.sections._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
