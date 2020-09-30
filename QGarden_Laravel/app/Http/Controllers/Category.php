<?php

namespace App\Http\Controllers;

use App\Catagory;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Category extends Controller
{
    function GetCategory()
    {
        $ListCategory = Catagory::all();

        return view('home',['ListCategory' => $ListCategory]);
    }
    function ListCategory($id = NULL)
    {
        $ListCategory = Catagory::all();

        $TotalProduct = 1;

        if ($id != NULL)
        {
            $Product = Products::where('ProductCategoryID',$id)->paginate(6);
            $TotalProduct = DB::select('SELECT CategoryTotalProduct FROM Category, Products WHERE ProductCategoryID = CategoryID AND CategoryID = ?', [$id]);

            $TotalProduct = $TotalProduct['0'] -> CategoryTotalProduct;
        }
        else
            $Product = Products::paginate(6);

        return view('Product.Products',['ListCategory' => $ListCategory, 'Product' => $Product, 'Total' => $TotalProduct]);
    }
    function Search(Request $Request)
    {
        $Keyword = $Request-> Key;

        $SearchBlade = '';
        $KeyArr = $Request -> toArray();

        unset($KeyArr['page']);

        foreach ($KeyArr AS $KeyName => $KeyValue)
        {
            $SearchBlade = '&'.$KeyName.'='.$KeyValue;
        }

        $ListCategory = Catagory::all();
        $SearchProduct = DB::table('Products')->where('ProductName', 'like' , '%' .$Keyword. '%')->paginate(6);

        return view('Product.ProductSearch',['ListCategory' => $ListCategory ,'SearchMeta' => $SearchBlade, 'SearchProduct' => $SearchProduct ]);
    }
}
