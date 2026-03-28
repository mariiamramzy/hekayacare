@extends('admin.layout')

@section('title', 'إضافة قسم')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة قسم للصفحة: {{ $page->title_ar }}</h2>
        <form method="POST" action="{{ route('admin.pages.sections.store', $page) }}" enctype="multipart/form-data">
            @csrf
            @include('admin.sections._form', ['buttonText' => 'حفظ القسم'])
        </form>
    </section>
@endsection
