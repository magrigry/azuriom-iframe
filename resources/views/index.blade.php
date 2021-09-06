@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="embed-responsive embed-responsive-16by9" style="height: {{ setting("iframe.height", '82') }}vh">
    <iframe id="iframe-plugin" src="{{ $target }}" frameborder="0" class="embed-responsive-item" allowfullscreen></iframe>
</div>

@endsection
