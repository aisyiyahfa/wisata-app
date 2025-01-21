<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function superAdmin(){    
        return view('pages.admin.dashboard');    
    }
    function ketua(){    
        return view('pages.admin.dashboard');    
    }
    function bendahara1(){    
        return view('pages.admin.dashboard');    
    }
    function bendahara2(){
        return view('pages.admin.dashboard');
    }
    function pengunjung(){
        return view('pages.admin.dashboard');
    }
}
