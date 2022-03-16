@extends('layouts.app')

@section('content')

<a class="btn btn-default" href="{{url('/posts')}}">Go back</a>
    <h2>{{$post->name}}</h2>
    <h3>Autor : {{$post->user_id}}</h3>
    <small>Written on  : {{ $post->created_at}} </small>

@endsection