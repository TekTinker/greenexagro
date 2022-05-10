@extends('templates.cart')

@section('cart')
    <div class="col-md-10 col-md-offset-1" style="font-family: 'Raleway', sans-serif; padding: 30px">

        @if(count($cart_items))

            <div class="table-responsive" style="">
                <table class="table">
                    <form action="{{ route('user.checkout', ['action' => 'checkout'] ) }}" method="post" role="form">

                        <tr>
                            <th style="width: 30%">Product name</th>
                            <th style="width: 10%">Package</th>
                            <th style="width: 10%">Quantity</th>
                            <th style="width: 10%">Price per unit</th>
                            <th style="width: 10%">Total</th>
                            <th style="width: 10%">Action</th>
                        </tr>

                        @foreach( $cart_items as $item)
                            <tr>
                                <input type="hidden" name="package_id[]" value="{{ $item->package_id }}"/>
                                <td class="product-name">{{ $item->product_name }}</td>
                                <td class="product-package">{{ $item->package }}</td>
                                <td class="product-quantity" style="display: flex">
                                    <button type="button" class="updateQuantity">+</button>
                                    <input name="quantity[]" type="text" size="2" value="{{$item->quantity}}"/>
                                    <button type="button" class="updateQuantity">-</button>
                                </td>
                                <td class="unit-price">{{ $item->price }}</td>
                                <td class="total-price">{{ $item->price * $item->quantity}}</td>
                                <td>
                                    <button type="button" class="product-delete btn btn-danger">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">
                                <div style="font-size: large; font-weight: 800;text-align: right">
                                    <div class="grand-total">0</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: center;">
                                <input type='hidden' id='cart_updateButton' class='btn btn-default'
                                       formaction="{{ route('user.checkout', ['action' => 'update'])}}"
                                       value="Update Cart" style="margin: 20px"/>
                                <input type='hidden' id='cart_cancelButton' class='btn btn-warning'
                                       value="Cancel" style="margin: 20px"/>
                                <input type="submit" id='cart_checkoutButton' class="btn"
                                       style="background-color: #449d44"
                                       formaction="{{ route('user.checkout', ['action' => 'checkout'] )}}"
                                       value="Checkout" style="margin: 20px"/>
                            </td>
                        </tr>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                </table>
            </div>

        @else

            <div class="product-wid-title" style="text-align: center">
                Cart Empty
            </div>

        @endif

    </div>

    <script type="application/javascript">
        $(document).ready(function () {

            var total = 0;

            var count = parseInt($("#main-cart-count").text());

            $(".total-price").each(function () {
                total += parseInt($(this).text());
            });

            $(".grand-total").html(" Total :   <i class='fa fa-inr'></i> " + total);

            $('#cart_cancelButton').on("click", function () {
                location.reload();
            });

            $('.updateQuantity, .product-delete').on("click", function () {

                $this = $(this);
                var unitPrice = parseInt($this.parents("tr").find(".unit-price").text());

                switch ($this.text()) {
                    case "+":
                        currentVal = parseInt($this.parents("tr").find("input[type='text']").val());
                        newVal = currentVal + 1;
                        $this.parents("tr").find("input[type='text']").val(newVal);

                        $this.parents("tr").find(".total-price").text(unitPrice * newVal);

                        count += 1;

                        break;

                    case "-":

                        currentVal = parseInt($this.parents("tr").find("input[type='text']").val());

                        if (currentVal == 1) {
                            break;
                        }

                        newVal = currentVal - 1;
                        $this.parents("tr").find("input[type='text']").val(newVal);

                        $this.parents("tr").find(".total-price").text(unitPrice * newVal);

                        count -= 1;

                        break;

                    case "Remove":
                        $this.parents("tr").remove();
                        count -= parseInt($this.parents("tr").find("input[type='text']").val());

                        break;

                }

                $("#cart_cancelButton").attr('type', 'button');

                $("#cart_updateButton").attr('type', 'submit');

                $("#main-cart-count").text(count);

                //sum all total cols
                var total = 0;
                $(".total-price").each(function () {
                    total += parseInt($(this).text());
                });

                $("#main-cart-amount").text(total);

                $(".grand-total").html("Total :   <i class='fa fa-inr'></i> " + total);

                if(total == 0){
                    $("#cart_checkoutButton").hide();
                }

            });
        });


    </script>
@stop