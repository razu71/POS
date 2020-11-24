@extends('master.master',['main_menu'=>'users'])
@section('title','update Coupon')
@section('after-style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>Edit Coupon</h3>
            </div>
        </div>
    </div>
    <div class="section-area">
        <div class="row">
            <div class="col-sm-12">
                <div class="">
                    <form method="POST" action="{{ route('updateCupon')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                @if(isset($cupons))
                                    <div class="form-group  {{ $errors->has('coupon_number') ? 'has-error' : '' }}">
                                        <label for="">Cupon</label>
                                        <input type="text" name="coupon_number" class="form-control"
                                               id="exampleInputEmail1" value="{{ $cupons->coupon_number }}"/>
                                        <input type="hidden" name="cupon_id" class="form-control"
                                               value="{{ $cupons->id }}"/>
                                        <span class="text-danger">  {{ $errors->has('coupon_number') ? $errors->first('coupon_number') : '' }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <br>
                                <button type="submit" class="btn btn-info pull-left">Update</button>
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