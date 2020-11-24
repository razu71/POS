@extends('master.master',['main_menu'=>'product'])
@section('title',$title)
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                @if(isset($lots))
                <h3>Update Lot</h3>
                @else
                <h3>Add New Lot</h3>
                    @endif
            </div>
        </div>
    </div>
    <div class="section-area">
        <div class="row">
            <div class="col-xs-12">
                <div class="">
                    <form method="POST" action="{{ route('saveLot')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="">Lot Name <span class="required">*</span></label>
                                    <input type="text" name="name" placeholder="input lot name" class="form-control" id="exampleInputEmail1" @if(isset($lots)) value="{{$lots->name}}" @endif/>
                                    <span class="text-danger">  {{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group {{ $errors->has('warehouse_id') ? 'has-error' : '' }}">
                                    <label for="">Warehouse <span class="required">*</span></label>
                                    <select name="warehouse_id" class="form-control">
                                        <option value="">Select Warehouse</option>
                                        @if(isset($warehouse[0]))
                                        @foreach($warehouse as $warehouse)
                                            <option @if(isset($lots) && ($lots->warehouse_id==$warehouse->id)) selected @endif value="{{$warehouse->id}}"> {{ $warehouse->name }}</option>
                                        @endforeach
                                            @endif
                                    </select>
                                    <span class="text-danger">  {{ $errors->has('warehouse_id') ? $errors->first('warehouse_id') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                @if(isset($lots)) <input type="hidden" name="lot_id" value="{{ $lots->id }}"> @endif
                                <button type="submit" class="btn btn-info pull-right">@if(isset($lots))Update @else Add @endif</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection