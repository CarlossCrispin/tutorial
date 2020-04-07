@extends('layouts.app')

@section('content')
@if($errors->any())
<div class="row justify-content-center">
    <div class="col-sm-7">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <!-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. -->
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>

@endif
<form action="{{route('posts.store')}}" method="POST">
    @csrf
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="título" value="{{ old('title')}}">
            </div>
            <div class="form-group">
                <label for="content">Contenido</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control" >{{ old('content')}}</textarea>
            </div>
        </div>
        <div class="col-sm-7 text-center">
            <button class="btn btn-primary btn-block" type="submit">Enviar</button>
        </div>
    </div>
</form>
@endsection