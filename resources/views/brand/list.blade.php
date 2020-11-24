@extends('master.master',['main_menu'=>'product'])
@section('title','Brand List')
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>List of Brand <a type="button" class="btn btn-info glyphicon glyphicon-plus pull-right"
                                     href="{{ route('addBrand')}}"> Add</a></h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                {{ Form::open(['route'=>'brandList','method'=>'GET']) }}
                <div class="row">
                    <div class="col-md-6 pull-right col-xs-12">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search" placeholder="Input Brand Name"
                                   @if(isset($search)) value="{{$search}}" @endif/>
                            <span class="input-group-addon spanclass"><button type="submit"
                                                                              class="rangebtn">Submit</button></span>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="section-area">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-bordered table-hover dt-responsive dc-table">
                    <thead>
                    <tr>
                        <th class="all">Brand Logo</th>
                        <th class="desktop">Name</th>
                        <th class="desktop tc_w15 text-center">Status</th>
                        <th class="all tc_w10">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($brands[0]))
                        @foreach($brands as $brand)
                            <tr>
                                <td class="table_alignment">
                                    <img src="@if(!empty($brand->image)){{asset(path_brand().$brand->image)}} @else {{asset('assets/images/avater.jpg')}} @endif"
                                             width="50" height="50"></td>
                                <td>{{ $brand->name }}</td>
                                <td class="table_alignment text-center">
                                    {!! Form::open(['route'=>'brandActiveInactive']) !!}
                                    <label class="switch">
                                        <input onclick="this.form.submit()" type="checkbox"
                                               @if($brand->status == 1) checked @endif >
                                        <input onclick="this.form.submit()" type="checkbox"
                                               @if($brand->status == 1) checked @endif >
                                        <span class="slider"></span>
                                    </label>
                                    <input type="hidden" name="active_id" value="{{$brand->id}}">
                                    {!! Form::close() !!}
                                </td>
                                <td class="table_alignment">
                                    <div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Tools
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="{{ route('editBrand',$brand->id) }}" data-toggle="tooltip" title="Click to Edit"><i class="fa fa-pencil"></i> Edit</a>
                                            </li>
                                            <li>
                                                <a href="#{{$brand->id}}" data-toggle="modal" title="Click to Delete"><i class="fa fa-trash"></i> Delete </a>
                                            </li>
                                        </ul>

                                    </div>

                                </td>
                            </tr>
                            <div class="modal fade" id="{{$brand->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                            <a href="{{ route('deleteBrand',$brand->id) }}" class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="not_found"> No Brand Added yet!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                @if(isset($brands[0]))
                    {{$brands->links()}}
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection