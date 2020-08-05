<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Set Page Title
        $data['pageTitle'] = 'Dashboard';
        // Render View
        return view('admin.dashboard.index')->with($data);
    }
}
