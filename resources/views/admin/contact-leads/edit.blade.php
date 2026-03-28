@extends('admin.layout')

@section('title', 'Edit Contact Lead')

@section('content')
    <section class="card">
        <h2 class="page-title">Edit Contact Lead #{{ $contactLead->id }}</h2>

        <form method="POST" action="{{ route('admin.contact-leads.update', $contactLead) }}">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $contactLead->name) }}" required>
            </div>

            <div class="field">
                <label for="mobile">Mobile</label>
                <input id="mobile" name="mobile" type="text" value="{{ old('mobile', $contactLead->mobile) }}" required>
            </div>

            <div class="field">
                <label for="message">Message</label>
                <textarea id="message" name="message" required>{{ old('message', $contactLead->message) }}</textarea>
            </div>

            <div class="actions">
                <button class="btn btn-primary" type="submit">Update</button>
                <a class="btn btn-secondary" href="{{ route('admin.contact-leads.index') }}">Cancel</a>
            </div>
        </form>
    </section>
@endsection
