@extends('layouts.app')

@section('content')

<h2>This is all the  Articles</h2>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card card-body bg-light">
                <h3><a href="{{ url("/posts/{$post->id}") }} ">{{$post->name}}</a></h3>
                <p>Autor : {{ $post->user_id}}</p>
            </div>
        @endforeach
    @else
        <p>No posts found</p>
    @endif



@endsection