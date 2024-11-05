<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthAtoZController extends Controller
{
    public function index()
    {
        // Logic to retrieve diseases and symptoms
        return view('healthAtoZ.index');
    }
}