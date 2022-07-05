<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_reviews')->only(['index']);
        $this->middleware('permission:create_reviews')->only(['create', 'store']);
        $this->middleware('permission:update_reviews')->only(['edit', 'update']);
        $this->middleware('permission:delete_reviews')->only(['delete', 'bulk_delete']);

    }// end of __construct
    public function index()
    {
        $reviews=Review::
        with('user','product')
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
            // $query->where('name', 'like', '%' . \request()->keyword . '%');
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.reviews.index',compact('reviews'));
    }

    public function show(Review $review)
    {
        return view('dashboard.reviews.show',compact('review'));
    }
    public function edit(Review $review)
    {
        return view('dashboard.reviews.edit',compact('review'));
    }


    public function update(ProductReviewRequest $request, Review $review)
    {
        $review->update($request->validated());
        Alert::success('تمت التعديل بنجاح', 'review updated successfully');
        return redirect()->route('admin.reviews.index');
    }

    public function destroy( Review $review)
    {
        $review->delete();
        Alert::success('تمت الحذف بنجاح', 'review deleteded successfully');
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
            Review::destroy($delete_select_id);
            Alert::success('all data deleted successfully', 'all data deleted successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            return redirect()->back();
        }
    }// end of bulkDelete
}
