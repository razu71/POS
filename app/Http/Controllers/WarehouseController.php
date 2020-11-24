<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function warehouseList()
    {
        if (isset($_GET['search'])) $data['search'] = $_GET['search'];
        $data['warehouses'] = Warehouse::orderby('id', 'desc');
        if (!empty($data['search'])) {
            $search_token = explode(' ', $data['search']);
            foreach ($search_token as $search) {
                $data['warehouses'] = $data['warehouses']->where(function ($query) use ($search) {
                    $query->where('warehouses.name', 'LIKE', '%' . $search . '%');
                });
            }
        }
        $data['warehouses'] = $data['warehouses']->paginate(PAGINATE_SMALL);
        return view('warehouse.list', $data);
    }

    public function addWarehouse()
    {
        $data['title']='Add Warehouse';
        return view('warehouse.addEdit',$data);
    }

    public function editWarehouse($id)
    {
        $data['title']='Update Warehouse';
        $data['warehouses'] = Warehouse::find($id);
        return view('warehouse.addEdit', $data);
    }

    public function saveWarehouse(Request $request)
    {
        $notify = '';
        $rules = [
            'name' => 'required|max:30',
            'slug' => 'max:10',
        ];

        $message = [
            'name.required' => __('Must be Fillup the name field'),
            'name.max' => __('Name length can\'t be more than 30 char'),
            'slug.max' => __('Slug length can\'t be more than 10 char'),
        ];
        $this->validate($request, $rules, $message);
        $data = [
            'name' => $request->name,
            'slug' => $request->slug
        ];
        if (!empty($request->w_id)) {
            Warehouse::where(['id' => $request->w_id])->update($data);
            $notify = __('Warehouse Updated Successfully.');
        } else {
            Warehouse::create($data);
            $notify = __('Warehouse Created Successfully.');
        }
        return redirect()->route('warehouseList')->with('success', $notify);
    }

    public function deleteWarehouse($id)
    {
        try {
            if (!empty($id) && is_numeric($id)) {
                $warehouse = Warehouse::findOrFail($id);
                $warehouse->delete();
                return redirect()->back()->with('success', __('Delete Successful!'));
            }
            return redirect()->back()->with('dismiss', __('Delete not Successful!'));
        } catch (\Exception $e) {
            return redirect()->back()->with('dismiss', __('Opsss! Something wrong please try again'));
        }
    }

    public function warehouseActiveInactive(Request $request)
    {
        if (!empty($request->active_id) && is_numeric($request->active_id)) {
            $war = Warehouse::findOrFail($request->active_id);
            if ($war->status == CATEGORY_ACTIVE) {
                $war->status = CATEGORY_INACTIVE;
            } elseif ($war->status == CATEGORY_INACTIVE) {
                $war->status = CATEGORY_ACTIVE;
            }
            $war->save();
        }
        return redirect()->back()->with('success', __('Update Successfully'));
    }
}
