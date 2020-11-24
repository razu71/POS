@extends('master.master',['main_menu'=>'product'])
@section('title',$title)
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                @if(isset($warehouses))
                    <h3>Update Warehouse</h3>
                @else
                    <h3>Add Warehouse</h3>
                @endif
            </div>
        </div>
    </div>
    <div class="section-area">
        <div class="row">
            <div class="col-xs-12">
                <div class="">
                    <form method="POST" action="{{ route('saveWarehouse')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="">Warehouse Name <span class="required">*</span></label>
                                    <input type="text" name="name" placeholder="input warehouse name"
                                           class="form-control" id="exampleInputEmail1"
                                           @if(isset($warehouses)) value="{{ $warehouses->name }}" @endif />
                                    <span class="text-danger">  {{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                                    <label for="">Slug</label>
                                    <input type="text" name="slug" placeholder="input slug here" class="form-control"
                                           id="exampleInputEmail1"
                                           @if(isset($warehouses)) value="{{ $warehouses->slug }}" @endif />
                                    <span class="text-danger">  {{ $errors->has('slug') ? $errors->first('slug') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                @if(isset($warehouses)) <input type="hidden" name="w_id"
                                                               value="{{ $warehouses->id }}"> @endif
                                <button type="submit" class="btn btn-info pull-right">@if(isset($warehouses))Update @else Add @endif</button>
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