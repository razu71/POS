@extends('master.master',['main_menu'=>'product'])
@section('title','View Supplier')
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>View Supplier Details</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h3> </h3>
            <div class="well form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3">Full Name:</label>
                        <div class="col-sm-9">
                            {{$supplier->name}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Email Address:</label>
                        <div class="col-sm-9">
                           {{ $supplier->email }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Mobile No.:</label>
                        <div class="col-sm-9">
                            {{ $supplier->mobile }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Address:</label>
                        <div class="col-sm-9">
                            {{ $supplier->address }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Featured Image</label>
                        <div class="col-sm-9">
                            <img src="{{asset(path_supplier().$supplier->image)}}" alt="image" width="200px;">
                        </div>
                    </div>
                <div class="form-group">
                    <label class="col-sm-3">Trade License</label>
                    <div class="col-sm-9">
                        <img src="{{asset(path_supplier().$supplier->trade_license)}}" alt="No License Yet" width="200px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection