<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    protected $models = ['roles','admins','users','product_categories','products','tags','reviews','coupons'];
    protected $permissionMaps = ['create', 'read', 'update', 'delete'];

    public function __construct()
    {
        $this->middleware('permission:read_roles')->only(['index']);
        $this->middleware('permission:create_roles')->only(['create', 'store']);
        $this->middleware('permission:update_roles')->only(['edit', 'update']);
        $this->middleware('permission:delete_roles')->only(['delete', 'bulk_delete']);

    }// end of __construct
    public function index()
    {
        $roles=Role::whereNotIn('name',['super_admin','admin'])->withCount(['users'])
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.roles.index',compact('roles'));
    }

    public function create()
    {
        $models=$this->models;
        $permissionMaps=$this->permissionMaps;
        return view('dashboard.roles.create',compact('models','permissionMaps'));
    }
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->only(['name']));
        $role->attachPermissions($request->permissions);
        Alert::success('تمت الاضافه بنجاح', 'role created successfully');
        return redirect()->route('admin.roles.index');
    }
    public function edit(Role $role)
    {
        $models=$this->models;
        $permissionMaps=$this->permissionMaps;
        return view('dashboard.roles.edit',compact('role','models','permissionMaps'));
    }
    public function update(RoleRequest $request , Role $role)
    {
        $role->update($request->only(['name']));
        $role->syncPermissions($request->permissions);
        Alert::success('تم التعديل بنجاح', 'role updated successfully');
        return redirect()->route('admin.roles.index');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        Alert::success('تم الحذف بنجاح', 'role deleted successfully');
        return redirect()->back();
    }
    public function bulkDelete(Request $request)
    {
        try {
            // dd($request->delete_select_id);
            foreach(json_decode($request->delete_select_id) as $id) {
                $role = Role::findorfail($id);
                $role->delete();
            }
            Alert::success('all data deleted successfully', 'roles deleted successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            return redirect()->back();
        }
    }// end of bulkDelete

}
