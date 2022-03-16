@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $post->name, ['class' => 'form-control', 'placeholder' => 'name'])}}
        </div>
        <div class="form-group">
            {{Form::label('content', 'Content')}}
            {{Form::textarea('content', $post->content,  'class' => 'form-control', 'placeholder' => 'Content Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('user_id', 'Userid')}}
            {{Form::text('user_id', $post->user_id, ['class' => 'form-control' , 'placeholder' =>'User id'])}}
        </div>
        <div class="form-group">
            {{Form::label('expire_date', 'ExpireDate')}}
            {{Form::text('expire_date', $post->expire_date, ['class' => 'form-control' , 'placeholder' =>'Expire date'])}}
        </div>
        <div class="form-group">
            {{Form::label('tag', 'Tag')}}
            {{Form::text('tag', $post->tag, ['class' => 'form-control' , 'placeholder' =>'Tag'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection