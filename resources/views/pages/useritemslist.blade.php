@extends('main')
@section('content')
<div class="container">
{{$items->links()}}
<div class="row">
    @foreach($items as $items)
    @if(auth()->user()->id === $items->user_id)
        <div class="card" style="width: 14rem;">
            <img class="card-img-top" src="https://cdn.shopify.com/s/files/1/0267/8299/0398/products/zabawka-dla-psa-gryzak-gumowy-kaczka-kaina-gaukpigiau-31333952651434_1024x.jpg?v=1641216621">
            <div class="card-body">
                <h5 class="card-title">{{$items->item_name}}</h5>
                <h5>Creator:{{$items->company['company'] ?? null}}</h5>
                Description:<p class="card-text">{{$items->description}}</p>
                <p>Price:{{$items->price}} $</p>
                <div class="col">
                    <div class="row">
                <a href="/updat/items/{{$items->id}}" class="btn btn-success">UPDATE</a>
                </div>
                <div class="row">
                <a href="/delet/items/{{$items->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove it?')">DELETE</a>
                </div>
                </div>
            </div>
        </div>
      @endif
    @endforeach   
</div>
</div>
@endsection