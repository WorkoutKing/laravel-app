@extends('main')
@section('content')
<div class="container">
{{$shopinghistory->links()}}
<div class="row">
    @foreach($shopinghistory as $items)
        <div class="card" style="width: 14rem;">
            <img class="card-img-top" src="https://cdn.shopify.com/s/files/1/0267/8299/0398/products/zabawka-dla-psa-gryzak-gumowy-kaczka-kaina-gaukpigiau-31333952651434_1024x.jpg?v=1641216621">
            <div class="card-body">
                <h5 class="card-title">{{$items->item_name}}</h5>
                <h5>Creator: {{$items->company['company']}}</h5>                Description:<p class="card-text">{{$items->description}}</p>
                <p>Price:{{$items->price}} $</p>
                <h5>Buyer:<b style="text-transform: uppercase;">{{$items->user->name}}</b></h5>
            </div>
        </div>
    @endforeach
</div>    
</div>
@endsection