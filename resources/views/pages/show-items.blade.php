@extends('main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form>
                <div class="input-group">
            <select name="date" class="form-select">
                <option value="" selected disabled>--Sort by items added date--</option>
                <option value="asc">Oldest</option>
                <option value="desc">Newest</option>
            </select>
            <button class="btn btn-primary" type="submit">
               SEARCH
            </button>
        </div>
        </form>
    </div>
</div>
{{$items->links()}}
<div class="row">
    @foreach($items as $items)
        <div class="card" style="width: 14rem;">
            <img class="card-img-top" src="https://cdn.shopify.com/s/files/1/0267/8299/0398/products/zabawka-dla-psa-gryzak-gumowy-kaczka-kaina-gaukpigiau-31333952651434_1024x.jpg?v=1641216621">
            <div class="card-body">
                <h5 class="card-title">{{$items->item_name}}</h5>
                <h5>Creator: {{$items->company['company']}}</h5>                Description:<p class="card-text">{{$items->description}}</p>
                <p>Price:{{$items->price}} $</p>
                <a href="/updateshoping/items/{{$items->id}}" class="btn btn-primary">BUY</a>
            </div>
        </div>
    @endforeach
</div>    
</div>
@endsection