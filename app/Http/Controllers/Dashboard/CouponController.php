<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_coupons')->only(['index']);
        $this->middleware('permission:create_coupons')->only(['create', 'store']);
        $this->middleware('permission:update_coupons')->only(['edit', 'update']);
        $this->middleware('permission:delete_coupons')->only(['delete', 'bulk_delete']);

    }// end of __construct
    public function index()
    {
        $coupons=Coupon::query()
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
            // $query->where('name', 'like', '%' . \request()->keyword . '%');
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.coupons.index',compact('coupons'));
    }

    public function create()
    {
        return view('dashboard.coupons.create');
    }
    public function store(ProductCouponRequest $request)
    {
        Coupon::create($request->validated());
        Alert::success('تمت الاضافه بنجاح', 'coupon added successfully');
        return redirect()->route('admin.coupons.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Coupon $coupon)
    {
        return view('dashboard.Coupons.edit',compact('coupon'));
    }


    public function update(ProductCouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());
        Alert::success('تمت التعديل بنجاح', 'coupon updated successfully');
        return redirect()->route('admin.coupons.index');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        Alert::success('تمت الحذف بنجاح', 'coupon deleteded successfully');
        return redirect()->back();
    }

    public function bulkDelete(Request $request)
    {
        try {
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
            } else {
                Alert::error('لم يتم تحديد أي عنصر', 'لم يتم تحديد أي عنصر');
                return redirect()->back();
            }
            Coupon::destroy($delete_select_id);
            Alert::success('all data deleted successfully', 'all data deleted successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            return redirect()->back();
        }
    }// end of bulkDelete
}
