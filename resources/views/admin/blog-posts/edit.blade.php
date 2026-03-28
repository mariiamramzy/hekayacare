@extends('admin.layout')

@section('title', 'تعديل مقال')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/trumbowyg/trumbowyg.min.css') }}">
@endsection

@section('content')
    <section class="card card-body-soft">
        <div class="page-toolbar">
            <h2 class="page-title page-toolbar__title">تعديل المقال #{{ $blogPost->id }}</h2>
            <div class="page-toolbar__actions">
                <a class="btn btn-secondary" href="{{ route('admin.blog-posts.seo.edit', $blogPost) }}">تعديل SEO</a>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.blog-posts.update', $blogPost) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.blog-posts._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/vendor/trumbowyg/trumbowyg.min.js') }}"></script>
    <script>
        (function () {
            if (typeof window.jQuery === 'undefined') {
                return;
            }

            window.jQuery(function ($) {
                const $editor = $('#content_ar');
                if (!$editor.length || typeof $editor.trumbowyg === 'undefined') {
                    return;
                }

                $editor.trumbowyg({
                    btns: [
                        ['viewHTML'],
                        ['undo', 'redo'],
                        ['formatting'],
                        ['strong', 'em', 'del'],
                        ['link'],
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['unorderedList', 'orderedList'],
                        ['horizontalRule'],
                        ['removeformat'],
                        ['fullscreen']
                    ]
                });
            });
        })();
    </script>
    @stack('scripts')
@endsection
