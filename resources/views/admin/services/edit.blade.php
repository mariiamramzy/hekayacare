@extends('admin.layout')

@section('title', 'تعديل خدمة')

@section('content')
    <section class="card card-body-soft">
        <h2 class="page-title">تعديل خدمة</h2>

        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.services._form', ['buttonText' => 'تحديث الخدمة'])
        </form>
    </section>
@endsection
