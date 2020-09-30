<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catagory;

use Illuminate\Support\Facades\DB;

class home extends Controller
{
    function index()
    {
        $ProductList = DB::select("SELECT * FROM Products LIMIT 10");
        $DiscountProduct = DB::select("SELECT * FROM Products WHERE ProductDiscount > 0 LIMIT 16");

        return view('home', ['ProductList' => $ProductList, 'ProductDiscount' => $DiscountProduct]);
    }

    function ShowCart()
    {
        return view('Cart');
    }

}
