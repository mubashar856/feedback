<?php

namespace App\Http\Controllers;


use App\Models\Department;


use Illuminate\Http\Request;

use App\Http\Requests;

class departmentController extends Controller
{

	public function showEditDepartment($id)
    {
        $department = Department::find($id);

        return view('admin.editDepartment', compact('department'));

    }

    public function editDepartment(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required| exists:departments,id',
            'department_name' => 'required',
            'department_logo' => 'max:2048|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $department = Department::find($request->department_id);

        $department->department_name = $request->department_name;

        if ($request->department_logo != '') {
            $department_logo_name = $department->department_logo;
            if(unlink(public_path('uploads/department/'.$department->department_logo))){
                $request->department_logo->move(public_path('uploads/department'), $department_logo_name);
            }
        }
        $department->UPDATE();
        return redirect('/admin/departments');
    }


    public function removeDepartment($id)
    {      
        $department = Department::find($id);
        if (unlink(public_path('uploads/department/'.$department->department_logo))) {
            if ($department->DELETE()) {
                session()->flash('success', 'Department deleted successfully');
            }else{
                session()->flash('danger', 'Error occured while deleting department');
            }
        }

        return back();
    }


    public function showAddDepartment()
    {
        return view('admin.addDepartment');
    }

    public function addDepartment(Request $request)
    {
        $this->validate($request, [
            'department_name' => 'required',
            'department_logo' => 'required|max:2048|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $department = new Department();

        $department_logo_name = $request->department_name.'-'.rand(100, 999).'.'.$request->department_logo->getClientOriginalExtension();

        $request->department_logo->move(public_path('uploads/department'), $department_logo_name);

        $department->department_name = $request->department_name;

        $department->department_logo = $department_logo_name;

        $department->save();

        $request->session()->flash('success', 'Department added successfully');

        return back();
    }


    public function showDepartments()
    {
    	$departments = Department::all();
    	return view('admin.showDepartments', compact('departments'));
    }

    public function showDeparmentProfile($id)
    {
        $department = Department::find($id);

        return view('admin.departmentProfile', compact('department'));
    }


}
