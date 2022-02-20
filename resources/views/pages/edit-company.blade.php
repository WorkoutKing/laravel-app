@extends('main')
@section('content')
<h2>UPDATE COMPANIES</h2>
@include('_partials/errors')

<form action="/update/{{$company->id}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="company" placeholder="Company name" value="{{$company->company}}">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="code" placeholder="Company code" value="{{$company->code}}">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="vat" placeholder="PVM Code" value="{{$company->vat}}">
      </div>
  <select name="category_id" class="form-select" value="">
      <option value="" selected>{{$company->category->category}}</option>
      @foreach ($categories as $category)
          <option value="{{$category->id}}">{{$category->category}}</option>
      @endforeach
  </select>
      <div class="form-group">
        <input type="text" class="form-control" name="address" placeholder="Adress" value="{{$company->address}}">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="director" placeholder="CEO" value="{{$company->director}}">
      </div>
      <div class="form-group">
        <textarea name="description" cols="30" row="10" class="form-control" placeholder="Activity">{{$company->description}}</textarea>
      </div>
      <div class="form-group">
        <label>LOGO</label>
        <input type="file" name="logo" class="form-control" >
    </div>
    <button type="submit" class="btn btn-primary" >UPDATE</button>
    </form>
@endsection