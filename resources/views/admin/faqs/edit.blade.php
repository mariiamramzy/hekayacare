@extends('admin.layout')

@section('title', 'تعديل سؤال')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل السؤال #{{ $faq->id }}</h2>
        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
            @csrf
            @method('PUT')
            @include('admin.faqs._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
