@extends('main')
@section('content')
<div class="container-fluid">
    <form action="">
        <div class="row">
            <input type="text" name="company" placeholder="Search company by name" class="form-group"/>
                <input type="text" name="q" placeholder="Search company by code" class="form-group"/>
                <select name="date" class="form-select">
                    <option value="" selected disabled>--Sort by registration date--</option>
                    <option value="asc">Oldest</option>
                    <option value="desc">Newest</option>
                </select>
                <input type="submit" class="btn btn-primary" value="Search"/>
        </div>
    </form>
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