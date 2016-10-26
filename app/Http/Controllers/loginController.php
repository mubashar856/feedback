<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function checkRole(){
        if(Auth::user()->role == 'admin'){
            return redirect('/admin');
        }else if(Auth::user()->role == 'teacher'){
            return redirect('/teacher');
        }
    }
}
