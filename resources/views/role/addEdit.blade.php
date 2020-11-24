@extends('master.master',['main_menu'=>'users'])
{{--@php--}}
    {{--if (isset($categoryEdit)){--}}
        {{--$title = ':: Edit Category ::';--}}
    {{--}else{--}}
    {{--$title = ':: Add Category ::';--}}
    {{--}--}}
{{--@endphp--}}
@section('title','Add Role')
@section('after-style')
    <style>
        #sbOne,#sbTwo  {
            height:400px;
        }
        .inpbtn {
            padding: 8px 9px;
            background: #26A69A;
            color: #fff;
            border: none;
            font-weight: 700;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>@if(isset($rolesEdit)) Update Role @else Add Role @endif</h3>
            </div>
        </div>
    </div>

    <div class="section-area">
        {{ Form::open(array('route' => 'roleSave','files'=>true,'id'=>'myForm')) }}
        <div class="row">
            <div class="form-group col-md-12">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="exampleInputEmail1">Role Name</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                           placeholder="Role Name" @if(isset($rolesEdit)) value="{{$rolesEdit->title}}" @endif>
                    <span class="text-danger">  {{ $errors->has('title') ? $errors->first('title') : '' }}</span>
                </div>
            </div>
            <div class="form-group col-md-12">
                <div class="form-group {{$errors->has('description') ? 'has-error' : '' }}">
                    <label for="exampleInputEmail1">Role Description</label>
                    <textarea name="description" class="form-control" id="exampleInputEmail1" placeholder="Role Description">@if(isset($rolesEdit)) {{$rolesEdit->description}} @endif</textarea>
                    <span class="text-danger">  {{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                </div>
            </div>
            <div class="col-md-12">
                <h3>Please select your task</h3>
                <div class="col-md-5">
                    <select id="sbOne" multiple="multiple" id="exampleInputFile" class="pay-methd-frm form-control">
                        @foreach(actions() as $key=>$value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-top: 18%;" class="col-md-2 text-center">
                    <input type="button" id="left" class="inpbtn" value="<" />
                    <input type="button" id="leftall" class="inpbtn" value="<<" />
                    <input type="button" id="rightall" class="inpbtn" value=">>" />
                    <input type="button" id="right" class="inpbtn" value=">" />
                </div>
                <div class="col-md-5 {{$errors->has('description') ? 'has-error' : '' }}">
                    <?php
                        if (isset($rolesEdit)){
                            $tmp= '';
                            $rolelist = explode('|',$rolesEdit->tasks);
                        }
                    ?>
                    <select name="tasks[]" id="sbTwo" multiple="multiple" id="exampleInputFile" class="pay-methd-frm form-control">
                        @foreach(actions() as $act_id=>$act_val)
                            @if(isset($rolelist) && in_array($act_id,$rolelist))
                                <option value="{{$act_id}}">{{$act_val}}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="text-danger">  {{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                </div>
            </div>
            <div class="col-md-12" style="margin-top: 15px;">
                @if(isset($rolesEdit) && !empty($rolesEdit->id))
                    <input type="hidden" name="edit_id" value="{{$rolesEdit->id}}">
                @endif
                <button type="submit" class="btn btn-info pull-right"> @if(isset($rolesEdit)) Update @else Add @endif</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('script')
    <script>
        $(function () { function moveItems(origin, dest) {
            $(origin).find(':selected').appendTo(dest);
        }
            function moveAllItems(origin, dest) {
                $(origin).children().appendTo(dest);
            }
            $('#left').click(function () {
                moveItems('#sbTwo', '#sbOne');
            });
            $('#right').on('click', function () {
                moveItems('#sbOne', '#sbTwo');
            });
            $('#leftall').on('click', function () {
                moveAllItems('#sbTwo', '#sbOne');
            });
            $('#rightall').on('click', function () {
                moveAllItems('#sbOne', '#sbTwo');
            });
        });
        $(document.body).on('submit','#myForm',function (e) {
//            e.preventDefault();
            $('#sbTwo option').prop('selected', true);
           // $('#myForm').submit();
        });
    </script>
@endsection