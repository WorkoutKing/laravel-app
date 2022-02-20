<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Items;
use App\Models\Shopinghistory;
use App\Models\User;

class ShopinghistoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function showShopingHistory(Request $request, User $user){
        $shopinghistory = Shopinghistory::paginate(15);
        return view('pages.shoping-history', compact('shopinghistory',$user));
    }

    public function addShoping(Company $company, Request $request, Items $items){
        $companyId = Company::pluck('id','company')->toArray();
        return view('pages.shopingcheck', compact('companyId','items'));
    }
    public function storeShoping(Request $request){    
        Shopinghistory::create([
            'user_id'=>Auth::id(),
            'company_id'=>$request->company,
            'item_name'=>request('item_name'),
            'description'=>request('description'),
            'price'=>request('price'),
            
        ]);
        return redirect('/');
    }
}
