<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index()
    {
        $users=User::whereHas('roles',function($q){
            $q->where('name','customer');
        })
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.users.index',compact('users'));
    }
    public function create()
    {
        return view('dashboard.users.create');
    }
    public function store(CustomerRequest $request)
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
                $path = public_path('/images/users/' . $file_name);
                Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $input['image'] = $file_name;
            }
            $user=User::create($input);
            $user->attachRole(Role::where('name','customer')->first()->id);
            Alert::success('تمت الاضافه بنجاح', 'user created successfully');
            return redirect()->route('admin.users.index');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));
    }


    public function update(CustomerRequest $request, User $user)
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
            if($user->image != null && file_exists(public_path('/images/users/' . $user->image))){
                unlink('images/users/' . $user->image);
            }
            $file_name = Str::slug($request->firstname).".".$image->getClientOriginalExtension();
            $path = public_path('/images/users/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['image'] = $file_name;
        }
        $user->update($input);
        Alert::success('تمت التعديل بنجاح', 'user updated successfully');
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        if($user->image != null && file_exists(public_path('/images/users/' . $user->image))){
            unlink('images/users/' . $user->image);
        }
        $user->delete();
        Alert::success('تمت الحذف بنجاح', 'user deleted successfully');
        return redirect()->back();
    }

    public function bulkDelete(Request $request)
    {
        try {
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $users_ids) {
                    $user = User::findorfail($users_ids);
                    if($user->image != null && file_exists(public_path('/images/users/' . $user->image))){
                        unlink('images/users/' . $user->image);
                    }
                }
            } else {
                Alert::error('لم يتم تحديد أي عنصر', 'لم يتم تحديد أي عنصر');
                return redirect()->back();
            }
            User::destroy($delete_select_id);
            Alert::success('all data deleted successfully', 'users deleted successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            return redirect()->back();
        }
    }// end of bulkDelete
}
