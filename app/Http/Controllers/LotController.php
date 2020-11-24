<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LotController extends Controller
{
    public function lotList()
    {

        if (isset($_GET['wh'])) $data['wh'] = $_GET['wh'];
        if (isset($_GET['search'])) $data['search'] = $_GET['search'];
        $data['lots'] = Lot::join('warehouses', 'warehouses.id', '=', 'lots.warehouse_id')
            ->select(
                'lots.*', 'warehouses.name as warehouse_name'
            );
        if (!empty($_GET['wh'])) {
            $data['lots'] = $data['lots']->where(['lots.warehouse_id' => $data['wh']]);
        }
        if (!empty($data['search'])) {
            $search_token = explode(' ', $data['search']);
            foreach ($search_token as $search) {
                $data['lots'] = $data['lots']->where(function ($query) use ($search) {
                    $query->where('lots.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('warehouses.name', 'LIKE', '%' . $search . '%');
                });
            }
        }
        $data['lots'] = $data['lots']->paginate(PAGINATE_SMALL);
        $data['warehouse'] = Warehouse::where('status', WAREHOUSE_STATUS_ACTIVE)->get();
        return view('lot.list', $data);
    }

    public function addLot()
    {
        $data['title']='Update Lot';
        $data['warehouse'] = Warehouse::where('status', WAREHOUSE_STATUS_ACTIVE)->get();
        return view('lot.addEdit', $data);
    }

    public function editLot($id)
    {
        $data['title']='Update Lot';
        $data['lots'] = Lot::find($id);
        $data['warehouse'] = Warehouse::where('status', WAREHOUSE_STATUS_ACTIVE)->get();
        return view('lot.addEdit', $data);
    }

    public function saveLot(Request $request)
    {
        $rules = ['name' => 'required|max:30', 'warehouse_id' => 'required'];
        $message = [
            'name.required' => __('Must be Fillup the name field'),
            'name.max' => __('Name length can\'t be more than 30 char'),
            'warehouse_id.required' => __('Warehouse can\'t be empty'),
        ];
        $this->validate($request, $rules, $message);
        $data = ['name' => $request->name, 'warehouse_id' => $request->warehouse_id];
        if (!empty($request->lot_id)) {
            Lot::where(['id' => $request->lot_id])->update($data);
            return redirect()->route('lotList')->with('success', __('Lot Update Successfully'));
        } else {
            Lot::create($data);
            return redirect()->route('lotList')->with('success', __('Lot Created Successfully'));
        }
        return redirect()->route('lotList')->with(['success', __('Create Successful!')]);
    }

    public function deleteLot($id)
    {
        try {
            if (!empty($id)) {
                Lot::where('id', $id)->delete();
                return redirect()->back()->with('success', __('Delete Successful!'));
            }
            return redirect()->back()->with('dismiss', __('Delete not Successful!'));
        } catch (\Exception $e) {
            return redirect()->back()->with('dismiss', __('Opsss! Something wrong please try again'));
        }
    }

    public function lotActiveInactive(Request $request)
    {
        if (!empty($request->active_id) && is_numeric($request->active_id)) {
            $lot = Lot::findOrFail($request->active_id);
            if ($lot->status == CATEGORY_ACTIVE) {
                $lot->status = CATEGORY_INACTIVE;
            } elseif ($lot->status == CATEGORY_INACTIVE) {
                $lot->status = CATEGORY_ACTIVE;
            }
            $lot->save();
        }
        return redirect()->back()->with('success', __('Update Successfully'));
    }
}
