<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Imports\CompaniesImport;
use App\Models\CsvData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;

class CompanyController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['except'=>['index','showCompany']]);
    }

    public function index(Request $request){
        
        $search = $request->input('q');
        if($search!="" || $request->company || $request->date){
            $company = Company::where(function ($query) use ($search){
                $query->where('code', 'like', '%'.$search.'%');
            })->when($request->company, function($query, $company){
                return $query->where('company', 'like', '%'.$company.'%');
            })->when($request->date, function($query, $date){
                return $query->orderBy('created_at', $date);
            })->paginate(5);
            $company->appends(['q' =>$search]);
        }
        else{
            $company = Company::paginate(6);
        }
        return view('pages.home')->with('data',$company);
    }

    public function addCompany(){
        $categories = Category::all();
        return view('pages.add-company', compact('categories'));
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
            'logo'=>$fileName,
            'user_id'=>Auth::id(),
            'category_id' => request('category')
        ]);
        return redirect('/');
    }

    public function showCompany(Company $company){
        //dd($company->comments);

        return view('pages.show-company', compact('company'));
    }

    public function deleteCompany(Company $company){
        if(Gate::denies('delete-company',$company)){
            abort(403, 'You dont have permissions!!');
        }
        $company->delete();
        return redirect('/');
    }

    public function updateCompany(Category $category, Company $company){
        if(Gate::denies('edit-company',$company)){
             abort(403, 'You dont have permissions!!');
        }
        $categories = Category::all();
        return view('pages.edit-company', compact('category', 'categories','company',$company));
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
        Company::where('id', $company->id)->update($request->only(['company','code','vat','address','director','description','category_id']));
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
                'logo' =>$company[6],
                'user_id' => Auth::id(),
                'category_id' => $company[8]
            ]);

        }
        return redirect('/');
    }
}
// duomenu importas
