<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class RegionController extends Controller
{
    public function create()
    {
        return view('region/create');        
    }
}
