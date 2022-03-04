<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CompaniesResource;
use App\Models\Company;
use Validator;
use Illuminate\Support\Facades\Auth;



class ApiController extends Controller
{
    public function companies(){
        return CompaniesResource::collection(Company::paginate(5));
    }
    public function company(Company $company){
        return new CompaniesResource($company);
    }
    public function addCompany(Request $request){
        $validator = Validator::make($request->all(),[
            'company' => 'required|unique:companies|max:255',
            'code'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        Company::create([
            'company'=>request('company'),
            'code'=>request('code'),
            'vat'=>request('vat'),
            'address'=>request('address'),
            'director'=>request('director'),
            'description'=>request('description'),
            'logo'=>'',
            'user_id'=>request('user_id'),
            'category_id' => request('category_id')
        ]);
        return response()
        ->json(['message' => 'Company created successfully']);
    }
}
