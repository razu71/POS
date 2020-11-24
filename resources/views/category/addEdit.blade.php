@extends('master.master',['main_menu'=>'product'])
@php
    if (isset($categoryEdit)){
        $title = ':: Edit Category ::';
    }else{
    $title = ':: Add Category ::';
    }
@endphp
@section('title',$title)
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="sec-title p-15 mb-20">
                <h3>@if(isset($categoryEdit)) Edit Category @else Add Category @endif</h3>
            </div>
        </div>
    </div>
    <div class=" section-area">
        <div class="row">
            <div class="col-xs-12">
                {{ Form::open(array('route' => 'saveCategory','files'=>true)) }}
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Category Name <span class="required">*</span></label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                   placeholder="Category Name"
                                   @if(isset($categoryEdit)) value="{{$categoryEdit->title}}" @else value="" @endif>
                            <span class="text-danger">  {{ $errors->has('title') ? $errors->first('title') : '' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                            <label for="exampleInputFile">Category Image</label>


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
                                <img id="image" @if(isset($categoryEdit)) src="{{asset(path_upload().$categoryEdit->image)}}" @else src="" style="display: none" @endif class="upload_image" alt="img">
                            </div>

                            <span class="text-danger">  {{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="col-md-6 col-xs-12">--}}
                {{--<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">--}}
                    {{--<label for="exampleInputPassword1">Parent ID</label>--}}
                    {{--<select name="parent_id" id="" class="pay-methd-frm form-control">--}}
                        {{--<option value="">Select</option>--}}
                        {{--@if(isset($categorys[0]))--}}
                            {{--@foreach($categorys as $category)--}}
                                {{--<option value="{{$category->id}}"--}}
                                        {{--@if(isset($categoryEdit) && ($category->id == $categoryEdit->parent_id) ) selected @endif >{{$category->title}}</option>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</select>--}}
                    {{--<span class="text-danger">  {{ $errors->has('parent_id') ? $errors->first('parent_id') : '' }}</span>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="col-xs-12">
                @if(isset($categoryEdit) && !empty($categoryEdit->id))
                    <input type="hidden" name="edit_id" value="{{$categoryEdit->id}}">
                @endif
                <button type="submit" class="btn btn-info pull-right">@if(isset($categoryEdit))Update @else Add @endif</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('script')
@endsection