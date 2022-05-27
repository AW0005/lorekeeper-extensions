@extends('layouts.app')
<style>
    .site-page-content {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .timestamp {
        filter: brightness(550%);
        position: absolute;
        bottom: 15px;
        right: 20px;
    }
</style>
@section('title') {{ $page->title }} @endsection

@section('content')
{!! breadcrumbs([$page->title => $page->url]) !!}
<h1 class="text-center">{{ $page->title }}</h1>

<div class="site-page-content parsed-text">
    {!! $page->parsed_text !!}

    @if($page->key == 'feedback')
    <div style="height: 500px">
    <script type="text/javascript" src="https://form.jotform.com/jsform/221458080725051"></script>
</div>
    @endif
</div>

@if($page->can_comment)
    <div class="container">
        @comments(['model' => $page,
                'perPage' => 5
            ])
    </div>
@endif

<div class="timestamp"><strong>Last updated:</strong> {!! format_date($page->updated_at) !!}</div>
@endsection
