@extends('main')
@section('content')
<h2>CREATE ITEM</h2>
@include('_partials/errors')
<form action="/stores" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="item_name" placeholder="Item name" >
      </div>
        <select name="company" class="form-select">
          <option value="" selected disabled>--SELECT COMPANY--</option>
          @foreach ($companyId as $id=>$company)
          <option value="{{$company}}">{{$id}}</option>
      @endforeach
      </select>
      <div class="form-group">
        <input type="text" class="form-control" name="description" placeholder="Description">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="price" placeholder="Price">
      </div>
    <button type="submit" class="btn btn-primary" >SAVE</button>
    </form>
@endsection