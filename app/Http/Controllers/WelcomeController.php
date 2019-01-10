<?php

namespace App\Http\Controllers;

use App\Current;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $currents = Current::all();

        return view('welcome', compact('currents'));
    }
}
