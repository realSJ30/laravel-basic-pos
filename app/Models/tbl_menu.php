<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tbl_category;

class tbl_menu extends Model
{
    use HasFactory;
    protected $primaryKey = 'MenuID';
    protected $fillable = ['MenuName','MenuDescription','MenuPrice','CategoryID','isActive','created_at','updated_at'];

    public function category(){
        return $this->hasOne(tbl_category::class,'CategoryID');
    }

    

}
