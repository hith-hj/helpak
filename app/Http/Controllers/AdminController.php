<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public static function index(){
        return self::show();
    }

    private static function show(){
        return view('admin/dash');
    }

}
