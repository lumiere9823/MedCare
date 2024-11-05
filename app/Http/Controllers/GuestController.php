<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function viewHealthDirectory()
    {
        return view('guest.health-directory');
    }

    public function viewInsurancePlans()
    {
        return view('guest.insurance-plans');
    }
}