<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function index()
    {
    $user=Auth::user();
    if ($user->hasRole('admin')){
     $categories = Category::all();
        return $categories;
    }
    else
    {
     return "sory you are expired";
    }
    }
    public function show($id)
    {
    $category = Category::find($id);
    if (isset($category)) {
      return $category; 

    }
    }
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return $category;

      

    }
   
    public function update(Request $request , $id)
    {
    $category = Category::where('id' , $id)->first();
    if (isset($category))
    {
        if (isset($request->name)){
        $category->name = $request->name;}
        $category->save();
       return $category;
       

    }
   

    }
    public function destroy($id)
    {
         $category = Category::find($id);
         $category->delete();
         
 

}
}

