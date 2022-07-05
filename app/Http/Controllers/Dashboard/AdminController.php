<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerRequest;
use App\Http\Requests\Backend\SupervisorRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_admins')->only(['index']);
        $this->middleware('permission:create_admins')->only(['create', 'store']);
        $this->middleware('permission:update_admins')->only(['edit', 'update']);
        $this->middleware('permission:delete_admins')->only(['delete', 'bulk_delete']);

    }// end of __construct
    public function index()
    {
        $admins=User::whereRoleIs('admin')->with('roles')
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.admins.index',compact('admins'));
    }
    public function create()
    {
        $roles=Role::whereNotIn('name', ['super_admin', 'admin'])->get();
        return view('dashboard.admins.create',compact('roles'));
    }
    public function store(SupervisorRequest $request)
    {
        try{
            $input['firstname'] = $request->firstname;
            $input['lastname'] = $request->lastname;
            $input['status'] = $request->status;
            $input['email'] = $request->email;
            $input['email_verified_at'] = now();
            $input['password'] = bcrypt($request->password);
            $input['phone'] = $request->phone;
            if ($image = $request->file('image')) {
                $file_name = Str::slug($request->firstname).".".$image->getClientOriginalExtension();
                $path = public_path('/images/admins/' . $file_name);
                Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $input['image'] = $file_name;
            }
            $admin=User::create($input);
            $admin->attachRoles(['admin', $request->role_id]);
            Alert::success('تمت الاضافه بنجاح', 'admin created successfully');
            return redirect()->route('admin.admins.index');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(User $admin)
    {
        $roles=Role::whereNotIn('name', ['super_admin', 'admin'])->get();
        return view('dashboard.admins.edit',compact('admin','roles'));
    }


    public function update(SupervisorRequest $request, User $admin)
    {
        $input['firstname'] = $request->firstname;
        $input['lastname'] = $request->lastname;
        $input['status'] = $request->status;
        $input['email'] = $request->email;
        if(trim($request->password) != ''){
            $input['password'] = bcrypt($request->password);
        }
        $input['phone'] = $request->phone;
        if ($image = $request->file('image')) {
            if($admin->image != null && file_exists(public_path('/images/admins/' . $admin->image))){
                unlink('images/admins/' . $admin->image);
            }
            $file_name = Str::slug($request->firstname).".".$image->getClientOriginalExtension();
            $path = public_path('/images/admins/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image'] = $file_name;
        }
        $admin->update($input);
        $admin->syncRoles(['admin', $request->role_id]);
        Alert::success('تمت التعديل بنجاح', 'admin updated successfully');
        return redirect()->route('admin.admins.index');
    }

    public function destroy(User $admin)
    {
        if($admin->image != null && file_exists(public_path('/images/admins/' . $admin->image))){
            unlink('images/admins/' . $admin->image);
        }
        $admin->delete();
        Alert::success('تمت الحذف بنجاح', 'admin deleted successfully');
        return redirect()->back();
    }

    public function bulkDelete(Request $request)
    {
        try {
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $admins_ids) {
                    $admin = User::findorfail($admins_ids);
                    if($admin->image != null && file_exists(public_path('/images/admins/' . $admin->image))){
                        unlink('images/admins/' . $admin->image);
                    }
                }
            } else {
                Alert::error('لم يتم تحديد أي عنصر', 'لم يتم تحديد أي عنصر');
                return redirect()->back();
            }
            User::destroy($delete_select_id);
            Alert::success('all data deleted successfully', 'admins deleted successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            return redirect()->back();
        }
    }// end of bulkDelete
}
