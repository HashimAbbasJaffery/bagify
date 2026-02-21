<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $banner = 'layout.parts.banner';
        return view("home", compact("banner"));
    }
}
