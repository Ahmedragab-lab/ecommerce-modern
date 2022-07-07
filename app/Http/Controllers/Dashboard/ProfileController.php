<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProfileRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index');
    }
    public function edit(User $admin)
    {
        $roles=Role::select('id', 'name')->get();
        return view('dashboard.profile.edit',compact('admin','roles'));
    }
    public function update(ProfileRequest $request,$id)
    {
        $admin = User::findOrFail($id);
        $input['id'] = Auth::user()->id;
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
        // $admin->syncRoles(['super_admin',$request->role_id]);
        Alert::success('تمت التعديل بنجاح', 'admin updated successfully');
        return redirect()->route('admin.profile.index');
    }
}
