<?php

namespace App\Http\Controllers;


use App\Models\Department;


use Illuminate\Http\Request;

use App\Http\Requests;

class departmentController extends Controller
{
    public function addDepartment(Department $department)
    {
    	$department->department_name = 'Management';
    	$department->department_logo = 'dept_logo1.jpg';
    	$department->save();
    	return 'Department stored successfully';
    }
}
