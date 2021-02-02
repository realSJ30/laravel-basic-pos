<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_menu;
use App\Models\tbl_category;
use Illuminate\Support\Facades\DB;  

class MenusController extends Controller
{
    //
    // index
    public function index(){
        // dd($tbl_menu->all());
        
        $menus = DB::table('tbl_menus')//get data from table tbl_menu
                ->select('tbl_menus.*','tbl_categories.CategoryName')
                ->join('tbl_categories','tbl_categories.CategoryID','=','tbl_menus.CategoryID')                
                ->where('tbl_menus.isActive',1)
                ->orderBy('created_at','desc')
                ->get();

        // $categories = tbl_category::withCount(['menu'])->where('CategoryID','2')->get();  //get data from table tbl_menu
        $menuCount = tbl_menu::all();
        $categories = tbl_category::all();
        $menuID = tbl_menu::orderBy('MenuID','desc')->get();
        // foreach ($menuIDs as $menuid) {
        //     # code...
        //     dd($menuid->MenuID);
        // }
        // dd($menuID->MenuID);
        $categoriesActive = tbl_category::get()->where('isActive',true);             

        // $categorycounts = tbl_category::withCount(['tbl_menu'])->get();
                            


        return view('dashboard', compact('menus','menuID','categories','categoriesActive','menuCount'));
    }

    // create
    public function create(){
        $menus = DB::table('tbl_menus')//get data from table tbl_menu
                ->select('tbl_menus.*','tbl_categories.CategoryName')
                ->join('tbl_categories','tbl_categories.CategoryID','=','tbl_menus.CategoryID')
                ->orderBy('created_at','desc')
                ->get();
        
        $menuID = tbl_menu::orderBy('MenuID','desc')->get();
        // foreach ($menuIDs as $menuid) {
        //     # code...
        //     dd($menuid->MenuID);
        // }
        // dd($menuID->MenuID);
        $categories = tbl_category::get()->where('isActive',true);        

        return view('/menu/create', compact('menus','categories','menuID'));
    }

    public function store(){
        // dd(request('categoryid'));
        $data = request()->validate([
            'menuname' => 'required|unique:tbl_menus',
            'menudescription' => 'required',    //types of validation
            'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'categoryid' => 'required',
            'isactive' => ''
            //'another field' => '', //if inani is walay validation kelangan tapos maapil og pasa ang data
        ]);

        // if($validator->fails()) {
        //     return Redirect::back()->withInput()->withErrors($validator);
        // }
        
        tbl_menu::create(
            [
                'MenuName' => $data['menuname'],
                'MenuDescription' => $data['menudescription'],
                'MenuPrice' => $data['price'],
                'CategoryID' => $data['categoryid'],
                'isActive' => $data['isactive']
            ]
            );                        
        return redirect('/')->withInput();
    }    

    public function update($MenuID){
        $menu = tbl_menu::findOrFail($MenuID);
        $data = request()->validate([
            'MenuID' => '',
            'MenuName' => 'required|unique:tbl_menus,MenuName,'. $menu->MenuID.',MenuID',
            'MenuDescription' => 'required',    //types of validation
            'MenuPrice' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'CategoryID' => 'required',
            'isActive' => ''
            //'another field' => '', //if inani is walay validation kelangan tapos maapil og pasa ang data
        ]);
        // dd(request('MenuName'));
        
        // dd($menu);

        
        $menu->MenuName = request('MenuName');
        $menu->MenuDescription = request('MenuDescription');
        $menu->MenuPrice = request('MenuPrice');
        $menu->CategoryID = request('CategoryID');
        $menu->isActive = request('isActive');
        // dd($menu);
        // $ups = 'ups';
        
        $menu->save();

        return redirect('menu/create')->withInput();
        // return Redirect::route('menu/create, $ups')->with( ['data' => $data] );
    }
    public function destroy($MenuID){
        tbl_menu::destroy($MenuID);
        return redirect('/');
    }

    
    
}
