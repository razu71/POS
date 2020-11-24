@extends('master.master',['main_menu'=>'users'])
@section('title','Add Coupon')
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>Add New Coupon</h3>
            </div>
        </div>
    </div>
    <div class="section-area">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <form method="POST" action="{{ route('saveCupon')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="">Number of Cupon</label>
                                    <input type="number" name="amount" class="form-control" id="exampleInputEmail1"
                                    />
                                    <span class="text-danger">  {{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Set Cupon Prefix</label>
                                    <input type="text" name="prefix" class="form-control" id="exampleInputEmail1"
                                           placeholder="Example: AB"/>
                                    <span class="text-danger">  {{ $errors->has('prefix') ? $errors->first('prefix') : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection