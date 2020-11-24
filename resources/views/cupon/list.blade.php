@extends('master.master',['main_menu'=>'sell'])
@section('title','Cupon List')
@section('after-style')
@endsection
@section('content')
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>List of Cupon <a style="margin-bottom: 10px;" type="button"
                                     class="btn btn-info glyphicon glyphicon-plus pull-right"
                                     href="{{ route('addCupon')}}"> Add</a></h3>
            </div>
        </div>
    </div>
    <div class="section-area">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-bordered table-hover dt-responsive dc-table">
                    <thead>
                    <tr>
                        <th class="all">Cupon Number</th>
                        <th class="all tc_w10">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($cupons[0]))
                        @foreach($cupons as $cupon)
                            <tr>
                                <td>{{ $cupon->coupon_number }}</td>
                                <td>

                                    <div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Tools
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="{{ route('editCupon',$cupon->id) }}" data-toggle="tooltip" title="Click to edit"><i class="fa fa-pencil"></i> Edit</a>
                                            </li>
                                            <li>
                                                <a href="#{{$cupon->id}}" data-toggle="modal" title="Click to Delete"><i class="fa fa-trash"></i> Delete </a>
                                            </li>
                                        </ul>
                                    </div>

                                </td>

                            </tr>
                            <div class="modal fade" id="{{$cupon->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                            <a href="{{ route('deleteCupon',$cupon->id) }}" class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr class="row">
                        <tr>
                            <td colspan="2" class="not_found"> No cupon yet!</td>
                        </tr>
                        </tr>
                    @endif
                    </tbody>
                </table>
                @if(isset($cupons[0]))
                    <div>{{$cupons->links()}}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection