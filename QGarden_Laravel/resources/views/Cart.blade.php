@extends('Layout.Layout')
@section('content')

<div class="container">
    <section class="QGCart margin-top-40">
        <div class="cart-table-container">
            <div class="cart-table margin-bottom-40">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="pro-thumbnail">Image</th>
                        <th class="pro-title">Product</th>
                        <th class="pro-price">Price</th>
                        <th class="pro-quantity">Quantity</th>
                        <th class="pro-subtotal">Total</th>
                        <th class="pro-remove">Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="pro-thumbnail">
                            <a href="#">
                                <img src="{{asset('Images/Products/Product1.jpg')}}" alt="Product">
                            </a>
                        </td>
                        <td class="pro-title">
                            <a href="#">Xương Rồng Đá</a>
                        </td>
                        <td class="pro-price">
                            <span id="pro-price" qgdata="500000">VNĐ 500.000</span>
                        </td>
                        <td class="pro-quantity">
                            <div class="pro-qty">
                                <input type="text" id="cart-qty-value" value="1">
                                <a id="cart-qty-inc" class="inc qty-btn">+</a>
                                <a id="cart-qty-dec" class="dec qty-btn">-</a>
                            </div>
                        </td>
                        <td class="pro-subtotal">
                            <span id="total-price" qgdata="500000">VNĐ 500.000</span>
                        </td>
                        <td class="pro-remove">
                            <a href="#">
                                <i class="fal fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="pro-thumbnail">
                            <a href="#">
                                <img src="{{asset('Images/Products/Product1.jpg')}}" alt="Product">
                            </a>
                        </td>
                        <td class="pro-title">
                            <a href="#">Xương Rồng Đá</a>
                        </td>
                        <td class="pro-price">
                            <span id="pro-price" qgdata="500000">VNĐ 500.000</span>
                        </td>
                        <td class="pro-quantity">
                            <div class="pro-qty">
                                <input type="text" id="qty-value" value="1">
                                <a href="#" id="qty-inc" class="inc qty-btn">+</a>
                                <a href="#" id="qty-dec" class="dec qty-btn">-</a>
                            </div>
                        </td>
                        <td class="pro-subtotal">
                            <span id="total-price" qgdata="500000">VNĐ 500.000</span>
                        </td>
                        <td class="pro-remove">
                            <a href="#">
                                <i class="fal fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="pro-thumbnail">
                            <a href="#">
                                <img src="{{asset('Images/Products/Product1.jpg')}}" alt="Product">
                            </a>
                        </td>
                        <td class="pro-title">
                            <a href="#">Xương Rồng Đá</a>
                        </td>
                        <td class="pro-price">
                            <span id="pro-price" qgdata="500000">VNĐ 500.000</span>
                        </td>
                        <td class="pro-quantity">
                            <div class="pro-qty">
                                <input type="text" id="qty-value" value="1">
                                <a href="#" id="qty-inc" class="inc qty-btn">+</a>
                                <a href="#" id="qty-dec" class="dec qty-btn">-</a>
                            </div>
                        </td>
                        <td class="pro-subtotal">
                            <span id="total-price" qgdata="500000">VNĐ 500.000</span>
                        </td>
                        <td class="pro-remove">
                            <a href="#">
                                <i class="fal fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="cart-summary">
            <div class="cart-summary-content">
                <h4>Cart Summary</h4>
                <p>Sub Total <span>VNĐ 1.500.000</span></p>
                <p>Shipping Cost <span>$00.00</span></p>
                <form>
                    <input type="text" placeholder="Coupon Code">
                    <button type="submit">Apply Code</button>
                </form>
                <h2>Grand Total <span>VNĐ 1.500.000</span></h2>
            </div>
            <div class="cart-summary-button">
                <button class="checkout-btn">Checkout</button>
                <button class="update-btn">Update Cart</button>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
</div>
    @endsection
