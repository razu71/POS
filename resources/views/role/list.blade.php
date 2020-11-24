@extends('master.master',['main_menu'=>'users'])
@section('title',' Role List ')
@section('after-style')
@endsection
@section('content')
    <div class="order-received">
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title p-15 mb-20">
                    <h3>Role List<a type="button" class="btn btn-info glyphicon glyphicon-plus pull-right" href="{{route('roleAdd')}}" > Add </a></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="section-area">
                    <table class="table table-striped table-bordered table-hover dt-responsive dc-table">
                        <thead>
                        <tr>
                            <th class="all">Role Title</th>
                            <th class="all tc_w10">Activity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($role_list[0]))
                            @foreach($role_list as $role)
                                <tr>
                                    <td>{{$role->title}}</td>
                                    <td class="table_alignment">
                                        @if($role->id!=1)
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Tools
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{route('roleEdit',$role->id)}}" data-toggle="tooltip" title="Click to edit"><i class="fa fa-pencil"></i> Edit</a>
                                                </li>
                                                <li>
                                                    <a href="#{{$role->id}}" data-toggle="modal" title="Click to Delete"><i class="fa fa-trash"></i> Delete </a>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                <a href="{{route('deleteRole', $role->id)}}" class="btn btn-primary">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <tr class="row">
                            <tr>
                                <td colspan="2">category not found!</td>
                            </tr>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    @if(isset($role_list[0]))
                        {!! $role_list->render() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection