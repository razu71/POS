<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller

{
    public function allSupplier()
    {
        if (isset($_GET['search'])) $data['search'] = $_GET['search'];
        $data['suppliers'] = Supplier::orderby('id', 'desc');
        if (!empty($data['search'])) {
            $search_token = explode(' ', $data['search']);
            foreach ($search_token as $search) {
                $data['suppliers'] = $data['suppliers']->where(function ($query) use ($search) {
                    $query->where('suppliers.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('suppliers.email', 'LIKE', '%' . $search . '%')
                        ->orWhere('suppliers.address', 'LIKE', '%' . $search . '%')
                        ->orWhere('suppliers.mobile', 'LIKE', '%' . $search . '%');
                });
            }
        }
        $data['suppliers'] = $data['suppliers']->paginate(PAGINATE_SMALL);
        return view('supplier.list', $data);
    }

    public function addSupplier()
    {
        return view('supplier.addEdit');
    }

    public function editSupplier($id)
    {
        $data['supplier'] = Supplier::findOrFail($id);
        return view('supplier.addEdit', $data);
    }

    public function saveSupplier(Request $request)
    {
        $rules = ['name' => 'required|max:30', 'mobile' => 'required|size:11|regex:/(01)[0-9]{9}/'];
        if (!empty($request->email)) {
            $rules['email'] = 'email|max:255';
        }
        if (!empty($request->image)) {
            $rules['image'] = 'mimes:jpg,jpeg,png,PNG|max:1000';
        }
        if (!empty($request->trade_license)) {
            $rules['trade_license'] = 'mimes:jpg,jpeg,png,PNG|max:1000';
        }
        $message = [
            'name.required' => __('Name field must not be empty'),
            'name.max' => __('Name can\'t be more than 30 character'),

        ];

        $this->validate($request, $rules, $message);

        if (!empty($request->edit_id)) {
            $supp = Supplier::findOrFail($request->edit_id);
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
        ];

        if (!empty($request->image)) {
            $old_img = '';
            if (isset($supp)) {
                $old_img = $supp->image;
            }
            $data['image'] = fileUpload($request->file('image'), path_supplier(), $old_img);
        }

        if (!empty($request->trade_license)) {
            $old_license = '';
            if (isset($supp)) {
                $old_license = $supp->trade_license;
            }
            $data['trade_license'] = fileUpload($request->file('trade_license'), path_supplier(), $old_license);
        }
        if (!empty($request->edit_id)) {
            Supplier::where(['id' => $request->edit_id])->update($data);
            return redirect()->route('allSupplier')->with('success', __('Supplier Update successfully'));
        } else {
            Supplier::create($data);
            return redirect()->route('allSupplier')->with('success', __('New Supplier Add successfully'));
        }


        return redirect()->route('allSupplier')->with(['success', 'Create Successful!']);

    }


    public function viewSupplier($id)
    {
        $supplier = Supplier::find($id);
        return view('supplier.view', ['supplier' => $supplier]);
    }


    public function deleteSupplier($id)
    {
        $supplierId = Supplier::find($id);
        $supplierId->delete();

        return back()->with('message', ' Supplier Deleted successfully');
    }


}
