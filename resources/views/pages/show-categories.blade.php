@extends('main')
@section('content')
<div class='container-fluid'>
    <form class="d-flex">
        <div class="form-group col-6">
            <select name="category" class="form-select">
                <option value="" selected>--SELECT CATEGORY--</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Filtruoti</button>
        </div>
    </form>
    @if(count($companies))
    <table class="table table-bordered table-responsive">
        <tr>
            <th>Company name</th>
            <th>Code</th>
            <th>PVM code</th>
            <th>Category</th>
            <th>.....</th>
        </tr>
        @foreach($companies as $company)
            <tr>
                <th>{{$company->company}}</th>
                <th>{{$company->code}}</th>
                <th>{{$company->vat}}</th>
                <th>{{$company->category->category}}</th>
                <th><a href="/company/{{$company->id}}">More info</th>
            </tr>
        @endforeach
    </table>
    @endif
</div>
@endsection