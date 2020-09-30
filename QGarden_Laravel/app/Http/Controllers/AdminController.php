<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    function __construct()
    {
        parent::__construct();

        $Dash = DB::table('Products') -> select("*") -> paginate(12);
        View::share('Dash', $Dash);

        $ProductList = DB::table('Products') -> select("*") -> paginate(12);
        View::share('ProductList', $ProductList);

        $CategoryList = DB::table('Category') -> select("*") -> paginate(12);
        View::share('CategoryList', $CategoryList);

        $BillList = DB::table('Bill') -> select("*") -> paginate(12);
        View::share('BillList', $BillList);
    }

    function Login()
    {
        return view('Admin.Login');
    }

    function Admin()
    {
        $TotalCategory=DB::table('Category')->count();
        $TotalProduct=DB::table('Products')->count();
        $TotalBill=DB::table('Bill')->count();

        return view('Admin.Index',['TotalCategory'=>$TotalCategory,'TotalProduct'=>$TotalProduct,'TotalBill'=>$TotalBill]);
    }

    function Product()
    {
        return view('Admin.Product');
    }

    function Category()
    {
        return view('Admin.Category');
    }

    function Bill()
    {
        return view('Admin.Bills');
    }

    function Create(Request $Data)
    {
        if ($Data -> Action == "Create")
        {
            switch ($Data -> Object)
            {
                case 'Product':
                    if (!empty($Data->ProductImageList))
                    {
                        $NameArr = array();

                        foreach ($Data->ProductImageList as $ImgInfo)
                        {
                            $Name = time() . '_' . $ImgInfo -> getClientOriginalName();
                            $ImgInfo -> move('Images/Products', $Name);

                            $NameArr[] = '/Products/' . $Name;
                        }

                        $NameArr = json_encode($NameArr);

                        DB::insert("INSERT INTO Products SET ProductName = ?, ProductCategoryID = ?, ProductPrice = ?, ProductDiscount = ?, ProductAvailable = ?, ProductImageList = ?", [$Data -> ProductName, $Data -> CategoryID, $Data -> ProductPrice, $Data -> ProductDiscount, $Data -> ProductAvailable, $NameArr]);

                        return redirect() -> back();
                    }

                    break;
                case 'Category':
                    if (!empty($Data->CategoryDefaultImage))
                    {
                        $NameCategory = time() . '_' . $Data -> CategoryDefaultImage -> getClientOriginalName();
                        $Data -> CategoryDefaultImage -> move('Images/Category', $NameCategory);
                        $CategoryImg = '/Category/' . $NameCategory;

                        DB::insert("INSERT INTO Category SET CategoryName = ?, CategoryDefaultImage = ?", [$Data -> CategoryName, $CategoryImg]);

                        return redirect() -> back();
                    }

                    break;
            }
        }
    }

    function Delete(Request $Data)
    {
        if ($Data -> Action == "Delete")
        {
            switch ($Data -> SubjectName)
            {
                case 'Category':
                    DB::delete('DELETE FROM Products WHERE ProductCategoryID = ?', [$Data -> SubjectID]);
                    DB::delete('DELETE FROM Category WHERE CategoryID = ?', [$Data -> SubjectID]);

                    return response('Success', 200);

                    break;
                case 'Product':
                    DB::delete('DELETE FROM Products WHERE ProductID = ?', [$Data -> SubjectID]);
                    return response('Success', 200);

                    break;

                case 'Bill':
                    DB::delete('DELETE FROM BillDetail WHERE BillID = ?', [$Data -> SubjectID]);
                    DB::delete('DELETE FROM Bill WHERE BillID = ?', [$Data -> SubjectID]);

                    return response('Success', 200);

                    break;
            }
        }
    }

}
