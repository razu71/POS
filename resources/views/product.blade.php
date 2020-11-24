@extends('master.master',['main_menu'=>'sell'])
@section('title',' Sell ')
@section('after-style')
    <link rel="stylesheet" href="{{asset('assets2/css/styles.css')}}">
@endsection
@section('content')
    <?php
    $total_price = 0;
    $total_qty = 0;
    $total_discount = 0;
    $temp_total=0;
    $temp_discount=0;
    $net_total_price =0;
    $net_vat=0;
    ?>
    <div class="row">
        <div class="cart-area mt-20 mb-80">
            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <div class="search-area">
                        <form class="search-wrap" method="post" action="{{route('productSearch')}}" id="search_button">
                            {{ csrf_field() }}
                            <input type="text" name="search" id="product_search" name="search" autocomplete="off" placeholder="Enter SKU/Scan Barcode"
                                   required>
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="cart-wrap">
                        <table class="table-responsive" id="product_table" width="100%">
                            <thead>
                            <tr>
                                <th class="product-name">Name</th>
                                <th class="product-cost">Unit Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-discountt">Discount</th>
                                <th class="product-totall">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                            </thead>

                            <tbody id="ajax_body">
                            @if(isset($products[0]))
                                @foreach($products as $p)
                                    <?php
                                    $temp_total = priceCalculation($p->price,$p->discount,$p->discount_type)*$cart[$p->id];
                                    $temp_discount = discountCalculation($p->price,$p->discount,$p->discount_type)*$cart[$p->id];
                                    $total_price =$total_price + $p->price*$cart[$p->id];
                                    $total_discount =$total_discount + $temp_discount;
                                    $total_qty = $total_qty +$cart[$p->id];
                                    ?>
                                    <tr>
                                        <td class="product-name"><a href="#">{{$p->title}}</a></td>
                                        <td class="product-cost">{{$p->price}}</td>
                                        <td class="product-quantity " id="quantity">
                                            <input type="number"  data-id="{{$p->id}}" data-price="{{$p->price}}" data-discount="{{discountCalculation($p->price,$p->discount,$p->discount_type)}}" class="form-control text-center qty" value="{{$cart[$p->id]}}" min="1" style="padding: 0px 0px">
                                        </td>
                                        <td class="product-discount d_{{$p->id}}">{{$temp_discount}}</td>
                                        <td class="product-total t_{{$p->id}}">{{$temp_total}}</td>
                                        <td class="product-remove"><a href="{{route('removeFromCart',$p->id)}}" class="fa fa-times"></a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php

                if(!empty($total_price)){
                    $net_vat = (($total_price-$total_discount)*allsetting()['vat'])/100;
                    $net_total_price = ($total_price-$total_discount)+$net_vat;
                }
                ?>
                <div class="col-md-4 col-lg-3">
                    {!! Form::open(['url' => 'saveOrder', 'id' => "mainBody"]) !!}
                    <input type="hidden" name="total_price" value="{{$net_total_price}}">
                    <input type="hidden" name="total_quantity" value="{{$total_qty}}">
                    <input type="hidden" name="total_discount" value="{{$total_discount}}">
                    <ul class="cart-total-wrap" id="subTotal">
                        <li>Subtotal <span class="pull-right " id="total_price"><span id="total_price_span">{{$total_price}}</span> {{allsetting()['currency']}}</span></li>
                        <li>Quantity <span class="pull-right total_qty" id="total_qty">{{$total_qty}}</span></li>
                        <li>Discount <span class="pull-right" id="total_discount"><span id="total_discount_span">{{$total_discount}}</span> {{allsetting()['currency']}}</span></li>
                        <li>Net Total <span class="pull-right" id="discounted_total"><span id="discounted_total_span">{{$total_price - $total_discount}}</span> {{allsetting()['currency']}}</span></li>

                        <li>Vat<small> ({{allsetting()['vat']}}%)</small> <span class="pull-right" id="net_vat"><span id="t_vat">{{$net_vat}}</span> {{allsetting()['currency']}}</span></li>

                        <li class="total">Total <span class="pull-right total_sum" id="net_total_price"><span id="total_sum">{{$net_total_price}}</span> {{allsetting()['currency']}}</span></li>
                        Payment Method:
                        <select class="form-control" name="payment_type" id="payment_type">
                            {{--<option> select payment</option>--}}
                            <option value="Cash"> Cash</option>
                            <option value="Card"> Card</option>
                        </select>
                        <label for="">Given Payment:</label>
                        <input class="form-control" autocomplete="off" id="given_payment" type="text" name="given_payment">
                        <label for="">Change:</label>
                        <input type="text" autocomplete="off" class="form-control" id="return_cash" name="return_cash">
                    </ul>
                    <ul class="cart-total-wrap" id="cart-clear_all">
                        <li><button type="submit" name="shopping"  id="cart"> Cart</button></li>
                        <li><a class="btn btn-danger" href="{{ route('cartClear') }}">Clear All</a></li>
                    </ul>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        function printDiv(divName) {

            var printContents = document.getElementById(divName).innerHTML;
            w=window.open();
            w.document.write(printContents);
            w.print();
            w.close();
        }
        $(document.body).on('input','.qty',function () {
            var product_id = $(this).data('id');
            var product_price = $(this).data('price');
            var product_discount = $(this).data('discount');
            var qty = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('updateCart') }}",
                data: {'p_id':product_id,'qty':qty},
                success: function (data) {},
                error: function (data) {alert("Error")}
            });

            var t_price=0;
            var t_discount=$('#total_discount_span').text()?parseFloat($('#total_discount_span').text()):0;
            var net_price=0;
            var final_price=0;
            var total_qty=0;
            var test=0;
            // set price for the product
            $('.t_'+product_id).text(qty*product_price);
            $('.d_'+product_id).text(qty*product_discount);

            $(".product-total").map(function() {
                t_price +=parseFloat($(this).text());
            });
            $(".qty").map(function() {
                total_qty +=parseFloat($(this).val());
            });
            $(".product-discount").map(function() {
                test +=parseFloat($(this).text());
            });
            console.log(test);
            net_price=t_price-test;
            var vat= t_price*{{allsetting()['vat']}}/100;
            final_price=net_price+vat;
            $('#t_vat').html(vat);
            $('#total_qty').html(total_qty);
            $('#total_price_span').html(t_price);
            $('#discounted_total_span').html(net_price);
            $('#total_sum').html(final_price);
            $('#total_discount_span').html(test);
            $('input[name=total_quantity]').val(total_qty);
            $('input[name=total_price]').val(final_price);
            $('input[name=total_discount]').val(test);
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#mainBody").on('submit',function (event) {
                var given = $('#given_payment').val()?$('#given_payment').val():0;
                var t_sum = $('#total_sum').text()?$('#total_sum').text():0;
                if(given==0){
                    toastr.warning('Given amount must not be empty.');
                }
                if(parseFloat(t_sum)==0 || parseFloat(given)<parseFloat(t_sum)){
                    toastr.warning('Given amount must be greater than total balance.');
                    event.preventDefault();
                }
            });
        });
        $(document).ready(function () {
            $("#cart").on('click',function (event) {
                var given = $('#given_payment').val()?$('#given_payment').val():0;
                var t_sum = $('#total_sum').text()?$('#total_sum').text():0;
                console.log(given,t_sum);
                if(given==0){
                    toastr.warning('Given amount must not be empty.');
                }
                if(parseFloat(t_sum)==0 || parseFloat(given)<parseFloat(t_sum)){
                    toastr.warning('Given amount must be greater than total balance.');
                    event.preventDefault();
                }
            });
        });
        $(document).ready(function () {
            $('#given_payment').on('input', function (s) {
                var given = $('#given_payment').val()?$('#given_payment').val():0;
                var t_sum = $('#total_sum').text()?$('#total_sum').text():0;
                var change=parseFloat(given)-parseFloat(t_sum);
                if(parseFloat(given)<parseFloat(t_sum)){
                    change=0;
                    $('#cart').attr('readonly',true);
                }else{
                    $('#cart').attr('readonly',false);
                }
                $('#return_cash').val(change);
            });
        });
    </script>
@endsection
