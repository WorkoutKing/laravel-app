<?php

namespace App\Http\Controllers;
use App\Models\Items;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Company;


use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['except'=>['showItems']]);
    }

    public function showItems(Request $request, Items $items){
        $itemsNames = Items::pluck('item_name')->toArray();
        $items = Items::paginate(10);
        return view('pages.show-items', compact('items', 'itemsNames', $items));
    }
    public function addItems(Company $company, Request $request){
        $companyId = Company::pluck('id','company')->toArray();
        return view('pages.add-items', compact('companyId'));
    }

    public function storeItems(Request $request){    
        Items::create([
            'user_id'=>Auth::id(),
            'company_id'=>$request->company,
            'item_name'=>request('item_name'),
            'description'=>request('description'),
            'price'=>request('price'),
            
        ]);
        return redirect('/show-items');
    }

    public function useritemlist(Request $request){
        $itemsNames = Items::pluck('item_name')->toArray();
        $items = Items::paginate(1000000);
        return view('pages.useritemslist', compact('items', 'itemsNames', $items));
    }
    
    public function usercompanylist(Request $request, Company $company){
        $company = Company::paginate(1000000);
        return view('pages.usercompanylist', compact($company,'company'));
    }

    public function dashboard(){
        return view('pages.dashboard');
    }

    public function storeUpdateItems(Items $items, Request $request){
        Items::where('id', $items->id)->update($request->only(['item_name','description','price']));
        return redirect('/show-items');
    }

    public function updateItems(Items $items, Company $company){
        $companyId = Company::pluck('id','company')->toArray();
        return view('pages.edit-item', compact('items','companyId'));
    }

    public function deleteItems(Items $items){
        $items->delete();
        return redirect('/show-items');
    }
}
