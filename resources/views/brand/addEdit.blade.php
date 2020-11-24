@extends('master.master',['main_menu'=>'product'])

@section('title',$title)
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                @if(isset($brands))
                    <h3>Update Brand</h3>
                @else
                    <h3>Add New Brand</h3>
                @endif
            </div>
        </div>
    </div>
    <div class="section-area">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <form method="POST" action="{{ route('saveBrand')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="">Brand Name <span class="required">*</span></label>
                                    <input type="text" name="name" placeholder="input brand name" class="form-control"
                                           id="exampleInputEmail1"
                                           @if(isset($brands)) value="{{ $brands->name }}" @endif />
                                    <span class="text-danger">  {{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                    <label class="">Brand Logo</label>
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
                                        <img id="image" @if(isset($brands)) src="{{asset(path_brand().$brands->image)}}" @else src="" style="display: none" @endif class="upload_image" alt="img">
                                    </div>
                                    <span class="text-danger">  {{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                @if(isset($brands)) <input type="hidden" name="edit_id" value="{{ $brands->id }}"> @endif
                                <button type="submit" class="btn btn-info pull-right">@if(isset($brands))Update @else Add @endif</button>
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