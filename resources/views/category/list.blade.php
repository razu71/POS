@extends('master.master',['main_menu'=>'product'])
@section('title',':: Category List ::')
@section('after-style')
@endsection
@section('content')
    <div class="order-received">
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title p-15 mb-20">
                    <h3>Category List<a  type="button" class="btn btn-info glyphicon glyphicon-plus pull-right" href="{{route('addCategory')}}" > Add </a></h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="sec-title p-15 mb-20">
                    {{ Form::open(['route'=>'listCategory','method'=>'GET']) }}
                    <div class="row">
                        <div class="col-md-6 pull-right">
                            <div class="input-group">
                                <input class="form-control" type="text" name="search" placeholder="Input Category Title"
                                       @if(isset($search)) value="{{$search}}" @endif/>
                                <span class="input-group-addon spanclass"><button type="submit"
                                                                                  class="rangebtn">Submit</button></span>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="section-area">
                    <table  class="table table-striped table-bordered table-hover dt-responsive dc-table">
                        <thead>
                        <tr>
                            <th class="desktop tc_w15">Category Image</th>
                            <th class="all">Category Title</th>
                            <th class="desktop tc_w15 text-center">Is Active ?</th>
                            <th class="all tc_w10">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($categorys_list[0]))
                            @foreach($categorys_list as $category_list)
                                <tr>
                                    <td class="table_alignment"><img src="@if(!empty($category_list->image)){{asset('upload').'/'.$category_list->image}} @else {{asset('assets/images/avater.jpg')}} @endif" alt="" width="70" height="50"></td>
                                    <td class="table_alignment">{{$category_list->title}}</td>
                                    <td class="table_alignment text-center">
                                        {!! Form::open(['route'=>'activeInactive']) !!}
                                        <label class="switch">
                                            <input onclick="this.form.submit()" type="checkbox"
                                                   @if($category_list->status == 1) checked @endif >
                                            <input onclick="this.form.submit()" type="checkbox" @if($category_list->status == 1) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                        <input type="hidden" name="active_id" value="{{$category_list->id}}">
                                        {!! Form::close() !!}
                                    </td>
                                    <td class="table_alignment">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Tools
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{route('editCategory',$category_list->id)}}" data-toggle="tooltip" title="Click to Edit"><i class="fa fa-pencil"></i> Edit</a>
                                                </li>
                                                <li>
                                                    <a href="#{{$category_list->id}}" data-toggle="modal" title="Click to Delete"><i class="fa fa-trash"></i> Delete </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                                <div class="modal fade" id="{{$category_list->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-sm">
                                            <div class="modal-header ">
                                                <h5 class="modal-title">Warning
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button></h5>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure that you want to perform this operation ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                                <a href="{{route('deleteCategory', $category_list->id)}}" class="btn btn-primary">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">category not found!</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    @if(isset($categorys_list[0]))
                        {!! $categorys_list->render() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection