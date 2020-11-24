<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function listCategory()
    {
        /*
        * Name: Naim
        * Date: 03/02/2018
        * Change: The all category show & view in this function
        */
        if (isset($_GET['search'])) $data['search'] = $_GET['search'];
        $data['categorys_list'] = Category::OrderBy('title', 'asc');
        if (!empty($data['search'])) {
            $search_token = explode(' ', $data['search']);
            foreach ($search_token as $search) {
                $data['categorys_list'] = $data['categorys_list']->where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
                });
            }
        }

        $data['categorys_list'] = $data['categorys_list']->paginate(PAGINATE_SMALL, ['*'], 'p');
        return view('category.list', $data);
    }

    public function addCategory()
    {
        /*
        * Name: Naim
        * Date: 03/02/2018
        * Change: Add category View Page
        */
        $data['categorys'] = Category::whereNull('parent_id')->get();
        return view('category.addEdit', $data);
    }

    public function editCategory($id)
    {
        /*
        * Name: Naim
        * Date: 03/02/2018
        * Change: The all category show & view in this function
        */
        $data['categoryEdit'] = Category::findOrFail($id);
        $data['categorys'] = Category::whereNull('parent_id')->get();
        return view('category.addEdit', $data)
            ->with(['success' => 'Edit Successful!']);
    }

    public function deleteCategory($id)
    {
        /*
        * Name: Naim
        * Date: 03/02/2018
        * Change: Delete && Remove the category function
        */
        try {
            if (!empty($id)) {
                Category::where('id', $id)->delete();
                return redirect()->back()->with(['success' => 'Delete Successful!']);
            }
            return redirect()->back()->with(['dismiss' => 'Delete not Successful!']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['dismiss' => 'Please delete all the product under this category first!']);;
        }
    }

    public function saveCategory(Request $request)
    {
        /*
        * Name: Naim
        * Date: 03/02/2018
        * Change: Save category Item in here
        */

        $rules = [
            'title' => 'required|max:255'
        ];


        $messages = [
            'title.required' => 'Title can\'t be empty.',
            'title.max' => 'Title field must be maximum 255 Character'
        ];

        if ($request->image) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            $messages['image.image'] = 'This is not valid image file';
            $messages['image.max'] = 'Image size is to much big!';
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $data = [
                'title' => $request->title,
                'parent_id' => $request->parent_id
            ];
            if ($request->image) {
                $data['image'] = fileUpload($request->file('image'), 'upload');
            }
            if (!empty($request->edit_id)) {
                Category::where(['id' => $request->edit_id])->update($data);
                $message='Updated Successful!';
            } else {
                Category::create($data);
                $message='Create Successful!';
            }

            return redirect()->route('listCategory')->with(['success' => $message]);
        }
    }

    public function activeInactive(Request $request)
    {
        if (!empty($request->active_id) && is_numeric($request->active_id)) {
            $cat = Category::findOrFail($request->active_id);
            if ($cat->status == CATEGORY_ACTIVE) {
                $cat->status = CATEGORY_INACTIVE;
            } elseif ($cat->status == CATEGORY_INACTIVE) {
                $cat->status = CATEGORY_ACTIVE;
            }
            $cat->save();
        }
        return redirect()->back()->with(['success' => 'Update Successfully']);
    }
}
