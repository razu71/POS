@extends('master.master',['main_menu'=>'product','sub_menu'=>'barcode'])
@section('title',':: Print Barcode')
@section('after-style')
    <link rel="stylesheet" href="{{asset('assets/jQuery-autoComplete-master/jquery.auto-complete.css')}}">
    <style>
        .easy-autocomplete > .input-search input.form-control {
            padding-right: 98%;
        }
    </style>
@endsection
@section('content')
    <div class="order-received">
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title p-15 mb-20">
                    <h3>Print Barcode</h3>
                </div>
            </div>
        </div>
        {{Form::open(['route'=>'productBarcode'])}}
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title p-15 mb-20">
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            <div class="form-group">
                                <label>Enter SKU/ Product Name</label>
                                <input class="form-control" type="text" name="search" placeholder="Input Product Info"/>
                            </div>
                        </div>
                        <div class="col-md-4 pull-right col-xs-12">
                            <div class="form-group">
                                <label>No of Barcode</label>
                                <input class="form-control" type="number" name="number"
                                       @if(isset($number))value="{{$number}}" @else value="1" @endif min="1" max="200"/>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <label>Product Name:</label>
                            <ul id="list">
                                @if(isset($product))
                                    <li>{{$product->title}}</li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="selected_id" @if(isset($product))value="{{$product->id}}"
                               @else value="" @endif>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="sec-title p-15 mb-20">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-xs-12">
                            <div class="form-control">
                                <input type="checkbox" name="name" checked> Product Name
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-xs-12">
                            <div class="form-control">
                                <input type="checkbox" name="price" checked> Product Price
                            </div>
                        </div>
                        {{--<div class="col-sm-6 col-md-3 col-xs-12">--}}
                            {{--<div class="form-control">--}}
                                {{--<input type="checkbox" name="discount" @if(isset($discount))checked @endif> Product Discount--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-sm-6 col-md-3 col-xs-12">
                            <div class="form-control">
                                <input type="checkbox" name="business" @if(isset($business))checked @endif> Business Name
                            </div>
                        </div>
                        <div class="col-sm-12 mt-20 col-xs-12">
                            <button type="submit" class="btn btn-info pull-right">Preview</button>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>


        @if(isset($number) && isset($product))
            <div class="sec-title p-15 mb-20">
                <div class="row">
                    @for($i=0;$i<$number;$i++)
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="print-barcoad">
                            @if(isset($business))<p>{{allsetting()['title']}}</p>@endif
                            @if(isset($name))<p>{{$product->title}}</p>@endif
                            @if(isset($price))<p class="mb-15">Price:{{priceCalculation($product->price,$product->discount,$product->discount_type)}} {{allsetting()['currency']}}</p>@endif
                            <h5>{!! DNS1D::getBarcodeHTML($product->sku, 'C128A') !!}</h5>
                        </div>
                    </div>
                    @endfor
                </div>
                
                <div class="col-sm-12 mt-20 col-xs-12">
                    <button type="submit" class="btn btn-info pull-right" name="print" value="1">Print</button>
                </div>
            </div>
            <div class="clearfix"></div>
            {{Form::close()}}
        @endif
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/jQuery-autoComplete-master/jquery.auto-complete.js')}}"></script>
    <script>
        $('input[name=search]').autoComplete({
            source: function (term, suggest) {
                $.getJSON('{{route('productBarcode')}}', {q: term}, function (data) {
                    var choices = data.items;
                    if (choices) {
                        var suggestions = [];
                        for (var i = 0; i < choices.length; i++) {
                            suggestions.push(choices[i]['id'] + '|' + choices[i]['title'] + '|(' + choices[i]['sku'] + ')');
                        }
                        suggest(suggestions);
                    }
                });
            },
            minChars: 1,
            width:500,
            renderItem: function (item, search) {
                var re = item.split('|');
                return '<div class="autocomplete-suggestion" data-id="' + re[0] + '" data-name="' + re[1] + ' ' + re[2] + '" >' + re[1] + ' ' + re[2] + '</div>';
            },
            onSelect: function (e, term, item) {
                $('#list').html('<li>' + item.data("name") + '</li>');
                $('input[name=selected_id]').val(item.data('id'));
            }
        });

    </script>
@endsection