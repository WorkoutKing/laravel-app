@extends('main')
@section('content')
<div class="container-fluid">
{{$company->links()}}
    <table class="table table-bordered table-responsive">
        <tr>
            <th>Company name</th>
            <th>Code</th>
            <th>PVM code</th>
            <th>Category</th>
            <th>.....</th>
            <th>Activate</th>
        </tr>
        @foreach($company as $company)
        @if(auth()->user()->id === $company->user_id)
            <tr>
                <th>{{$company->company}}</th>
                <th>{{$company->code}}</th>
                <th>{{$company->vat}}</th>
                <th>{{$company->category->category}}</th>
                <th><a href="/company/{{$company->id}}">More info</th>
                    <th>
                        <ul>
                            <li><a href="/delete/company/{{$company->id}}">delete</a></li>
                            <li><a href="/update/company/{{$company->id}}">update</a></li>
                        </ul>
                    </th>
            </tr>
            @endif
        @endforeach
    </table>
    
</div>
@endsection