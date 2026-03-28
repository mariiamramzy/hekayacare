@extends('admin.layout')

@section('title', 'إضافة سؤال')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة سؤال شائع</h2>
        <form method="POST" action="{{ route('admin.faqs.store') }}">
            @csrf
            @include('admin.faqs._form', ['buttonText' => 'حفظ السؤال'])
        </form>
    </section>
@endsection
