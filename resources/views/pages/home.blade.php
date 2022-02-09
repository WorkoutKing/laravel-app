@extends('main')
@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
               <form action=""> 
                <div class="input-group">
            <input  type="text" name="company" placeholder="Search by name" class="form-control"/>
                <input type="text" name="q" placeholder="Search by code" class="form-control"/>
                <select name="date" class="form-control">
                    <option value="" selected disabled>--Sort by registration date--</option>
                    <option value="asc">Oldest</option>
                    <option value="desc">Newest</option>
                </select>
                <input type="submit" class="btn btn-primary" value="Search"/>
                </div>
            </form>
        </div>
</div>
    {{$data->links()}}
    <table class="table table-bordered table-responsive">
        <tr>
            <th>Company name</th>
            <th>Code</th>
            <th>PVM code</th>
            <th>.....</th>
            <th>Activate</th>
        </tr>
        @foreach($data as $company)
            <tr>
                <th>{{$company->company}}</th>
                <th>{{$company->code}}</th>
                <th>{{$company->vat}}</th>
                <th><a href="/company/{{$company->id}}">More info</th>
                    <th>
                        <ul>
                            <li><a href="/delete/company/{{$company->id}}">delete</a></li>
                            <li><a href="/update/company/{{$company->id}}">update</a></li>
                        </ul>
                    </th>
            </tr>
        @endforeach
    </table>
    
</div>
@endsection