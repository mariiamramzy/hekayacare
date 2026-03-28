@extends('admin.layout')

@section('title', 'إضافة قسم')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة قسم فريق</h2>
        <form method="POST" action="{{ route('admin.team-departments.store') }}">
            @csrf
            @include('admin.team-departments._form', ['buttonText' => 'حفظ القسم'])
        </form>
    </section>
@endsection
