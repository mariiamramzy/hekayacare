@extends('admin.layout')

@section('title', 'تعديل صورة الجاليري')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل صورة الجاليري #{{ $galleryImage->id }}</h2>
        <form method="POST" action="{{ route('admin.gallery-images.update', $galleryImage) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.gallery-images._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
