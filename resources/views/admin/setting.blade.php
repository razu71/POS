@extends('master.master')
@section('title','Setting')
@section('after-style')
@endsection
@section('content')
    <div style="" class="content pt-0 pb-0 mt-20">
        <div class="section-area">
            <div class="row">
                <div class="col-md-12">
                    <h3>Update Your Website Settings</h3>
                    {{--@if($message = Session::get('messages'))--}}
                        {{--<h3 class="text-center text-success">{{$message}} </h3>--}}
                    {{--@endif--}}
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li @if(isset($tab) && $tab=='header')class="active" @endif>
                                    <a href="#header" data-toggle="tab">Header</a>
                                </li>
                                <li @if(isset($tab) && $tab=='footer')class="active" @endif>
                                    <a href="#footer" data-toggle="tab">Footer</a>
                                </li>
                                <li @if(isset($tab) && $tab=='vat')class="active" @endif>
                                    <a href="#vat" data-toggle="tab">Vat</a>
                                </li>
                                <li @if(isset($tab) && $tab=='discount')class="active" @endif>
                                    <a href="#discount" data-toggle="tab">Discount</a>
                                </li>
                                <li @if(isset($tab) && $tab=='login')class="active" @endif>
                                    <a href="#login" data-toggle="tab">Login</a>
                                </li>
                            </ul>
                            <div class="tab-content section-area st-tabcontent">
                                <div class="tab-pane @if(isset($tab) && $tab=='header') active @endif" id="header">
                                    {{ Form::open(['route' => 'headerSettingSave','files' => true]) }}
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="Title">Logo Title</label>
                                            <input type="text" name="title" class="form-control" id="username"
                                                   placeholder="Title" value="{{$settings['title']}}">
                                            <span class="text-danger">  {{ $errors->has('title') ? $errors->first('title') : '' }}</span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Image Upload">Website Logo</label>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="input-append">
                                                    <div class="uneditable-input">
                                                        <i class="fa fa-file fileupload-exists"></i>
                                                        <span class="fileupload-preview"></span>
                                                    </div>
                                                    <span class="btn btn-default btn-file btn-style">
																<span class="fileupload-exists">Change</span>
																<span class="fileupload-new">Select file</span>
																<input type="file" name="image" onchange="readURL(this,'image')" />
															</span>
                                                    <a href="#" onclick="removeImage('image')" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                </div>
                                                <img id="image" src="{{asset(path_upload().$settings['image'])}}" class="upload_image" alt="img">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="Favicon">Favicon</label>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="input-append">
                                                    <div class="uneditable-input">
                                                        <i class="fa fa-file fileupload-exists"></i>
                                                        <span class="fileupload-preview"></span>
                                                    </div>
                                                    <span class="btn btn-default btn-file btn-style">
																<span class="fileupload-exists">Change</span>
																<span class="fileupload-new">Select file</span>
																<input type="file" name="favicon" onchange="readURL(this,'favicon')" />
															</span>
                                                    <a href="#" onclick="removeImage('favicon')" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                </div>
                                                <img id="favicon" src="{{asset(path_upload().$settings['favicon'])}}" class="upload_image" alt="img">
                                            </div>

                                            {{--<input name="favicon" type="file" id="favicon"--}}
                                                   {{--class="pay-methd-frm form-control" value="{{$settings['favicon']}}">--}}
                                            {{--<p class="help-block">Please insert your website favicon</p>--}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if(isset($editsetting) && !empty($editsetting->id))
                                                <input type="hidden" name="setting_edit" value="{{ $editsetting->id }}">
                                            @endif
                                            <button type="submit" class="btn btn-info pull-right">Update Settings
                                            </button>
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                                {{--Header part end--}}
                                {{--Footer Part start--}}
                                <div class="tab-pane @if(isset($tab) && $tab=='footer') active @endif" id="footer">
                                    {{ Form::open(['route'=>'footerSettingSave']) }}
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="Footer Section">Footer Copyright Text</label>
                                            <input name="footer" type="text" id="footer"
                                                   class="pay-methd-frm form-control" placeholder="Footer"
                                                   value="{{$settings['footer']}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if(isset($editsetting) && !empty($editsetting->id))
                                                <input type="hidden" name="footer_setting_edit"
                                                       value="{{ $editsetting->id }}">
                                            @endif
                                            <button type="submit" class="btn btn-info pull-right">Update Settings
                                            </button>
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                                {{--For vat section--}}
                                <div class="tab-pane @if(isset($tab) && $tab=='vat') active @endif" id="vat">
                                    {{Form::open(['route'=>'vatSettingSave'])}}
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="vat Section">Vat</label>
                                            <input name="vat" type="text" id="vat" class="pay-methd-frm form-control"
                                                   placeholder="Vat" value="{{$settings['vat']}}">
                                            <span class="search-btn"><i class="fa fa-percent">    </i></span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="hidden" name="footer_setting_edit">
                                            <button type="submit" class="btn btn-info pull-right">Update Settings
                                            </button>
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                                {{--For Tax section--}}
                                <div class="tab-pane @if(isset($tab) && $tab=='discount') active @endif" id="discount">
                                    {{Form::open(['route'=>'discountSettingSave'])}}
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="tax Section">Discount</label>
                                            <input id="discount" name="discount" class="form-control" placeholder="Discount" type="text"
                                                   value="{{$settings['discount']}}" >
                                            <span class="search-btn"><i class="fa fa-percent">    </i>
                                            </span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="hidden" name="footer_setting_edit">
                                            <button type="submit" class="btn btn-info pull-right">Update Settings
                                            </button>
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                                <div class="tab-pane @if(isset($tab) && $tab=='login') active @endif" id="login">
                                    {{Form::open(['route'=>'loginSettingSave','files'=>true])}}
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="tax Section">Captcha </label>
                                            <select name="captcha" class="form-control" placeholder="Captcha" value="{{$settings['discount']}}" >
                                                <option value="{{CAPTCHA_ON}}" @if($settings['captcha']==CAPTCHA_ON) selected @endif >{{__('On')}}</option>
                                                <option value="{{CAPTCHA_OFF}}" @if($settings['captcha']==CAPTCHA_OFF) selected @endif >{{__('Off')}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tax Section">Captcha Site Key</label>
                                            <input type="text" name="captcha_site_key" class="form-control" @if(isset($settings['captcha_site_key']))value="{{$settings['captcha_site_key']}}" @endif>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tax Section">Captcha Secret Key</label>
                                            <input type="text" name="captcha_key" class="form-control" @if(isset($settings['captcha_key']))value="{{$settings['captcha_key']}}" @endif>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tax Section">Login Background Image</label>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="input-append">
                                                    <div class="uneditable-input">
                                                        <i class="fa fa-file fileupload-exists"></i>
                                                        <span class="fileupload-preview"></span>
                                                    </div>
                                                    <span class="btn btn-default btn-file">
																<span class="fileupload-exists">Change</span>
																<span class="fileupload-new">Select file</span>
																<input type="file" name="login_image" onchange="readURL(this,'login_image')" />
															</span>
                                                    <a href="#" onclick="removeImage('login_image')" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                </div>
                                                <img id="login_image" src="{{asset(path_upload().$settings['login_image'])}}" class="upload_image" alt="img">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="hidden" name="footer_setting_edit">
                                            <button type="submit" class="btn btn-info pull-right">Update Settings
                                            </button>
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

