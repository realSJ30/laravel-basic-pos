<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_menu;

class tbl_category extends Model
{
    use HasFactory;

    protected $primaryKey = 'CategoryID';
    protected $fillable = ['CategoryName','isActive','created_at','updated_at'];
    
    public function menu(){
        return $this->hasMany(tbl_menu::class,'MenuID');
    }

    

}
