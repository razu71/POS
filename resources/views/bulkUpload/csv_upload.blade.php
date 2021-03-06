@extends('master.master',['main_menu'=>'product'])
@section('title','Upload Bulk file')
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($message=Session::get('message'))
                <h3 class="text-center text-success">{{ $message }} </h3>
            @endif
            <div class="sec-title p-15 mb-20">
                <h3>Upload file</h3>
            </div>
        </div>
    </div>
    <div class="section-area">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <form method="POST" action="{{ route('csvUpload')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('csvfile') ? 'has-error' : '' }}">
                                    <label class="">Upload Csv File</label>
                                    <input type="file" name="csvfile" class="form-control"/>
                                    <span class="text-danger">  {{ $errors->has('csvfile') ? $errors->first('csvfile') : '' }}</span>
                                </div>
                                <div class="">
                                    <input type="hidden" name="" value="">
                                    <button type="submit" class="btn btn-info pull-right"><i class="fa fa-upload"></i>
                                        Upload
                                    </button>
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