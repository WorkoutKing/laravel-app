<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Company;

class Items extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','company_id','item_name','description','price'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
}


