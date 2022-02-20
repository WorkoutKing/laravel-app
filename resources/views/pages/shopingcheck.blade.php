@extends('main')
@section('content')
<h2>Checkout correct information for ittem to buy:</h2>
@include('_partials/errors')
<form action="/storeShoping" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="item_name" placeholder="Item name" value="{{$items->item_name}}">
      </div>
        <select name="company" class="form-select" value="">
          <option value="{{$items->company->id}}" selected>{{$items->company->company}}</option>
          @foreach ($companyId as $id=>$company)
          <option value="{{$company}}">{{$id}}</option>
      @endforeach
      </select>
      <div class="form-group">
        <input type="text" class="form-control" name="description" placeholder="Description" value="{{$items->description}}">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="price" placeholder="Price" value="{{$items->price}}">
      </div>
    <button type="submit" class="btn btn-primary" >BUY</button>
    </form>
@endsection