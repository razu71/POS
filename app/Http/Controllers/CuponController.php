<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    //
    public function addCupon()
    {
        return view('cupon.add');
    }

    public function editCupon($id)
    {
        $data['cupons'] = Coupon::find($id);
        return view('cupon.edit', $data);
    }

    public function updateCupon(Request $request)
    {
        $rules = [
            'coupon_number' => 'required',
        ];
        $message = [
            'coupon_number.required' => 'Input bust be  a coupon number',
        ];
        $this->validate($request, $rules, $message);
        $cupon = Coupon::find($request->cupon_id);
        $cupon->coupon_number = $request->coupon_number;
        $cupon->save();
        return redirect()->route('listCupon')->with(['success' => 'Coupon Updated successfully!']);
    }

    public function deleteCupon($id)
    {
        try {
            if (!empty($id)) {
                Coupon::where('id', $id)->delete();
                return redirect()->back()->with(['success', 'Delete Successful!']);
            }
            return redirect()->back()->with(['dismiss', 'Delete not Successful!']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['dismiss' => 'Opsss! Something wrong please try again']);
        }
    }

    public function listCupon()
    {
        $data['cupons'] = Coupon::where('status', CUPON_STATUS_ACTIVE)->paginate(PAGINATE_SMALL);
        return view('cupon/list', $data);
    }

    public function saveCupon(Request $request)
    {
        $rules = [
            'amount' => 'required',
        ];
        if (!empty($request->prefix)) {
            $rules['prefix'] = 'alpha';
        }

        $message = [
            'prefix.alpha' => 'Must be a character',
            'amount.required' => 'Must be input a number',
        ];
        $this->validate($request, $rules, $message);
        $prefix = $request->prefix;
        $amount = $request->amount;
        if ($amount > 0 && !empty($amount) && !empty($prefix)) {
            for ($i = 1; $i <= $amount; $i++) {
                $coupon = $prefix . '_' . randomString(30);
                $data = [
                    'coupon_number' => $coupon,
                ];
                Coupon::create($data);
            }
        }

        if (!empty($amount) && empty($prefix)) {
            for ($i = 1; $i <= $amount; $i++) {
                $coupon = 'Cuopon' . '_' . randomString(30);
                $data = [
                    'coupon_number' => $coupon,
                ];
                Coupon::create($data);
                return redirect()->route('listCupon')->with(['success' => 'Create Successful!']);
            }
        }
        return redirect()->route('listCupon')->with(['success' => 'Create Successful!']);

    }
}
