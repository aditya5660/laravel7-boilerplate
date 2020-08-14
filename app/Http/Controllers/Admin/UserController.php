<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // List User
    public function index()
    {
        // check user permission
        if (!request()->user()->can('read-user')) {
            abort(403);
        }
        // get data
        $data['users'] = User::with('roles')->paginate(10);
        // render View
        return view('admin.users.index')->with($data);
    }

    // Page Create User
    public function create()
    {
        // check user permission
        if (!request()->user()->can('create-user')) {
            abort(403);
        }
        // get data
        $data['roles'] = Role::all();
        /// render View
        return view('admin.users.create')->with($data);
    }

    // Process Create User
    public function store(UserRequest $request, User $user)
    {
        // create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // create role
        $user->assignRole($request->role);
        // store user
        if($user->save()){
            session()->flash('success', $user->name .' User Has Been Created');
            return redirect()->route('admin.users.index');
        }else{
            session()->flash('error','There was an error when creating the user');
            return redirect()->route('admin.users.create');
        }
    }
    // Page Edit User
    public function edit(User $user)
    {
        // check user permission
        if (!request()->user()->can('update-user')) {
            abort(403);
        }
        // get data
        $data['roles'] = Role::all();
        $data['user']  = $user;
        /// render View
        return view('admin.users.edit')->with($data);
    }

    // Process Edit User
    public function update(Request $request, User $user)
    {
        // sync role
        $user->syncRoles($request->role);
        // get data user
        $user->name = $request->name;
        $user->email = $request->email;
        // store user
        if($user->save()){
            session()->flash('success',$user->name .' User Has Been Updated');
        }else{
            session()->flash('error','There was an error when updateing the user');
        }
        return redirect()->route('admin.users.index');
    }

    // Process Delete User
    public function destroy(User $user)
    {
        // check user permission
        if (!request()->user()->can('delete-user')) {
            abort(403);
        }
        if (auth()->user()->id == $user->id) {
            session()->flash('error','This user was loggined');
            return redirect()->route('admin.users.index');
        }
        if($user->delete()){
            session()->flash('warning', $user->name .' User Has Been Delete');
        }else{
            session()->flash('error','There was an error when deleting the user');
        }
        return redirect()->route('admin.users.index');
    }

    // Page Role Permission
    public function rolePermission(Request $request)
    {
        $role = $request->get('role');
        //Default, set dua buah variable dengan nilai null
        $pageTitle = 'Role Permission';
        $permissions = null;
        $hasPermission = null;
        //Mengambil data role
        $roles = Role::all()->pluck('name');
        //apabila parameter role terpenuhi
        if (!empty($role)) {
            //select role berdasarkan namenya, ini sejenis dengan method find()
            $getRole = Role::findByName($role);
            //Query untuk mengambil permission yang telah dimiliki oleh role terkait
            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name','permissions.id')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();
            //Mengambil data permission
            $permissions = Permission::all();
        }
        return view('admin.users.role_permission')->with([
            'roles' => $roles, 
            'permissions' => $permissions, 
            'hasPermission' => $hasPermission
        ]);
    }

    // Process Add Permission
    public function addPermission(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:permissions'
        ]);
        $permission = Permission::firstOrCreate([
            'name' => $request->name
        ]);
        return redirect()->back();
    }

    // Process Set Permission
    public function setRolePermission(Request $request, $role)
    {
        //select role berdasarkan namanya
        $roles = Role::findByName($role);   
        //kemudian di-assign kembali sehingga tidak terjadi duplicate data
        $roles->syncPermissions($request->permission);
        return redirect()->back()->with(['success' => 'Permission to Role Saved!']);
    }

    // Process Delete Permission
    public function destroyPermission(Permission $permission)
    {
        if($permission->delete()){
            session()->flash('warning', $permission->name .' Permission Has Been Delete');
        }else{
            session()->flash('error','There was an error when deleting the Permission');
        }
        return redirect()->back();
    }
}
