@extends('Layout.Admin')
@section('AdminView')
    <div class="cart-table-container margin-top-40">
        <div class="title margin-bottom-20">
            <h2>
                Danh Sách Hóa Đơn
            </h2>
        </div>
        <div class="cart-table margin-bottom-20">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th class="pro-title">Mã Đơn Hàng</th>
                    <th>Người nhận</th>
                    <th>Ngày tạo đơn</th>
                    <th>Trạng Thái</th>
                    <th>Tổng Tiền</th>
                    <th>Xem chi tiết</th>
                    <th>Thao Tác</th>
                </tr>
                </thead>
                @foreach($BillList as $Bill)
                    <tr>
                        <td class="pro-title">
                            <span>{{$Bill->BillID}}</span>
                        </td>
                        <td class="pro-subtotal">
                            <span>{{$Bill->UserMail}}</span>
                        </td>
                        <td class="pro-subtotal">
                            <span>{{$Bill->BillCreateDate}}</span>
                        </td>
                        <td class="pro-title">
                            <span>{{$Bill->BillStatus}}</span>
                        </td>
                        <td class="pro-title">
                            <span>{{$Bill->BillTotalCost}}</span>
                        </td>
                        <td class="pro-subtotal">
                            <a href="#">View</a>
                        </td>
                        <td class="pro-action">
                            <form id="DeleteForm" action="/Admin/Remove" method="POST" style="display: none">
                                @csrf
                                <input type="hidden" name="Action" value="Delete">
                                <input type="hidden" value="Bill" name="SubjectName">
                                <input type="hidden" value="{{$Bill -> BillID}}" name="SubjectID">
                            </form>
                            <a class="a-danger" id="DeleteCategory" value="1">
                                <i class="fal fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

