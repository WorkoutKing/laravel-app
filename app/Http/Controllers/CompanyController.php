<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Imports\CompaniesImport;
use App\Models\CsvData;
use Carbon\Carbon;

class CompanyController extends Controller
{
    public function index(Request $request){
        
        $search = $request->input('q');
        if($search!="" || $request->company || $request->date){
            $company = Company::where(function ($query) use ($search){
                $query->where('code', 'like', '%'.$search.'%');
            })->when($request->company, function($query, $company){
                return $query->where('company', $company);
            })->when($request->date, function($query, $date){
                return $query->orderBy('created_at', $date);
            })->paginate(6);
            $company->appends(['q' =>$search]);
        }
        else{
            $company = Company::whereDate('created_at', Carbon::today()->toDateString())->paginate(5);
        }
        return view('pages.home')->with('data',$company);
    }
    public function addCompany(){
        return view('pages.add-company');
    }

    public function storeCompany(Request $request){

        $validated = $request->validate([
            'company' => 'required|unique:companies|max:255',
            'code'=>'required',
            'logo' => 'mimes:jpeg,jpg,png,gif,jfif'
        ]);
        if(request()->hasFile('logo')){
            $path = $request->file('logo')->store('public/images');
            $fileName = str_replace('public/','',$path);
        }

        Company::create([
            'company'=>request('company'),
            'code'=>request('code'),
            'vat'=>request('vat'),
            'address'=>request('address'),
            'director'=>request('director'),
            'description'=>request('description'),
            'logo'=>$fileName
        ]);
        return redirect('/');
    }

    public function showCompany(Company $company){
        return view('pages.show-company', compact('company'));
    }

    public function deleteCompany(Company $company){
        $company->delete();
        return redirect('/');
    }

    public function updateCompany(Company $company){

        return view('pages.edit-company', compact('company'));
    }

    public function storeUpdate(Company $company, Request $request){
        if($company->logo){
            File::delete(storage_path('app/public/'.$company->logo));
        }
        if(request()->hasFile('logo')){
            $path = $request->file('logo')->store('public/images');
            $fileName = str_replace('public/','',$path);
            Company::where('id',$company->id)->update(['logo'=>$fileName]);
        }
        Company::where('id', $company->id)->update($request->only(['company','code','vat','address','director','description']));
        return redirect('/company/'.$company->id);
    }
    public function importCompany(){
        return view('pages.import');
    }
    public function processImport(Request $request){
        $path = $request->file('file')->storeAs('public/data', 'data.csv');
        $dataFile = Storage::get($path);

        $dataFile = explode(PHP_EOL,$dataFile);
        $file = [];
        foreach ($dataFile as $data){
            $file[] = explode(';', $data);
        }

        return view('pages.preview', compact('file'));

    }
    public function importAdd(Request $request){
        $dataFile = Storage::get('public/data/data.csv');
        $dataFile = explode(PHP_EOL,$dataFile);
        $file = [];
        foreach ($dataFile as $data){
            $file[] = explode(';', $data);
        }
        foreach ($file as $company){

            Company::create([
                'company' =>$company[0],
                'code' =>$company[1],
                'vat' =>$company[2],
                'address' =>$company[3],
                'director' =>$company[4],
                'description' =>$company[5],
                'logo' =>$company[6]
            ]);

        }
        return redirect('/');
    }
}
// duomenu importas