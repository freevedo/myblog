@extends('layouts.app')

@section('content')

<h2>Create a post</h2>
{!! Form::open(['action' => 'App\Http\Controllers\PostsController@store' , 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class' => 'form-control' , 'placeholder' =>'name'])}}
    </div>
    <div class="form-group">
        {{Form::label('content', 'Content')}}
        {{Form::textarea('content', '', ['class' => 'form-control' , 'placeholder' =>'Content','name' =>'content'])}}
    </div>
    <div class="form-group">
        {{Form::label('user_id', 'Userid')}}
        {{Form::text('user_id', '', ['class' => 'form-control' , 'placeholder' =>'User id'])}}
    </div>
    <div class="form-group">
        {{Form::label('expire_date', 'ExpireDate')}}
        {{Form::text('expire_date', '', ['class' => 'form-control' , 'placeholder' =>'Expire date'])}}
    </div>
    <div class="form-group">
        {{Form::label('tag', 'Tag')}}
        {{Form::text('tag', '', ['class' => 'form-control' , 'placeholder' =>'Tag'])}}
    </div>
    <div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    </div>
    
{!! Form::close() !!}


@endsection