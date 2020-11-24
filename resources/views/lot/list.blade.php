@extends('master.master',['main_menu'=>'product'])
@section('title','Lot List')
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>List of Lot <a type="button" class="btn btn-info glyphicon glyphicon-plus pull-right"
                                   href="{{ route('addLot')}}"> Add</a></h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">

            <div class="sec-title p-15 mb-20">
                {{ Form::open(['route'=>'lotList','method'=>'GET']) }}
                <div class="row">
                    <div class="col-sm-6 pull-right col-xs-12">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search" placeholder="Input Lot/Warehouse Name" @if(isset($search)) value="{{$search}}" @endif />
                            <span class="input-group-addon spanclass"><button type="submit" class="rangebtn">Submit</button></span>
                        </div>
                    </div>
                    <div class="col-sm-4 pull-right col-xs-12">
                        <select class="form-control pull-right" onchange="this.form.submit()" name="wh">
                            <option value="">{{__('Select Warehouse')}}</option>
                            @if(isset($warehouse[0]))
                                @foreach($warehouse as $w_h)
                                    <option @if(isset($wh) && $w_h->id==$wh) selected @endif value="{{$w_h->id}}">{{$w_h->name}}</option>
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
        <div class="col-sm-12">
            <div class="section-area">
                <table class="table table-striped table-bordered table-hover dt-responsive dc-table">
                    <thead>
                    <tr>
                        <th class="all">Name</th>
                        <th class="desktop">Warehouse Name</th>
                        <th class="min-phone-l tc_w15 text-center">Status</th>
                        <th class="all tc_w10">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($lots[0]))
                        @foreach($lots as $lot)
                            <tr>
                                <td>{{ $lot->name }}</td>
                                <td>{{ $lot->warehouse_name }}</td>
                                <td class="table_alignment text-center">
                                    {!! Form::open(['route'=>'lotActiveInactive']) !!}
                                    <label class="switch">
                                        <input onclick="this.form.submit()" type="checkbox"
                                               @if($lot->status == 1) checked @endif >
                                        <input onclick="this.form.submit()" type="checkbox"
                                               @if($lot->status == 1) checked @endif >
                                        <span class="slider"></span>
                                    </label>
                                    <input type="hidden" name="active_id" value="{{$lot->id}}">
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Tools
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="{{ route('editLot',$lot->id) }}" data-toggle="tooltip"
                                                   title="Click to edit"><i class="fa fa-pencil"></i> Edit</a>
                                            </li>
                                            <li>
                                                <a href="#{{$lot->id}}" data-toggle="modal" title="Click to Delete"><i
                                                            class="fa fa-trash"></i> Delete </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="{{$lot->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content modal-sm">
                                        <div class="modal-header ">
                                            <h5 class="modal-title">Warning
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure that you want to perform this operation ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No
                                            </button>
                                            <a href="{{ route('deleteLot',$lot->id) }}" class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2" class="not_found"> No warehouse yet!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                @if(isset($lots[0]))
                    <div>{{$lots->links()}}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection