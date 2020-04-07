@extends('layouts.app')
@section('content')
@if(Session::has('message'))
<div class="row justify-content-center">
    <div class="col-sm-6">
        <div class="row justify-content-center">
            <div class="col-sm-7">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ Session::get('message')}}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="container">
    @foreach($posts as $post)
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card bm-4 mt-3">
                <div class="card-header"></div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{$post->title}}
                    </h5>
                    <p class="card-text">
                        {{$post->content}}
                    </p>
                </div>
                <div class="card-footer">
                    
                    <div class="ml-auto">
                       <!--  <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-warning btn-sm  m-1 ml-auto">Update.</a> -->
                        <a href="{{ route('posts.show', ['post' => $post]) }}" class="btn btn-info btn-sm  m-1">Read more.</a>
    
    
                        <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm  m-1" onclick="return confirm('Are you sure?')">Delete</button>
    
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection