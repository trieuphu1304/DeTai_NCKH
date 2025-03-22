<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        
    }

    public function index() {
        $template = 'fontend.contact.index';

        return view('fontend.layout', compact(
            'template'
        ));
    }
}