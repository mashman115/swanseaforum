@extends('layouts.app')

@section('title', '- News API' )

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @foreach($articles as $article)
            <br>
            <div class="card">
                <div class="card-header">{{ $article->title }}</div>

                <div class="card-body"> {{ $article->content }}</div>
              </div>
              @endforeach
        </div>
    </div>
</div>
@endsection
