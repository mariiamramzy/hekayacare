@extends('admin.layout')

@section('title', 'تعديل القسم')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل القسم #{{ $teamDepartment->id }}</h2>
        <form method="POST" action="{{ route('admin.team-departments.update', $teamDepartment) }}">
            @csrf
            @method('PUT')
            @include('admin.team-departments._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
