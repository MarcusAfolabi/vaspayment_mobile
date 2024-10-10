<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
 
    public function index()
    {
        return view("dashboard.index");
    }

    public function virtualAccount()
    {
        return view("dashboard.virtual-account");
    }

    public function airtime()
    {
        return view("airtime.index");
    }
}
