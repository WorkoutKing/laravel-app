@extends('main')
@section('content')
@include('_partials/errors')
<div class="container">
@if(auth()->user()->name === 'admin')
<div class="card d-flex justify-content-center" style="width: 14rem; ">
    <img class="card-img-top" src="https://thumbs.dreamstime.com/b/admin-sign-laptop-icon-stock-vector-166205404.jpg">
</div>
@else
<div class="card d-flex justify-content-center" style="width: 14rem; ">
    <img class="card-img-top" src="https://sothis.es/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png">
</div>
@endif
<div>
 Registration ID: <b>{{Auth::user()->id}}</b>
 </div>
 <div>
 Username: <b>{{Auth::user()->name}}</b>
 </div>
 <div>
 Email: <b>{{Auth::user()->email}}</b>
 </div>
 <a href="/useritemlist" class="btn btn-success">Your item list</a>
 <a href="/usercompanylist" class="btn btn-success ">Your company list</a>
</div>
@endsection