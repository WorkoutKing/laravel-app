<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['company', 'code', 'vat','address','director','description','logo','user_id','category_id'];
    
public function user(){
    return $this->belongsTo(User::class);
}
public function comments(){
    return $this->hasMany(Comment::class);
}

public function category() {
    return $this->belongsTo(Category::class);
}

}
