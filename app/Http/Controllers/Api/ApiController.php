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
    public function userCompany(){
        return CompaniesResource::collection(Company::all());
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        $company -> delete();
        return response()->json([
                'message'=>'Product Deleted Successfully!!'
            ]);
    }


    public function update(Request $request, Company $company, $id)
    {
        $validator = Validator::make($request->all(),[
            'company' => 'required|unique:companies|max:255',
            'code'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $company = Company::find($id);
        $company->company = $request->get('company');
        $company->code = $request->get('code');
        $company->vat= $request->get('vat');
        $company->address= $request->get('address');
        $company->director= $request->get('director');
        $company->description = $request->get('description');
        //$company->logo= $request->logo();
        $company->user_id= $request->get ('user_id');
        $company->category_id= $request-> get('category_id');
        $company->save();
        
        return response()->json(['Company updated successfully.']);
    }
}
