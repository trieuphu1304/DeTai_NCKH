<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        
    }

    public function layout() {
        $template = 'backend.home.index';
        return view('backend.layout', compact(
            'template'
        ));
    }
}