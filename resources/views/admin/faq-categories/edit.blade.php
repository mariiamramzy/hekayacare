@extends('admin.layout')

@section('title', 'تعديل تصنيف الأسئلة')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل تصنيف الأسئلة #{{ $faqCategory->id }}</h2>
        <form method="POST" action="{{ route('admin.faq-categories.update', $faqCategory) }}">
            @csrf
            @method('PUT')
            @include('admin.faq-categories._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
