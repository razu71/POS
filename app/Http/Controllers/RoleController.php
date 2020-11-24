<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function roleAdd()
    {
        /*
         * Name: Naim
         * Date: 11/03/2018
         * Change: Add & Create role view
         */
        return view('role.addEdit');
    }

    public function roleSave(Request $request)
    {
        /*
         * Name: Naim
         * Date: 11/03/2018
         * Change: Add & Create role view
         */
        $notify = '';
        $rule = [
            'title' => 'required|max:256',
            'description' => 'required|max:256',
            'tasks' => 'required',
        ];
        $messages = [
            'title.required' => 'Title can\'t be empty.',
            'title.max' => 'Title field must be maximum 255 Character.',
            'description.max' => 'Description field must be maximum 255 Character.',
            'description.required' => 'Description can\'t be empty.',
            'tasks.required' => 'Task can\'t be empty',
        ];
//       dd($request->all());
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'tasks' => '|' . implode('|', $request->tasks) . '|',
            ];
            if (!empty($request->edit_id)) {
                Role::where(['id' => $request->edit_id])->update($data);
                $notify = 'Role Updated Successfully.';
            } else {
                Role::create($data);
                $notify = 'Role Created Successfully.';
            }
            return redirect()->route('roleList')->with('success', $notify);
        }
    }

    public function roleList()
    {
        /*
        * Name: Naim
        * Date: 11/03/2018
        * Change: Edit role view
        */
        $data['role_list'] = Role::Orderby('title', 'asc')->paginate(PAGINATE_SMALL, ['*'], 'p');
//       dd($data);
        return view('role.list', $data);
    }

    public function roleEdit($id)
    {
        /*
        * Name: Naim
        * Date: 11/03/2018
        * Change: Edit role view
        */
        $data['rolesEdit'] = Role::findOrFail($id);
        return view('role.addEdit', $data);
    }

    public function deleteRole($id)
    {
        $notify = '';
        try {
            if (!empty($id) && is_numeric($id)) {
                $role = Role::findOrFail($id);
                $role->delete();
                $notify = 'Role Delete Successfully.';
                return redirect()->back()->with('success', $notify);
            }
            return redirect()->back()->with(['dismiss', 'Delete not Successful!']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['dismiss' => 'Please delete all user under this role first!']);;
        }
    }
}
