<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('upload/'.allsetting()['favicon'])}}">
    <title>{{allsetting()['title']}}:: @yield('title')</title>

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/datatables/css/datatables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/datatables/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/scrollbar/scroll.css')}}">
    {{--<link rel="stylesheet" href="{{asset('assets2/css/fa-solid.min.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('assets2/css/fontawesome.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets2/css/font-awesome-all.css')}}">
    <link rel="stylesheet" href="{{asset('assets2/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-fileupload/bootstrap-fileupload.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">


    @yield('after-style')


    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
</head>

<body class="sidebar-mini">
<!-- start header area
======================================== -->
<header class="main-header navbar-static-top">
    <!-- Logo -->
    <a href="{{route('getDashboard')}}" class="logo">
        @if(isset(allsetting()['image']))
        <img src="{{asset('upload'.'/'.allsetting()['image'])}}" alt="{{allsetting()['title']}}">
        @else
        <img src="{{asset('assets/img/setting/logo.png')}}" alt="{{allsetting()['title']}}">
        @endif
    </a>
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Expend Menu</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <ul class="nav navbar-nav short-icon">
                    <li class="dropdown hidden-xs"><a class="btn tip bg-c-1" data-toggle="tooltip" title=""
                                                      data-placement="bottom" href="{{route('getDashboard')}}"
                                                      data-original-title="Dashboard"><i
                                    class="fa fa-dashboard"></i></a></li>
                    <li class="dropdown"><a class="btn tip bg-c-2" title="" data-placement="bottom" href="{{route('productList')}}"
                                                      data-toggle="tooltip" data-original-title="Shop"><i
                                    class="fa fa-shopping-cart"></i></a></li>
                    <li class="dropdown">
                        <a class="btn tip bg-c-3" title="" data-toggle="tooltip" data-placement="bottom"
                           href="{{route('adminSetting')}}" data-original-title="Settings">
                            <i class="fa fa-cogs"></i>
                        </a>
                    </li>

                    <li class="dropdown hidden-xs">
                        <a class="btn bdarkGreen tip bg-c-6" title="" data-placement="bottom" href="{{route('productPage')}}"
                           data-toggle="tooltip" data-original-title="POS">
                            <i class="fa fa-th-large"></i> <span class="padding05">POS</span>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav logout">
                    <li class="dropdown">
                        <a class="btn account dropdown-toggle logout-auth-area" data-toggle="dropdown" href="#">
                            <div class="logout-auth-img">
                                <img alt="" src="@if((isset(Auth::user()->image))) {{asset(path_user().'/'.Auth::user()->image)}} @else {{asset('assets/img/file/avatar.png')}} @endif">
                            </div>
                            <div class="user">
                                <span>{{Auth::user()->username}} <i class="fa fa-angle-down"></i></span>
                                <div class="onofline">
                                    <i class="fa fa-circle"></i> Online
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="{{route('profileUser')}}">
                                    <i class="fa fa-user"></i>Profile </a>
                            </li>
                            <li>
                                <a href="{{route('userResetPawssword')}}"><i class="fa fa-key"></i>Change Password </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{route('userLogout')}}">
                                    <i class="fa fa-sign-out"></i>Logout </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </ul>
        </div>
    </nav>
</header>
<!-- end header area
======================================== -->

<!-- start left side bar
======================================== -->
<aside class="main-sidebar" id="boxscroll">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('getDashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            @if(checkRolePermission(ACTION_PRODUCT_VIEW,Auth::user()->role,actions()) || checkRolePermission(ACTION_PRODUCT_VIEW,Auth::user()->role,actions())
            || checkRolePermission(ACTION_CATEGORY_VIEW,Auth::user()->role,actions()) || checkRolePermission(ACTION_BRAND_VIEW,Auth::user()->role,actions())
            || checkRolePermission(ACTION_SUPPLIER_VIEW,Auth::user()->role,actions()) || checkRolePermission(ACTION_WAREHOUSE_VIEW,Auth::user()->role,actions())
            || checkRolePermission(ACTION_LOT_VIEW,Auth::user()->role,actions())
           )
            <li class="treeview product @if(isset($main_menu) && $main_menu=='product') menu-open @endif">
                <a href="#">
                    <i class="fa fa-barcode"></i>
                    <span>Product Management</span>
                    <span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
                </a>

                <ul class="treeview-menu" @if(isset($main_menu) && $main_menu=='product') style="display: block" @endif>

                    @if(checkRolePermission(ACTION_PRODUCT_VIEW,Auth::user()->role,actions()))
                        <li>
                            <a href="{{route('productList')}}">
                                <i class="fa fa-barcode"></i> <span>Product</span>
                            </a>
                        </li>
                    @endif
                    @if(checkRolePermission(ACTION_PRODUCT_VIEW,Auth::user()->role,actions()))
                        <li>
                            <a href="{{route('productBarcode')}}">
                                <i class="fa fa-barcode"></i> <span>Print Barcode</span>
                            </a>
                        </li>
                    @endif
                    @if(checkRolePermission(ACTION_CATEGORY_VIEW,Auth::user()->role,actions()))
                        <li>
                            <a href="{{route('listCategory')}}">
                                <i class="fa fa-folder"></i> <span>Category</span>
                            </a>
                        </li>
                    @endif
                    @if(checkRolePermission(ACTION_BRAND_VIEW,Auth::user()->role,actions()))
                        <li>
                            <a href="{{ route('brandList') }}">
                                <i class="fa fa-cubes"></i> <span> Brands </span>
                            </a>
                        </li>
                    @endif
                    @if(checkRolePermission(ACTION_SUPPLIER_VIEW,Auth::user()->role,actions()))
                        <li>
                            <a href="{{ route('allSupplier')}}">
                                <i class="fa fa-handshake"></i> <span> Suppliers </span>
                            </a>
                        </li>

                    @endif
                    @if(checkRolePermission(ACTION_WAREHOUSE_VIEW,Auth::user()->role,actions()))
                        <li>
                            <a href="{{route('warehouseList')}}">
                                <i class="fa fa-home"></i> <span> Warehouse </span>
                            </a>
                        </li>
                    @endif
                    @if(checkRolePermission(ACTION_LOT_VIEW,Auth::user()->role,actions()))

                        <li>
                            <a href="{{route('lotList')}}">
                                <i class="fa fa-linode"></i> <span> Lot </span>
                            </a>
                        </li>
                    @endif

                    {{--@if(checkRolePermission(ACTION_CSV_UPLOAD,Auth::user()->role,actions()))--}}
                    {{--<li>--}}
                    {{--<a href="{{route('csv')}}">--}}
                    {{--<i class="fa fa-upload"></i> <span>Product Upload(csv)</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--@endif--}}
                    {{--@if(checkRolePermission(ACTION_EXCEL_UPLOAD,Auth::user()->role,actions()))--}}
                    {{--<li>--}}
                    {{--<a href="{{route('excel')}}">--}}
                    {{--<i class="fa fa-cloud-upload"></i> <span>Product Upload(excel)</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--@endif--}}
                </ul>

            </li>
            @endif

            @if(checkRolePermission(ACTION_SELL_PRODUCT,Auth::user()->role,actions()) || checkRolePermission(ACTION_REPORT,Auth::user()->role,actions()))
            <li class="treeview sells @if(isset($main_menu) && $main_menu=='sell') menu-open @endif">
                <a href="#">
                    <i class="fa fa-sellcast"></i>
                    <span>Sells Managemant</span>
                    <span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
                </a>
                <ul class="treeview-menu" @if(isset($main_menu) && $main_menu=='sell') style="display: block" @endif>
                    @if(checkRolePermission(ACTION_SELL_PRODUCT,Auth::user()->role,actions()))
                        <li>
                            <a href="{{route('productPage')}}">
                                <i class="fa fa-dollar-sign"></i> <span>Sell Product</span>
                            </a>
                        </li>
                    @endif
                        @if(checkRolePermission(ACTION_REPORT,Auth::user()->role,actions()))
                    <li class="treeview @if(isset($sub_menu) && $sub_menu=='report') menu-open @endif">
                        <a href="#">
                            <i class="fa fa-flag-checkered"></i>
                            <span>Report</span>
                            <span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
                        </a>
                        <ul class="treeview-menu" @if(isset($sub_menu) && $sub_menu=='report') style="display: block" @endif>
                            <li><a href="{{route('todayReport')}}"><i class="fa fa-chart-pie"></i>Today's Sell</a></li>
                            <li><a href="{{route('monthlyReport')}}"><i class="fa fa-chart-pie"></i> Monthly Sell</a>
                            </li>
                            <li><a href="{{route('allReport')}}"><i class="fa fa-chart-pie"></i> Total Sell</a></li>
                        </ul>
                    </li>
                    @endif
                    {{--@if(checkRolePermission(ACTION_CUPON_VIEW,Auth::user()->role,actions()))--}}
                        {{--<li>--}}
                            {{--<a href="{{route('listCupon')}}">--}}
                                {{--<i class="fa fa-tags"></i> <span> Cupon </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                </ul>
            </li>
            @endif
            @if(checkRolePermission(ACTION_USER_VIEW,Auth::user()->role,actions()) || checkRolePermission(ACTION_ROLE_VIEW,Auth::user()->role,actions()))
            <li class="treeview users @if(isset($main_menu) && $main_menu=='users') menu-open @endif">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>User Management</span>
                    <span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
                </a>
                <ul class="treeview-menu" @if(isset($main_menu) && $main_menu=='users') style="display: block" @endif>
                    @if(checkRolePermission(ACTION_USER_VIEW,Auth::user()->role,actions()))
                        <li>
                            <a href="{{route('displayUser')}}">
                                <i class="fa fa-user"></i> <span>Users</span>
                            </a>
                        </li>
                    @endif
                    @if(checkRolePermission(ACTION_ROLE_VIEW,Auth::user()->role,actions()))
                        <li>
                            <a href="{{route('roleList')}}">
                                <i class="fa fa-superpowers"></i> <span>User Role</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(checkRolePermission(ACTION_SETTINGS,Auth::user()->role,actions()))
            <li>
                <a href="{{route('adminSetting')}}">
                    <i class="fa fa-laptop"></i> <span> Settings </span>
                </a>
            </li>
            @endif


        </ul>
    </section>
</aside>
<!-- start left side bar
======================================== -->

<!-- start main area
======================================== -->
<div class="main content-wrapper">
    <div class="content pt-0 pb-0">
        <div class="container-fluid">
            @yield('content')

        </div>
    </div>
</div>
<!-- end main area
======================================== -->

<!-- start footer area
======================================== -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4>{{allsetting()['footer']}}</h4>
            </div>
        </div>
    </div>
</footer>
<!-- end footer area
======================================== -->

<!-- jquery plugin -->

<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/dc-custom.js')}}"></script>
<script src="{{asset('assets/vendors/datatables/js/datatable.min.js')}}"></script>
<script src="{{asset('assets/vendors/datatables/js/datatables.min.js')}}"></script>
<script src="{{asset('assets/vendors/datatables/js/datatables.bootstrap.js')}}"></script>
<script src="{{asset('assets/vendors/datatables/js/table-datatables-responsive.js')}}"></script>

<script src="{{asset('assets/admin/js/admin.js')}}"></script>
<script src="{{asset('assets/vendors/scrollbar/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap-fileupload/bootstrap-fileupload.min.js')}}"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/loader.js')}}"></script>

{{--async defer></script>--}}

<script>
    var options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300000",
        "hideDuration": "100000",
        "timeOut": "500000",
        "extendedTimeOut": "100000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    @if(!empty(Session::get('success')))
    toastr.success('{{Session::get('success')}}', 'SUCCESS', options);
    @elseif(!empty(Session::get('error')))
    toastr.error('{{Session::get('success')}}', 'ERROR', options)
    @elseif(!empty(Session::get('dismiss')))
    toastr.error('{{Session::get('dismiss')}}', 'ERROR', options)
    @endif
</script>




<script>
    $(function () {
        // this will get the full URL at the address bar
        var url = window.location.href;

        // passes on every "a" tag
        $(".sidebar-menu a").each(function () {
            // checks if its the same on the address bar
            if (url == (this.href)) {
                $(this).closest("li").addClass("mnu-active");
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script src="{{asset('assets/js/custom.js')}}"></script>
@yield('script')

</body>
</html>