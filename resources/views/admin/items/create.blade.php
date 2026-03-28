@extends('admin.layout')

@section('title', 'إضافة عنصر')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة عنصر للقسم</h2>
        <form method="POST" action="{{ route('admin.pages.sections.items.store', [$page, $section]) }}" enctype="multipart/form-data">
            @csrf
            @include('admin.items._form', ['buttonText' => 'حفظ العنصر'])
        </form>
    </section>
@endsection
