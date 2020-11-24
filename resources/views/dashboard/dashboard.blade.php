@extends('master.master')
@section('title',':: Dashboard')
@section('after-style')
@endsection
@section('content')
    <div class="row mt-20 mb-50">
        <div class="col-md-4">
            <div class="sales-stats bg-1 p-15">
                <h3>Today's Sale</h3>
                <p>Today's earnings and items sales </p>
                <ul>
                    <li>Earning : <span>{{!empty($daily_report->price)?$daily_report->price :0}} {{$currency}}</span></li>
                    <li>Items Sold : <span>{{!empty($daily_report->qty)?$daily_report->qty:0}} Item(s)</span></li>
                    <li>Total Discount : <span>{{!empty($daily_report->discount)?$daily_report->discount:0}} {{$currency}}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="sales-stats bg-2 p-15">
                <h3>Monthly Sale</h3>
                <p>Monthly earnings and items sales</p>
                <ul>
                    <li>Earning : <span>{{!empty($monthly_report->price)?$monthly_report->price:0}} {{$currency}}</span></li>
                    <li>Items Sold : <span>{{!empty($monthly_report->qty)?$monthly_report->qty:0}} Item(s)</span></li>
                    <li>Last Month Discount : <span>{{!empty($monthly_report->discount)?$monthly_report->discount:0}} {{$currency}}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="sales-stats bg-3 p-15">
                <h3>Alltime Sale</h3>
                <p>Alltime earnings and items sales</p>
                <ul>
                    <li>Earning : <span>{{!empty($total_report->price)?$total_report->price:0}} {{$currency}}</span></li>
                    <li>Items Sold : <span>{{!empty($total_report->qty)?$total_report->qty:0}} Item(s)</span></li>
                    <li>Last Year Discount : <span>{{!empty($total_report->discount)?$total_report->discount:0}} {{$currency}}</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="visitors-stats mb-50">
        <div class="row mb-50">
            <div class="col-md-12">
                <div class="visitors-stats-title p-15 collapse_area">
                    <h3>Products Sale Statistics <i class="fa fa-angle-down collapse_btn"></i></h3>
                    <div class="vs-graphs collapse_item">
                        {{Form::open(['route'=>'getDashboard'])}}
                        <div class="col-sm-3 pull-right">
                            <select name="month" onchange="this.form.submit()" id="" class="form-control">
                                <option value="">Select</option>
                                @foreach(months() as $mk=>$mv)
                                    <option value="{{$mk}}" @if($month==$mk) selected @endif>{{$mv}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{Form::close()}}

                        <canvas id="product_statistics" width="400"></canvas>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="visitors p-15 collapse_area">
                    <h4>Today Sale Source <i class="fa fa-angle-down collapse_btn"></i></h4>
                    <ul class="clearfix collapse_item">
                        @if(isset($today_sell[0]))
                            @foreach($today_sell as $ts)
                                <li>{{$ts->title}}<span>{{$ts->s_amount}}</span></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="visitors p-15 collapse_area">
                    <h4>Top Sale Items <i class="fa fa-angle-down collapse_btn"></i></h4>
                    <ul class="clearfix collapse_item">
                        @if(isset($top_selling_item[0]))
                            @foreach($top_selling_item as $tsi)
                                <li>{{$tsi->title}}<span>{{$tsi->qty}}</span></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="visitors-stats-title p-15 mb-50 collapse_area">
                <h3>Company Statistic (Monthly Revenue) <i class="fa fa-angle-down collapse_btn"></i></h3>
                <div class="vs-graphs collapse_item">
                    {{Form::open(['route'=>'getDashboard'])}}
                    <div class="col-sm-3 pull-right">
                        <select name="year" onchange="this.form.submit()" id="" class="form-control">
                            <option value="">Select</option>
                            @if(isset($total_years[0]))
                                @foreach($total_years as $t_y)
                            <option value="{{$t_y->y}}" @if($year==$t_y->y) selected @endif>{{$t_y->y}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    {{Form::close()}}

                    <canvas id="myChart" width="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-70">
        <div class="col-md-6">
            <div class="section-area">
                <div id="curve_chart"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="section-area">
                <div id="piechart"></div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('assets/js/Chart.bundle.min.js')}}"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>--}}
    <script>
        var ctx1 = document.getElementById("product_statistics").getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: [
                    @if(isset($monthly_sell_qty))
                    @foreach($monthly_sell_qty as $item)
                    "{{$item->title}}",
                    @endforeach
                    @endif
                ],
                datasets: [{
                    label: 'Total Sold Quantity',
                    data: [
                        @if(isset($monthly_sell_qty))
                                @foreach($monthly_sell_qty as $item)
                            {{$item->total_qty}},
                        @endforeach
                        @endif
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)'
                        ,'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)'
                        ,'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx2 = document.getElementById("myChart").getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "Jun", "July", "August", "September", "October", "November", "December"],
                datasets: [{
                    label: 'Total Sold Amount',
                    data: [
                        <?php
                        foreach($monthly_sell as $k=>$v){
                            echo $v.',';
                        }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)'
                        ,'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)'
                        ,'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)', 'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        // chart number 1
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Sales'],
                @if(isset($yearly_sell[0]))
                        @foreach($yearly_sell as $ys)
                ['{{$ys->y}}',  {{$ys->total_sell}}],
                        @endforeach
                @endif
            ]);
            var options = {
                title: 'Company Performance',
                curveType: 'function',
                legend: { position: 'bottom' }
            };
            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            chart.draw(data, options);
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        };
    </script>

@endsection