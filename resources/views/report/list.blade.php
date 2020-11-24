@extends('master.master',['main_menu'=>'sell','sub_menu'=>'report'])
@section('title','Report')
@section('after-style')



@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="sec-title p-15 mb-20">
                <h3>Sell Report</h3>
            </div>
        </div>
    </div>
    <div class="section-area">
        <div class="row">
            <div class="col-sm-12">
                <div class="sale-report-table">
                    <table class="table table-striped table-bordered table-hover dt-responsive dc-table">
                        <thead>
                        <tr>
                            <th class="all">Product Title</th>
                            <th class="desktop">SKU</th>
                            <th class="desktop">Qty</th>
                            <th class="mobile-phone-l">Price</th>
                            <th class="mobile-phone-l">Discount</th>
                            <th class="all">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($reports[0]))
                            @foreach($reports as $report)
                                <tr>
                                    <td>{{$report->title }}</td>
                                    <td>{{$report->sku }}</td>
                                    <td>{{$report->quantity }}</td>
                                    <td>{{$report->price }}</td>
                                    <td>{{$report->discount }} @if(!empty($report->discount) && ($report->discount_type==DISCOUNT_TYPE_FLAT)) $ @elseif(!empty($report->discount) && ($report->discount_type==DISCOUNT_TYPE_PERCENTAGE)) %  @endif</td>
                                    <td>{{$report->price }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="not_found"> No Report Exists</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                
                @if(isset($report[0]))
                    <div>{{$report->links()}}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection