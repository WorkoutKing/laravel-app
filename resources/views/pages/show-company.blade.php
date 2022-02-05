@extends('main')
@section('content')
    <div class="container-fluid d-flex justify-content-center">
        <h1 class="mt-4">{{$company->company}}</h1>
    </div>
    <div class="container-fluid d-flex justify-content-center">
        <div >
            <p><b>COMPANY CODE:</b>{{$company->code}}</p>
            <p><b>PVM CODE:</b>{{$company->vat}}</p>
            <p><b>ADDRESS:</b>{{$company->address}}</p>
            <p><b>CEO:</b> {{$company->director}}</p>
            <p><b>ACTIVITY:</b>{{$company->description}}</p>
            @if($company->logo)
            <img src="{{ asset('/storage/'.$company->logo)}}" alt="pic company" height="200" width="200">
            @endif
        </div>
    </div>
@endsection