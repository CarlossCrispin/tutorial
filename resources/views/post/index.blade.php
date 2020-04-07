<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Posts</title>
</head>
<body>
    

</body>
</html> -->


@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="row">
        <a href="{{ route('posts.create')}}" class="btn btn-success btn-md  m-1 ml-auto">NEW</a>
    </div>
</div>
@if(Session::has('message'))
<div class="row justify-content-center">
    <div class="col-sm-7">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Felicidades!</strong> {{ Session::get('message')}}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
@endif
@foreach($posts as $post)
<div class="container border border-secondary mt-5">
    <div class="bg-default">
        <h1 class="text-center">{{$post->title}}</h1>
        <p>{{$post->content}}</p>
        <!-- float-right  -->
        <div class="">
            <div class="row">

                <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-warning btn-sm  m-1 ml-auto">Update.</a>
                <a href="{{ route('posts.show', ['post' => $post]) }}" class="btn btn-info btn-sm  m-1">Read more.</a>


                <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm  m-1"  onclick="return confirm('Are you sure?')">Delete</button>

                </form>
             <!--    <button onclick="myFuncion">ok</button>

                <script>
                    function myFunction() {
                        var txt;
                        var r = confirm("Press a button!");
                        if (r == true) {
                            txt = "You pressed OK!";
                        } else {
                            txt = "You pressed Cancel!";
                        }
                        document.getElementById("demo").innerHTML = txt;
                    }
                </script> -->
            </div>
        </div>
    </div>
</div>
@endforeach
<div class="row justify-content-center mt-5">
    {{$posts->links()}}
</div>
@endsection