<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Modernizr Js -->
    <script src="vendors/modernizr-js/modernizr.js"></script>

    <style>

        a.invoice-btn {
            color: #fff;
            background: #28A745;
            padding: 10px 15px;
            font-size: 14px;
            text-align: center;
            text-transform: uppercase;
            font-weight: 700;
            margin-left: 15px;
            border-radius: 3px;
        }

        a.invoice-btn:first-child {
            margin-left: 0;
        }

    </style>
</head>

<body>


<?php
$products = Session::get('products');
$cart = Session::get('cart');
$order_no = Session::get('order_no');
$invoice_date = Session::get('invoice_date');
$total_price = 0;
$total_qty = 0;
$total_discount = 0;
$temp_total = 0;
$temp_discount = 0;
$net_total_price = 0;
$net_vat = 0;
?>

<div class="page-wrapper">
    <!--================= End left sidebar section =================-->
    <div class="main-wrapper">
        <div class="container">
            <!-- Start invoice -->
            <div class="invoice ">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-area" id="invoice-area" style="background: #eee;padding: 15px;border-radius: 5px;margin-bottom: 30px;">
                            <div class="top" style="padding: 15px;font-size: 16px;font-weight: 700;line-height: 35px;margin-bottom: 30px;border: 1px solid rgba(0, 0, 0, 0.1);">
                                <div class="row">
                                    <div class="left col-md-6">
                                        <span style="display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-orient: vertical; -webkit-box-direction: normal; -ms-flex-direction: column;  flex-direction: column; -webkit-box-pack: center; -ms-flex-pack: justify-content: center;">ID : #{{$order_no}}</span>
                                    </div>
                                    <div class="right col-md-6 text-md-right">
                                        <ul style="list-style: none;margin: 0;padding: 0">
                                            <li>Invoice Date : {{$invoice_date}}</li>
                                            {{--<li>Due Date : sat 18 | 07 | 2018</li>--}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-table table-responsive">
                                <table class="table-responsive" id="product_table" width="100%">
                                    <thead>
                                    <tr>
                                        <th style="border: 1px solid #00000020; height: 50px;" class="product-name">Name</th>
                                        <th style="border: 1px solid #00000020; height: 50px;" class="product-cost">Unit Price</th>
                                        <th style="border: 1px solid #00000020; height: 50px;" class="product-quantity">Quantity</th>
                                        <th style="border: 1px solid #00000020; height: 50px;" class="product-discount">Discount</th>
                                        <th style="border: 1px solid #00000020; height: 50px;" class="product-totall">Total</th>
                                    </tr>
                                    </thead>

                                    <tbody id="ajax_body">
                                    @if(isset($products[0]))
                                        @foreach($products as $p)
                                            <?php
                                            $temp_total = priceCalculation($p->price, $p->discount, $p->discount_type) * $cart[$p->id];
                                            $temp_discount = discountCalculation($p->price, $p->discount, $p->discount_type) * $cart[$p->id];
                                            $total_price = $total_price + $p->price * $cart[$p->id];
                                            $total_discount = $total_discount + $temp_discount;
                                            $total_qty = $total_qty + $cart[$p->id];
                                            ?>
                                            <tr>
                                                <td style="border: 1px solid #00000010; height: 40px; text-align: center;" class="product-name">{{$p->title}}</td>
                                                <td style="border: 1px solid #00000010; height: 40px; text-align: center;" class="product-cost">{{$p->price}}</td>
                                                <td style="border: 1px solid #00000010; height: 40px; text-align: center;" class="product-quantity " id="quantity">{{$cart[$p->id]}}</td>
                                                <td style="border: 1px solid #00000010; height: 40px; text-align: center;" class="product-discount">{{$temp_discount}}</td>
                                                <td style="border: 1px solid #00000010; height: 40px; text-align: center;" class="product-total t_{{$p->id}}">{{$temp_total}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="invoice-buttons text-right">
                            <a href="#" onclick="printDiv('invoice-area')" class="invoice-btn">print invoice</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--================= End left sidebar section =================-->


</div>


<!--================= Jquery plugins =================-->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<script>
    function printDiv(divName) {

        var printContents = document.getElementById(divName).innerHTML;
        w=window.open();
        w.document.write(printContents);
        w.print();
        w.close();
    }
</script>


</body>
</html>
