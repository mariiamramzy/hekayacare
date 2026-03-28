@extends('admin.layout')

@section('title', 'تعديل طلب الحجز')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل طلب الحجز #{{ $appointmentRequest->id }}</h2>
        <form method="POST" action="{{ route('admin.appointment-requests.update', $appointmentRequest) }}">
            @csrf
            @method('PUT')
            @include('admin.appointment-requests._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
