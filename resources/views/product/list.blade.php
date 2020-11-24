@extends('master.master',['main_menu'=>'product'])
@section('title',':: Product List ::')
@section('after-style')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>

@endsection
@section('content')
    <div class="order-received">
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title p-15 mb-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>Product List</h3>
                        </div>
                        <div class="col-sm-6">
                            <ul class="btn-style text-right">
                                <li><a href="{{route('productAdd')}}"> ADD </a></li>
                                <li><a href="{{route('excel')}}"> EXCEL</a></li>
                                <li><a href="{{route('csv')}}"> CSV</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title p-15 mb-20">
                    {{ Form::open(['route'=>'productList','method'=>'GET']) }}
                    <div class="row">
                        <div class="col-md-6 pull-right col-sm-8">
                            <div class="input-group">
                                <input class="form-control" type="text" name="search" placeholder="Enter Product Title/Sku "
                                       @if(isset($search)) value="{{$search}}" @endif/>
                                <span class="input-group-addon spanclass">
                                    <button type="submit" class="rangebtn">Submit</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 pull-right col-sm-4">
                            <select class="form-control pull-right" onchange="this.form.submit()" name="cat">
                                <option value="">{{__('Select Category')}}</option>
                                @if(isset($categories[0]))
                                    @foreach($categories as $ctg)
                                        <option @if(isset($ctg) && $ctg->id==$cat) selected @endif value="{{$ctg->id}}">{{$ctg->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="section-area">
                    <table class="table table-striped table-bordered table-hover dt-responsive dc-table">
                        <thead>
                        <tr>
                            <th class="desktop">Image</th>
                            <th class="all">Product Title</th>
                            <th class="desktop">Category</th>
                            <th class="min-phone-l text-center">Price</th>
                            <th class="min-phone-l text-center">Discount</th>
                            <th class="all tc_w10">Activity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @if(isset($products_list[0]))
                            @foreach($products_list as $product_list)
                                <tr>
                                    <td class="table_alignment"><img
                                                src="@if(!empty($product_list->image)){{asset('upload').'/'.$product_list->image}} @else {{asset('assets/images/avater.jpg')}} @endif"
                                                alt="" width="70" height="50"></td>
                                    <td class="table_alignment">{{$product_list->title}}</td>
                                    <td class="table_alignment">{{$product_list->getCategory->title}}</td>
                                    <td class="table_alignment text-center">${{$product_list->price}}</td>
                                    <td class="table_alignment text-center">
                                        @if($product_list->discount)
                                            {{$product_list->discount}} {{($product_list->discount_type==DISCOUNT_TYPE_FLAT)?allsetting()['currency']:'%'}}
                                        @endif
                                    </td>
                                    <td class="table_alignment">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Tools
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{route('productEdit',$product_list->id)}}" data-toggle="tooltip" title="Click to Edit"><i class="fa fa-pencil"></i> Edit</a>
                                                </li>
                                                <li>
                                                    <a href="#{{$product_list->id}}" data-toggle="modal" title="Click to Delete"><i class="fa fa-trash"></i> Delete </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="{{$product_list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-sm">
                                            <div class="modal-header ">
                                                <h5 class="modal-title">Warning
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button></h5>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure that you want to perform this operation ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                                <a href="{{route('deleteProduct', $product_list->id)}}" class="btn btn-primary">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">product not found!</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    @if(isset($products_list[0]))
                        {{$products_list->links()}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">
        $(function () {
            $('input[name="daterange"]').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY h:mm A'
                }
            });
        });
    </script>
@endsection