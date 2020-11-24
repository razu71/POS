<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\SubOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    {
        /*
       * Name: Naim
       * Date: 24/03/2018
       * Change: This function for showing the all  report data
       */
        $all_settings = allsetting();
        if (!empty($request->year)) {
            $data['year'] = $request->year;
        } else {
            $data['year'] = date('Y');
        }
        if (!empty($request->month)) {
            $data['month'] = $request->month;
        } else {
            $data['month'] = date('m');
        }

        $data['daily_report'] = Order::select(DB::raw('SUM(total_quantity) as qty'), DB::raw('SUM(total_discount) as discount'), DB::raw('SUM(total_price) as price'))->whereDate('created_at', date('Y-m-d'))->first();
        $data['monthly_report'] = Order::select(DB::raw('SUM(total_quantity) as qty'), DB::raw('SUM(total_discount) as discount'), DB::raw('SUM(total_price) as price'))->whereMonth('created_at', date('m'))->first();
        $data['total_report'] = Order::select(DB::raw('SUM(total_quantity) as qty'), DB::raw('SUM(total_discount) as discount'), DB::raw('SUM(total_price) as price'))->first();

        $data['today_sell'] = SubOrder::join('products', 'products.id', '=', 'sub_orders.p_id')
            ->select('products.title', DB::raw('sum(sub_orders.price) as s_amount'), 'sub_orders.p_id')
            ->whereDate('sub_orders.created_at', date('Y-m-d'))
            ->groupBy('sub_orders.p_id')
            ->orderBy('s_amount', 'desc')
            ->take(5)
            ->get();

        $data['logo'] = $all_settings['image'];
        $data['currency'] = $all_settings['currency'];
        $data['top_selling_item'] = SubOrder::join('products', 'products.id', '=', 'sub_orders.p_id')
            ->select('products.title', DB::raw('sum(sub_orders.quantity) as qty'), 'sub_orders.p_id')
//            ->whereDate('sub_orders.created_at',date('Y-m-d'))
            ->groupBy('sub_orders.p_id')
            ->orderBy('qty', 'desc')
            ->take(5)
            ->get();

        $data['monthly_sell_revenue'] = Order::select(DB::raw('sum(total_price) as total_sell'), DB::raw('MONTH(created_at) as m'));
        if (!empty($data['year'])) {
            $data['monthly_sell_revenue'] = $data['monthly_sell_revenue']->where(DB::raw('YEAR(created_at)'), $data['year']);
        }
        $data['monthly_sell_revenue'] = $data['monthly_sell_revenue']->groupBy(DB::raw('MONTH(created_at)'))
            ->get();
        $data['monthly_sell'] = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0];
        $data['total_years'] = Order::select(DB::raw('YEAR(created_at) as y'))->groupBy(DB::raw('YEAR(created_at)'))->orderBy('y', 'desc')->get();

        if (isset($data['monthly_sell_revenue'][0])) {
            foreach ($data['monthly_sell_revenue'] as $ms) {
                $data['monthly_sell'][$ms->m] = floatval($ms->total_sell);
            }
        }
        $data['monthly_sell_qty'] = SubOrder::join('products', 'products.id', '=', 'sub_orders.p_id')->select(DB::raw('sum(sub_orders.quantity) as total_qty'), 'products.title')
            ->groupBy('sub_orders.p_id')
            ->where(DB::raw('MONTH(sub_orders.created_at)'), $data['month'])
            ->take(20)
            ->get();


        if (isset($data['monthly_sell_qty'][0])) {
            foreach ($data['monthly_sell_qty'] as $msq) {
                $data['monthly_qty'][$msq->m] = floatval($msq->total_sell);
            }
        }
        $data['yearly_sell'] = Order::select(DB::raw('sum(total_price) as total_sell'), DB::raw('YEAR(created_at) as y'))
            ->groupBy(DB::raw('YEAR(created_at)'))->get();

        return view('dashboard.dashboard', $data);
    }

    public function todayReport()
    {
        $data['reports'] = SubOrder::leftjoin('products', 'products.id', '=', 'sub_orders.p_id')
            ->select(
                'sub_orders.*',
                'products.title',
                'products.sku'
            )
            ->whereDate('sub_orders.created_at', date('Y-m-d'))->paginate(PAGINATE_SMALL);
        return view('report.list', $data);
    }

    public function monthlyReport()
    {
        $data['reports'] = SubOrder::leftjoin('products', 'products.id', '=', 'sub_orders.p_id')
            ->select('sub_orders.*', 'products.title', 'products.sku')
            ->whereMonth('sub_orders.created_at', date('m'))->paginate(PAGINATE_SMALL);
        return view('report.list', $data);
    }

    public function allReport()
    {
        $data['reports'] = SubOrder::leftjoin('products', 'products.id', '=', 'sub_orders.p_id')
            ->select('sub_orders.*', 'products.title', 'products.sku')
            ->paginate(PAGINATE_SMALL);
        return view('report.list', $data);
    }
}