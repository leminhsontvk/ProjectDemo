@extends('Layout.Admin')
@section('AdminView')
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Dashboard
            </h2>
        </div>
        <div class="cart-table margin-bottom-20">
            <table class="table">
                <thead>
                <tr>
                    <th class="pro-thumbnail">STT</th>
                    <th class="pro-title">Mô tả</th>
                    <th class="pro-price">Chi tiết</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td class="pro-title">
                        <span>1</span>
                    </td>
                    <td class="pro-title">
                        <span>Tổng số danh mục</span>
                    </td>
                    <td class="pro-title">
                            <span>{{$TotalCategory}}</span>
                    </td>
                </tr>

                <tr>
                    <td class="pro-title">
                        <span>2</span>
                    </td>
                    <td class="pro-title">
                        <span>Tổng số sản phẩm</span>
                    </td>
                    <td class="pro-title">
                        <span>{{$TotalProduct}}</span>
                    </td>
                </tr>

                <tr>
                    <td class="pro-title">
                        <span>3</span>
                    </td>
                    <td class="pro-title">
                        <span>Tổng số hóa đơn</span>
                    </td>
                    <td class="pro-title">
                        <span>{{$TotalBill}}</span>
                    </td>
                </tr>

{{--                <tr>--}}
{{--                    <td class="pro-title">--}}
{{--                        <span>4</span>--}}
{{--                    </td>--}}
{{--                    <td class="pro-title">--}}
{{--                        <span>Tổng số khách hàng</span>--}}
{{--                    </td>--}}
{{--                    <td class="pro-title">--}}
{{--                        <span>6</span>--}}
{{--                    </td>--}}
{{--                </tr>--}}

{{--                <tr>--}}
{{--                    <td class="pro-title">--}}
{{--                        <span>5</span>--}}
{{--                    </td>--}}
{{--                    <td class="pro-title">--}}
{{--                        <span>Tổng thu trong tháng</span>--}}
{{--                    </td>--}}
{{--                    <td class="pro-title">--}}
{{--                        <span>6</span>--}}
{{--                    </td>--}}
{{--                </tr>--}}

                </tbody>
            </table>
        </div>
    </div>
@endsection
