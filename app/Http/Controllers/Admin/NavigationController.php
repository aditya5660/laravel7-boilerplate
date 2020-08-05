<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NavigationRequest;
use App\Models\Navigation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
class NavigationController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // check user permission
        if (!request()->user()->can('read-navigation')) {
            abort(403);
        }
        // set page title
        $data['pageTitle'] = 'Navigation';
        // get data
        $data['navigations'] = Navigation::with('children')->where('parent_id',0)->orderBy('order', 'asc')->paginate(10);
        // render view
        return view('admin.navigations.index')->with($data);
    }

    public function create()
    {
        // check user permission
        if (!request()->user()->can('create-navigation')) {
            abort(403);
        }
        // set page title
        $data['pageTitle'] = 'Create Navigation';
        // get data
        $data['navigations'] = Navigation::where('parent_id',0)->get();
        $data['permissions'] = Permission::all();
        // render view
        return view('admin.navigations.create')->with($data);
    }

    public function store(NavigationRequest $request)
    {
        // store data
        $navigation = Navigation::create([
            'parent_id' => $request->parent_id,
            'url' => $request->url,
            'icon' => $request->icon,
            'name' => $request->name,
            'order' => $request->order,
            'permission_name' => $request->permission_name,
        ]);
        if($navigation->save()){
            session()->flash('success',$navigation->name .' navigation Has Been Created');
            return redirect()->route('admin.navigations.index');
        }else{
            session()->flash('error','There was an error when creating the role');
            return redirect()->route('admin.navigations.create');
        }
    }

    public function edit(Navigation $navigation)
    {
        // check user permission
        if (!request()->user()->can('update-navigation')) {
            abort(403);
        }
        // set pageTitle
        $data['pageTitle']  = 'Edit Navigation';
        // get data
        $data['navigation']  = $navigation;
        $data['navigations'] = Navigation::where('parent_id',0)->get();
        $data['permissions'] = Permission::all();
        /// render View
        return view('admin.navigations.edit')->with($data);
    }

    public function update(NavigationRequest $request, Navigation $navigation)
    {
        // set data
        $navigation->parent_id = $request->parent_id;
        $navigation->url = $request->url;
        $navigation->icon = $request->icon;
        $navigation->name = $request->name;
        $navigation->order = $request->order;
        $navigation->permission_name = $request->permission_name;
        if($navigation->save()){
            session()->flash('success',$navigation->name .' Navigation Has Been Updated');
        }else{
            session()->flash('error','There was an error when updating the navigation');
        }
        return redirect()->route('admin.navigations.index');
    }

    public function destroy(Navigation $navigation)
    {
        // check user permission
        if (!request()->user()->can('delete-navigation')) {
            abort(403);
        }
        if($navigation->delete()){
            session()->flash('warning',$navigation->name .' Navigation Has Been Delete');
        }else{
            session()->flash('error','There was an error when deleting the navigation');
        }
        return redirect()->route('admin.navigations.index');

        
    }
}
