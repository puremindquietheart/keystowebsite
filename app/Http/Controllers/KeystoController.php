<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeystoController extends Controller
{
    public function index() {
        return view('keysto-website.index');
    }
}
