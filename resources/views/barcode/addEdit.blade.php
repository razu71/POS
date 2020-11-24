@extends('master.master',['main_menu'=>'product'])
@php
    if(isset($productEdit)){
        $title = ':: Edit Product ::';
    }else{
        $title = ':: Add Product ::';
    }
@endphp
@section('title', $title)
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>@if(isset($productEdit)) Edit Your Product @else Add Your Product @endif</h3>
            </div>
        </div>
    </div>
    {{--{{dd($categoryEdit)}}--}}
    <div style="" class="content pt-0 pb-0 section-area">
        <div class="section-area">
            <div class="row">
                <div class="col-md-12">
                    {{ Form::open(array('route'=>'productSave','files'=>true)) }}
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Product Name <span class="required">*</span></label>
                                <input type="text" name="title" class="form-control"
                                       placeholder="Product Name" @if(isset(
                                   $productEdit)) value="{{$productEdit->title}}" @endif>
                                <span class="text-danger">  {{ $errors->has('title') ? $errors->first('title') : '' }}</span>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-group {{ $errors->has('brand') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Brand Name</label>
                                <select name="brand_id" id="" class="pay-methd-frm form-control">
                                    <option value="">Select</option>
                                    @if(isset($brands[0]))
                                        @foreach($brands as $brand)
                                            <option
                                                    value="{{$brand->id}}"
                                                    @if(isset($productEdit) && ($brand->id == $productEdit->brand_id) )
                                                    selected @endif >{{$brand->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger">  {{ $errors->has('brand') ? $errors->first('brand') : '' }}</span>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                <label for="exampleInputFile">Product Image</label>
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
                                    <img id="image" @if(isset($productEdit)) src="{{asset(path_upload().$productEdit->image)}}" @else src="" style="display: none" @endif class="upload_image" alt="img">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                <label >Select Category <span class="required">*</span></label>
                                <select name="category_id" id="" class="pay-methd-frm form-control">
                                    <option value="">Select</option>
                                    @if(isset($categoryList[0]))
                                        @foreach($categoryList as $category)
                                            <option value="{{$category->id}}"
                                                    @if(isset($productEdit) && ($category->id == $productEdit->category_id)) selected @endif>{{$category->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger">  {{ $errors->has('category_id') ? $errors->first('category_id') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                <label >Select Supplier <span class="required">*</span></label>
                                <select name="supplier_id" id="" class="pay-methd-frm form-control">
                                    <option value="">Select</option>
                                    @if(isset($supplierList[0]))
                                        @foreach($supplierList as $supplier)
                                            <option value="{{$supplier->id}}"
                                                    @if(isset($productEdit) && ($supplier->id == $productEdit->supplier_id)) selected @endif>{{$supplier->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger">  {{ $errors->has('supplier_id') ? $errors->first('supplier_id') : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                                <label >Price <span class="required">*</span></label>
                                <input type="text" name="price" class="form-control"
                                       placeholder="Product Price"
                                       @if(isset($productEdit)) value="{{$productEdit->price}}" @endif>
                                <span class="text-danger">  {{ $errors->has('price') ? $errors->first('price') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-group {{ $errors->has('discount') ? 'has-error' : '' }}">
                                <label >Discount</label>
                                <input type="text" name="discount" class="form-control"
                                       placeholder="Discount"
                                       @if(isset($productEdit)) value="{{$productEdit->discount}}" @endif>
                                <span class="text-danger">  {{ $errors->has('discount') ? $errors->first('discount_percent') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-group {{ $errors->has('discount_type') ? 'has-error' : '' }}">
                                <label >Discount Type</label>
                                <select name="discount_type" id="" class="form-control">
                                    <option value="">Select Discount Type</option>
                                    @foreach(discountType() as $dt)
                                        <option value="{{$dt['id']}}" @if(isset($productEdit) && $productEdit->discount_type==$dt['id']) selected @endif >{{$dt['title']}}</option>
                                    @endforeach
                                </select>

                                <span class="text-danger">  {{ $errors->has('discount_type') ? $errors->first('discount_type') : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="form-group {{ $errors->has('qty') ? 'has-error' : '' }}">
                                <label >Product QTY <span class="required">*</span></label>
                                <input type="text" name="qty" class="form-control"
                                       placeholder="Product QTY"
                                       @if(isset($productEdit)) value="{{$productEdit->qty}}" @endif>
                                <span class="text-danger">  {{ $errors->has('qty') ? $errors->first('qty') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-group {{ $errors->has('sku') ? 'has-error' : '' }}">
                                <label >Product SKU <span class="required">*</span></label>
                                <input type="text" name="sku" class="form-control"
                                       placeholder="Product SKU"
                                       @if(isset($productEdit)) value="{{$productEdit->sku}}" @endif>
                                <span class="text-danger">  {{ $errors->has('sku') ? $errors->first('sku') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-group {{ $errors->has('stockable') ? 'has-error' : '' }}">
                                <label >Product Stockable <span class="required">*</span></label>
                                <select name="stockable" class="form-control">
                                    <option value="{{STOCKABLE_NO}}" @if(isset($productEdit)&& $productEdit->stockable==STOCKABLE_NO) selected @endif >No</option>
                                    <option value="{{STOCKABLE_YES}}" @if(isset($productEdit)&& $productEdit->stockable==STOCKABLE_YES) delected @endif >Yes</option>
                                </select>
                                <span class="text-danger">  {{ $errors->has('stockable') ? $errors->first('sku') : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label>Product Description</label>
                                <textarea name="description" class="form-control" cols="5" rows="5"
                                          placeholder="Product Description">@if(isset($productEdit)){{$productEdit->description}}@endif</textarea>
                                <span class="text-danger">  {{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        @if(isset($productEdit))
                            <input type="hidden" name="edit_id" value="{{$productEdit->id}}">
                        @endif
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection