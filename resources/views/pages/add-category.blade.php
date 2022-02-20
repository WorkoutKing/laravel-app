@extends('main')
@section('content')
<div class="mx-3 my-2">
    <h2>Create category for company:</h2>
    @include('_partials/errors')
    <form action="/create-category" method="post">
        @csrf
        <div class="col-12 d-flex">
            <div class="col-10">
                <input type="text" name="category" placeholder="Company category" class="form-control">
            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-primary">SUBMIT</button>
            </div>
        </div>
    </form>
</div>
@endsection