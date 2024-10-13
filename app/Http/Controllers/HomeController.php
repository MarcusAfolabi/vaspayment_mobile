<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view("dashboard.index");
    }
    public function userNotification()
    {
        return view("dashboard.notifications");
    }

    public function virtualAccount()
    {
        return view("dashboard.virtual-account");
    }

    public function airtime()
    {
        return view("airtime.index");
    }
    public function airtimeTransactions()
    {
        return view("airtime.transactions");
    }
    public function data()
    {
        return view("data.index");
    }
    public function dataTransactions()
    {
        return view("data.transactions");
    }
    public function cable()
    {
        return view("cable.index");
    }
    public function cableTransactions()
    {
        return view("cable.transactions");
    }
    public function power()
    {
        return view("power.index");
    }
    public function powerTransactions()
    {
        return view("power.transactions");
    }
}
