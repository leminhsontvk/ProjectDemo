@extends('Layout.Admin')
@section('AdminView')
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Danh mục sản phẩm
            </h2>
        </div>
        <form enctype="multipart/form-data" method="POST" action="/Admin/Product/Create" class="margin-bottom-20">
            @csrf
            <input type="hidden" name="Action" value="Create">
            <input type="hidden" name="Object" value="Product">
            <div class="form-mid-box margin-bottom-20">
                <label for="ProductName">
                    Tên sản phẩm
                </label>
                <input type="text" value="" id="ProductName" name="ProductName">
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="CategoryName">
                    Danh mục
                </label>
                <select name="CategoryID" id="CategoryName">
                    @foreach($Menu AS $MenuInfo)
                        <option value="{{$MenuInfo -> CategoryID}}">{{$MenuInfo -> CategoryName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="ProductPrice">
                    Giá sản phẩm
                </label>
                <input type="text" value="" id="ProductPrice" name="ProductPrice">
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="ProductDiscount">
                    Giảm giá (%)
                </label>
                <input type="text" value="" id="ProductDiscount" name="ProductDiscount">
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="ProductAvailable">
                    Còn trong kho
                </label>
                <input type="text" value="" id="ProductAvailable" name="ProductAvailable">
            </div>
            <div class="form-mid-box margin-bottom-20">
                <label for="btn-avatar">
                    Danh sách ảnh sản phẩm
                </label>
                <button id="btn-category-image" class="btn-upload">Chọn Ảnh Mới</button>
                <input id="input-category-image" type="file" accept="image/*" style="display: none" name="ProductImageList[]" multiple max="4">
            </div>
            <button type="submit" style="margin-right: 10px;" class="checkout-btn">Thêm</button>
            <div class="clearfix"></div>
        </form>
        <div class="cart-table margin-bottom-20">
            <table class="table">
                <thead>
                <tr>
                    <th class="pro-title">STT</th>
                    <th class="pro-title">Ảnh mô tả</th>
                    <th class="pro-title">Tên sản phẩm</th>
                    <th class="pro-title">Danh mục</th>
                    <th class="pro-title">Giá</th>
                    <th class="pro-title">Giảm giá (%)</th>
                    <th class="pro-title">Tồn Kho</th>
                    <th class="product-title">Thao tác</th>
                </tr>
                </thead>
                <tbody>
@foreach($ProductList as $Product)

    <tr>
        <td class="pro-title">
            <span>{{$Product->ProductID}}</span>
        </td>
        <td class="pro-thumbnail">
            <a>
                @php
                $Img = json_decode($Product -> ProductImageList, true);
                @endphp
                <img src="{{asset('/Images'.$Img['0'])}}" alt="Product">
            </a>
        </td>
        <td class="pro-subtotal">
            <span>{{$Product->ProductName}}</span>
        </td>
        <td class="pro-title">
            <span>{{$Product->ProductCategoryID}}</span>
        </td>
        <td class="pro-title">
            <span>{{$Product->ProductTotalRate}}</span>
        </td>
        <td class="pro-title">
            <span>{{$Product->ProductDiscount}}</span>
        </td>
        <td class="pro-title">
            <span>{{$Product->ProductAvailable}}</span>
        </td>
        <td class="pro-action">
            <form id="DeleteForm" action="/Admin/Remove" method="POST" style="display: none">
                @csrf
                <input type="hidden" name="Action" value="Delete">
                <input type="hidden" value="Product" name="SubjectName">
                <input type="hidden" value="{{$Product -> ProductID}}" name="SubjectID">
            </form>
            <a class="a-danger" id="DeleteCategory" value="1">
                <i class="fal fa-trash-alt"></i>
            </a>
            <tab></tab>
            <a id="EditCategory" value="1">
                <i class="fal fa-edit"></i>
            </a>
        </td>
    </tr>
@endforeach


                </tbody>
            </table>
        </div>
    </div>
    {{$ProductList -> links()}}
@endsection
