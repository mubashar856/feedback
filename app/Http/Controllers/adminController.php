<?php

namespace App\Http\Controllers;

use App\Models\Teacher;

use App\Models\Department;

use App\Models\Subject;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;


class adminController extends Controller
{


    public function logout(){
        Auth::logout();

        return redirect('/');
    }

    

}
