<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Admin\RoleRequest;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // check user permission
        if (!request()->user()->can('read-role')) {
            abort(403);
        }
        // get data
        $data['roles'] = Role::paginate(10);
        // render view
        return view('admin.roles.index')->with($data);
    }

    public function create()
    {
        // check user permission
        if (!request()->user()->can('create-role')) {
            abort(403);
        }
        // render view
        return view('admin.roles.create');
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);
        if($role->save()){
            session()->flash('success',$role->name .' Role Has Been Created');
            return redirect()->route('admin.roles.index');
        }else{
            session()->flash('error','There was an error when creating the role');
            return redirect()->route('admin.roles.create');
        }
    }

    public function edit(Role $role)
    {
        // check user permission
        if (!request()->user()->can('update-role')) {
            abort(403);
        }
        // get data
        $data['role']       = $role;
        /// render View
        return view('admin.roles.edit')->with($data);
    }

    public function update(Request $request, Role $role)
    {
        // set data
        $role->name = $request->name;
        if($role->save()){
            session()->flash('success',$role->name .' Role Has Been Updated');
        }else{
            session()->flash('error','There was an error when updateing the role');
        }
        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        // check user permission
        if (!request()->user()->can('delete-role')) {
            abort(403);
        }
        if($role->delete()){
            session()->flash('warning',$role->name .' Role Has Been Delete');
        }else{
            session()->flash('error','There was an error when deleting the role');
        }
        return redirect()->route('admin.roles.index');
    }
}
