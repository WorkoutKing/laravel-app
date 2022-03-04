<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CompaniesResource;
use App\Models\Company;


class ApiController extends Controller
{
    public function companies(){
        return CompaniesResource::collection(Company::paginate(5));
    }
    public function company(Company $company){
        return new CompaniesResource($company);
    }
}
