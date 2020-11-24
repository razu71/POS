<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\SubOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use PDF;

class OrderController extends Controller
{

    public function cartClear()
    {
        Session::forget('cart');
        return redirect()->route('productPage');
    }

    // save cart product and generate invoice
    public function saveOrder(Request $request)
    {

        $total_price = Input::get('total_price');
        $total_quantity = Input::get('total_quantity');
        $total_discount = Input::get('total_discount');
        $given_payment = Input::get('given_payment');
        $payment_type = Input::get('payment_type');
        $return_cash = Input::get('return_cash');

        $order = new Order;

        $order->total_price = $total_price;
        $order->total_quantity = $total_quantity;
        $order->total_discount = $total_discount;
        $order->given_payment = $given_payment;
        $order->payment_type = $payment_type;
        $order->return_cash = $return_cash;
        $order->seller_id = Auth::user()->id;
        $order->save();

        if (!empty($order->id)) {
            if (Session::has('cart')) {
                $cart = Session::get('cart');
                $array_key = array_keys($cart);
                $products = Product::whereIn('id', $array_key)->get();
                if ($products) {
                    foreach ($products as $product) {
                        Product::where(['id'=>$product->id])->decrement('qty', $cart[$product->id]);
                        SubOrder::create([
                            'order_id' => $order->id
                            , 'p_id' => $product->id
                            , 'discount' => $product->discount
                            , 'discount_type' => $product->discount_type
                            , 'price' => $product->price
                            , 'quantity' => $cart[$product->id]
                        ]);
                    }
                }
            }
        }
        Session::forget('cart');

        if ($order) {
            return redirect()->route('printInvoice')->with(
                ['products'=>$products,'cart'=>$cart,'order_no'=>$order->id,'invoice_date'=>$order->created_at]
            );
//            $pdf = PDF::loadView('product.print',['products'=>$products,'cart'=>$cart]);
//            return $pdf->stream('invoice.pdf');
//
//
//            return redirect()->back();
//            return response()->json([
//                'status' => 'success',
//                'total_price' => $total_price,
//                'total_quantity' => $total_quantity,
//                'total_discount' => $total_discount,
//                'given_payment' => $given_payment,
//                'payment_type' => $payment_type,
//                'return_cash' => $return_cash,
//                'seller_id' => $seller_id,
//            ]);
        } else {
            return response()->json([
                'status' => 'error']);
        }
    }

    // generate Invoice Pdf
    public function printInvoice(){
        return view('product.print');
    }
    // Remove cart item
    public function removeFromCart($id){
        if(isset($id)){
            if (Session::has('cart')) {
                $session_data = Session::get('cart');
                unset($session_data[$id]);
                Session::put('cart', $session_data);
            }
        }
        return redirect()->route('productPage');
    }

}
