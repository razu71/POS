@extends('master.master',['main_menu'=>'product'])
@section('title','Add Supplier')
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                @if(isset($supplier))
                    <h3>Update Supplier</h3>
                @else
                    <h3>Add New Supplier</h3>
                @endif
            </div>
        </div>
    </div>
    <div class="section-area">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <form method="POST" action="{{ route('saveSupplier')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="">Full Name <span class="required">*</span></label>
                                    <input type="text" name="name" placeholder="input your name"
                                           class="form-control"
                                           id="exampleInputEmail1"
                                           @if(isset($supplier)) value="{{$supplier->name}}" @endif/>
                                    <span class="text-danger">  {{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="">Email Address</label>
                                    <input type="text" name="email" placeholder="input your email"
                                           class="form-control"
                                           id="exampleInputEmail1"
                                           @if(isset($supplier)) value="{{$supplier->email}}" @endif />
                                    <span class="text-danger">  {{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                                    <label class="">Mobile No. <span class="required">*</span></label>
                                    <input type="text" name="mobile" placeholder="input your mobile no."
                                           class="form-control"
                                           @if(isset($supplier)) value="{{$supplier->mobile}}" @endif/>
                                    <span class="text-danger">  {{ $errors->has('mobile') ? $errors->first('mobile') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                    <label class="">Upload Image</label>

                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="fa fa-file fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-default btn-file">
															<span class="fileupload-exists">Change</span>
															<span class="fileupload-new">Select file</span>
															<input type="file" accept="image/*" name="image" onchange="readURL(this,'image')" />
														</span>
                                            <a href="#" onclick="removeImage('image')" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        </div>
                                        <img id="image" @if(isset($supplier)) src="{{asset(path_supplier().$supplier->image)}}" @else src="" style="display: none"  @endif class="upload_image" alt="img">
                                    </div>
                                    <span class="text-danger">  {{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <div class="">
                                        <form method="POST" action="{{ url('supplier/saveSupplier')}}"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                                        <label class="">Address:</label>
                                                        <textarea name="address" cols="10" rows=""
                                                                  class="form-control"
                                                                  placeholder="input your full address"
                                                                  rows="2">@if(isset($supplier)){{$supplier->address}}@endif</textarea>
                                                        <span class="text-danger">  {{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="form-group {{ $errors->has('trade_license') ? 'has-error' : '' }}">
                                                        <label class="">Upload Trade License</label>


                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="input-append">
                                                                <div class="uneditable-input">
                                                                    <i class="fa fa-file fileupload-exists"></i>
                                                                    <span class="fileupload-preview"></span>
                                                                </div>
                                                                <span class="btn btn-default btn-file">
															<span class="fileupload-exists">Change</span>
															<span class="fileupload-new">Select file</span>
															<input type="file" accept="image/*" name="trade_license" onchange="readURL(this,'trade_license')" />
														</span>
                                                                <a href="#" onclick="removeImage('trade_license')" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            </div>
                                                            <img id="trade_license" @if(isset($supplier)) src="{{asset(path_supplier().$supplier->trade_license)}}" @else src="" style="display: none" @endif class="upload_image" alt="img">
                                                        </div>

                                                        <span class="text-danger">  {{ $errors->has('trade_license') ? $errors->first('trade_license') : '' }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    @if(isset($supplier))
                                                        <input type="hidden" name="edit_id" value="{{$supplier->id}}">
                                                    @endif
                                                    <button type="submit" class="btn btn-info pull-right">@if(isset($supplier))Update @else Add @endif</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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