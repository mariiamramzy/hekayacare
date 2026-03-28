@extends('admin.layout')

@section('title', 'تعديل عضو الفريق')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل عضو الفريق #{{ $teamMember->id }}</h2>
        <form method="POST" action="{{ route('admin.team-members.update', $teamMember) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.team-members._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
