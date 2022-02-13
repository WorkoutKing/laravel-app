@extends('main')
@section('content')
<div class='container'>
    <div class="row">
        @foreach($categories as $category)
        @if(auth()->user()->id === $category->id)
        <div class="card" style="width: 10rem;">
        <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtqY16bfobbjivsZb2u6WEgzJ3C8PN0txWnA&usqp=CAU">
        <div class="card-body">
        <div class="col-12 text-center">
            CATEGORY:
         <b>{{$category->category}}</b>
         </div>
         <div class="col">
            <div class="row">
        <a href="/upda/category/{{$category->id}}" class="btn btn-success">UPDATE</a>
        </div>
        <div class="row">
        <a href="/dele/category/{{$category->id}}" class="btn btn-danger">DELETE</a>
        </div>
        </div>
        </div>
    </div>
    @endif
        @endforeach
    </div>
</div>
@endsection