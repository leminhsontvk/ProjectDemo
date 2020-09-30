<?php

namespace App\Http\Controllers;

use App\Catagory;
use App\Products;

use Illuminate\Support\Facades\DB;

class Product extends Controller
{
    function GetProduct()
    {
        $ListCategory = Catagory::all();
        return view('home',['ListCategory' => $ListCategory]);
    }
    function ProductDetail($id)
    {
        $ListCategory = Catagory::all();

        $ProductDetail = Products::where('ProductID',$id)->select('*')->get();
        return view('Product.ProductDetail',['ListCategory' => $ListCategory],['ProductDetail' => $ProductDetail]);
    }
}
