<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_menu;
use App\Models\tbl_category;
use Illuminate\Support\Facades\DB;  
class CategoriesController extends Controller
{
    //
    // create
    public function index(){
        $categories = tbl_category::all();
        return view('category.show',compact('categories'));
    }
    public function create(){
        $categoryID = tbl_category::orderBy('CategoryID','desc')->get();


        return view('category.create',compact('categoryID'));
    }

    
    public function edit($categoryID){

        $category = tbl_category::findOrFail($categoryID);
        // dd($categoryID);
        



        return view('category.edit',compact('category'));
    }

    public function store(){
        // dd(request('categoryid'));
        $data = request()->validate([
            'CategoryName' => 'required|unique:tbl_categories',            
            'isactive' => ''
            //'another field' => '', //if inani is walay validation kelangan tapos maapil og pasa ang data
        ]);

        
        
        tbl_category::create(
            [
                'CategoryName' => $data['CategoryName'],                
                'isActive' => $data['isactive']
            ]
        );

        return redirect('/category/show');
    }


    public function update($CategoryID){
        $category = tbl_category::findOrFail($CategoryID);
        $data = request()->validate([
            'CategoryID' => '',
            'CategoryName' => 'required|unique:tbl_categories,CategoryName,'. $category->CategoryID.',CategoryID',            
            'isActive' => ''
            //'another field' => '', //if inani is walay validation kelangan tapos maapil og pasa ang data
        ]);        
        $category->CategoryName = request('CategoryName');                
        $category->isActive = request('isActive');
        // dd($menu);
        // $ups = 'ups';
        
        $category->save();

        return redirect('category/show');
        // return Redirect::route('menu/create, $ups')->with( ['data' => $data] );
    }
    public function destroy($CategoryID){

        $menu = DB::table('tbl_menus')->where('CategoryID',$CategoryID);
        // dd($menu->get()->count());
        if($menu->get()->count() == 0){
            tbl_category::destroy($CategoryID);
            return redirect('category/show');
        }else{
            return redirect()->back()->with('alert','Cannot Delete Category!');
        }

        
    }


}
