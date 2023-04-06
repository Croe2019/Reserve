<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlpineController extends Controller
{
    public function index()
    {
        return view('alpine.index');
    }
}
