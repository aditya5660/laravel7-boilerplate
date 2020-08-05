<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        // set page title
        $data['pageTitle'] = "Permission";
        // get data
        $data['permissions'] = Permission::paginate(20);
        // render view
        return view('permission.permissions.index')->with($data);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
        ]);

        Permission::create([
            'name' => request('name'),
            'guard_name' => request('guard_name') ?? 'web',
        ]);

        return back();
    }

    public function edit(Permission $permission)
    {
        // set page title
        $data['pageTitle'] = "Edit Permission";
        // get data
        $data['permission'] = $permission;
        // render view
        return view('permission.permissions.edit')->with($data);
    }


    public function update(Permission $permission)
    {
        request()->validate([
            'name' => 'required',
        ]);

        $permission->update([
            'name' => request('name'),
            'guard_name' => request('guard_name') ?? 'web',
        ]);

        return redirect()->route('permissions.index');
    }

    public function destroy()
    {
        # code...
    }
}
