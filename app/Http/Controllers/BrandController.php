<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    /*
         * Name: Sd Bacchu
         * Date: 03/03/18
         * Change: Brand add, show, update, delete
         */
    public function brandList()
    {
        if (isset($_GET['search'])) $data['search'] = $_GET['search'];
        $data['brands'] = Brand::orderby('id', 'desc');
        if (!empty($data['search'])) {
            $search_token = explode(' ', $data['search']);
            foreach ($search_token as $search) {
                $data['brands'] = $data['brands']->where(function ($query) use ($search) {
                    $query->where('brands.name', 'LIKE', '%' . $search . '%');
                });
            }
        }

        $data['brands'] = $data['brands']->paginate(PAGINATE_SMALL);
        return view('brand.list', $data);
    }

    public function addBrand()
    {
        $data['title']='Add Brand';
        return view('brand.addEdit',$data);
    }

    public function editBrand($id)
    {
        $data['title']='Update Brand';
        $data['brands'] = Brand::find($id);
        return view('brand.addEdit', $data);
    }

    public function saveBrand(Request $request)
    {
        $rules = ['name' => 'required|max:30'];

        if (!empty($request->image)) {
            $rules['image'] = 'mimes:jpg,jpeg,png,PNG|max:1000';
        }
        $message = [
            'name.required' => 'Name field must not be empty',
            'name.max' => 'Name can\'t be more than 30 character'
        ];

        $this->validate($request, $rules, $message);

        if (!empty($request->edit_id)) {
            $supp = Brand::findOrFail($request->edit_id);
        }

        $data = ['name' => $request->name];

        if (!empty($request->image)) {
            $old_img = '';
            if (isset($supp)) {
                $old_img = $supp->image;
            }
            $data['image'] = fileUpload($request->file('image'), path_brand(), $old_img);
        }

        if (!empty($request->edit_id)) {
            Brand::where(['id' => $request->edit_id])->update($data);
            return redirect()->route('brandList')->with('success', 'Brand Update successfully');
        } else {
            Brand::create($data);
            return redirect()->route('brandList')->with('success', 'New Brand Added successfully');
        }

        return redirect()->route('brandList')->with(['success', 'Create Successful!']);
    }

    public function deleteBrand($id)
    {
        $brandId = Brand::findOrFail($id);
        $brandId->delete();
        return back()->with('success', ' Brand Deleted successfully');
    }

    public function brandActiveInactive(Request $request)
    {
        if (!empty($request->active_id) && is_numeric($request->active_id)) {
            $brd = Brand::findOrFail($request->active_id);
            if ($brd->status == CATEGORY_ACTIVE) {
                $brd->status = CATEGORY_INACTIVE;
            } elseif ($brd->status == CATEGORY_INACTIVE) {
                $brd->status = CATEGORY_ACTIVE;
            }
            $brd->save();
        }
        return redirect()->back()->with(['success' => 'Update Successfully']);
    }

}
