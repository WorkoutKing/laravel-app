@extends('main')
@section('content')
<div class="container-fluid">
    <h1 class="mt-4">ALL COMPANIES</h1>
    <table class="table table-bordered table-responsive">
        <tr>
            <th>Company name</th>
            <th>Code</th>
            <th>PVM code</th>
            <th>.....</th>
            <th>Activate</th>
        </tr>
        @foreach($companies as $company)
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
    {{$companies->links()}}
</div>
@endsection