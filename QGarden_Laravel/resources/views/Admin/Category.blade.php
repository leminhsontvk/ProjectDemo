@extends('Layout.Admin')
@section('AdminView')
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Danh mục sản phẩm
            </h2>
        </div>
        <form class=" margin-bottom-20" enctype="multipart/form-data" method="post" action="/Admin/Category/Create">
            @csrf
            <input type="hidden" name="Action" value="Create">
            <input type="hidden" name="Object" value="Category">
            <input type="hidden" value="" id="EditID">
            <div class="form-mid-box margin-bottom-20">
                <label id="category-edit" for="CategoryName">
                    Tên Danh Mục
                </label>
                <input type="text" value="" id="CategoryName" name="CategoryName">
            </div>
            <div class="form-mid-box form-mid-box-right margin-bottom-20">
                <label for="btn-avatar">
                    Ảnh Đại Diện Danh Mục
                </label>
                <button id="btn-category-image" class="btn-upload">Chọn Ảnh Mới</button>
                <input id="input-category-image" type="file" accept="image/*" style="display: none" name="CategoryDefaultImage">
            </div>
            <button class="checkout-btn" type="submit">Thêm</button>
            <div class="clearfix"></div>
        </form>
        <div class="cart-table margin-bottom-20">
            <table class="table">
                <thead>
                <tr>
                    <th class="pro-title">STT</th>
                    <th class="pro-title">Ảnh mô tả</th>
                    <th class="pro-title">Tên danh mục</th>
                    <th class="pro-title">Số sản phẩm</th>
                    <th class="pro-title">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($CategoryList as $CaList)
                    <tr>
                        <td class="pro-title">
                            <span>{{$CaList->CategoryID}}</span>
                        </td>
                        <td style="max-height: 130px!important;" class="pro-thumbnail">
                            <a style="max-height: 130px!important;" >
                                <img style="max-height: 130px!important; max-width: 130px!important;" src="{{asset('/Images'.$CaList -> CategoryDefaultImage)}}" alt="Product">
                            </a>
                        </td>
                        <td class="pro-subtotal">
                            <span>{{$CaList->CategoryName}}</span>
                        </td>
                        <td class="pro-title">
                            <span>{{$CaList->CategoryTotalProduct}}</span>
                        </td>
                        <td id="category-action" class="pro-action">
                            <form id="DeleteForm" action="/Admin/Remove" method="POST" style="display: none">
                                @csrf
                                    <input type="hidden" name="Action" value="Delete">
                                <input type="hidden" value="Category" name="SubjectName">
                                <input type="hidden" value="{{$CaList -> CategoryID}}" name="SubjectID">
                            </form>
                            <a id="DeleteCategory" value="1">
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
@endsection
