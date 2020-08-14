<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // check user permission
        if (!request()->user()->can('read-dashboard')) {
            abort(403);
        }
        // Render View
        return view('admin.dashboard.index');
    }
}
