@extends('master.master',['main_menu'=>'product'])
@section('title','All Supplier')
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <div class="row">
                    <div class="col-sm-8">
                        <h3>List of All Supplier </h3>
                    </div>
                    <div class="col-sm-4">
                        <a style="margin-bottom: 10px;" type="button" class="btn btn-info glyphicon glyphicon-plus pull-right" href="{{ route('addSupplier')}}"> Add </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20 col-md-12">
                {{ Form::open(['route'=>'allSupplier','method'=>'GET']) }}
                <div class="row">
                    <div class="col-md-6 pull-right">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search" placeholder="Input Supplier Name"
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
        <div class="col-sm-12">
            <div class="section-area">
                <table class="table table-striped table-bordered table-hover dt-responsive dc-table">
                    <thead>
                    <tr>
                        <th class="all">Name</th>
                        <th class="desktop">Email</th>
                        <th class="desktop">Mobile</th>
                        <th class=" all tc_w10">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($suppliers[0]))
                        @foreach($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->name }}</td>
                                <td>{{$supplier->email }}</td>
                                <td>{{$supplier->mobile }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Tools
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="{{ route('viewSupplier',$supplier->id) }}"
                                                   data-toggle="tooltip" title="Click to View"><i class="fa fa-eye"></i>
                                                    View</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('editSupplier',$supplier->id) }}"
                                                   data-toggle="tooltip" title="Click to Edit"><i
                                                            class="fa fa-pencil"></i> Edit</a>
                                            </li>
                                            <li>
                                                <a href="#{{$supplier->id}}" data-toggle="modal"
                                                   title="Click to Delete"><i class="fa fa-trash"></i> Delete </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="{{$supplier->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content modal-sm">
                                        <div class="modal-header ">
                                            <h5 class="modal-title">Warning
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure that you want to perform this operation ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No
                                            </button>
                                            <a href="{{route('deleteSupplier', $supplier->id)}}"
                                               class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="not_found"> No Suppliers yet!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                @if(isset($suppliers[0]))
                    <div>{{$suppliers->links()}}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection