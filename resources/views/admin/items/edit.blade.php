@extends('admin.layout')

@section('title', 'تعديل العنصر')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل العنصر #{{ $item->id }}</h2>
        <form method="POST" action="{{ route('admin.pages.sections.items.update', [$page, $section, $item]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.items._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
