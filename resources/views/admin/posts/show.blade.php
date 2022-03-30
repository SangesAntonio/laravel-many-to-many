@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12"><h1>{{$post->title}}</h1></div>
        <div class="col-8">{{$post->content}}</div>
        <div class="col-4"><img src="https://www.havocpoint.it/wp-content/uploads/2018/11/shrek-maxw-1280.jpg" alt="" class="img-fluid w-50"></div>
        <div class="col-12">
            <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-primary">Modifica</a>
        </div>
    </div>
</div>
@endsection
<style>
    .container{
        color: white ;
    }
</style>