<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IpFilterController extends Controller
{
    public function index()
    {
        return view('content.pages.ipfilter');
    }
}
