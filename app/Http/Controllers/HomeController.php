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
    public function userProfile()
    {
        return view("dashboard.user.profile");
    }
    public function userAccount()
    {
        return view("dashboard.user.account");
    }
    
    public function userBeneficiaries()
    {
        return view("dashboard.user.beneficiary");
    }
    
    public function userPassword()
    {
        return view("dashboard.user.password");
    }
    
    public function userSetting()
    {
        return view("dashboard.user.settings");
    }
    
    public function userHelpdesk()
    {
        return view("dashboard.user.helpdesk");
    }
    
    public function virtualAccount()
    {
        return view("dashboard.virtual-account");
    }

    public function allProducts()
    {
        return view("dashboard.products");
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
    public function transfer()
    {
        return view("transfer.index");
    }
    
    public function powerTransactions()
    {
        return view("power.transactions");
    }
    public function allInsight()
    {
        return view("dashboard.blog.index");
    }
    public function showInsight($slug)
    {
        return view("dashboard.blog.show", compact('slug'));
    }
}
