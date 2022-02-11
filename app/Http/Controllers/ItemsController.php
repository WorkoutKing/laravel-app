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

    public function showItems(Request $request, Company $company){
        $itemsNames = Items::pluck('item_name')->toArray();
        if( $request->input()){
            $items = Items::when($request->date, function($query, $date){
                return $query->orderBy('created_at', $date);
            })->paginate(10);
        } else {
            $items = Items::whereDate('created_at', Carbon::today()->toDateString())->paginate(10);
        }
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
}
