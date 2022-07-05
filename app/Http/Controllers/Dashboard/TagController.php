<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_tags')->only(['index']);
        $this->middleware('permission:create_tags')->only(['create', 'store']);
        $this->middleware('permission:update_tags')->only(['edit', 'update']);
        $this->middleware('permission:delete_tags')->only(['delete', 'bulk_delete']);

    }// end of __construct
    public function index()
    {
        $tags=Tag::with('products')
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
            // $query->where('name', 'like', '%' . \request()->keyword . '%');
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.tags.index',compact('tags'));
    }


    public function create()
    {
        return view('dashboard.tags.create');
    }

    public function store(TagRequest $request)
    {
        // $input['name'] = $request->name;
        // $input['status'] = $request->status;
        // Tag::create($input);
        Tag::create($request->validated());
        Alert::success('تمت الاضافه بنجاح', 'tag added successfully');
        return redirect()->route('admin.tags.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Tag $tag)
    {
        return view('dashboard.tags.edit',compact('tag'));
    }


    public function update(TagRequest $request, Tag $tag)
    {
        $input['name'] = $request->name;
        $input['slug'] = null;
        $input['status'] = $request->status;
        $tag->update($input);
        Alert::success('تمت التعديل بنجاح', 'tag updated successfully');
        return redirect()->route('admin.tags.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        Alert::success('تمت الحذف بنجاح', 'tag deleteded successfully');
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
            Tag::destroy($delete_select_id);
            Alert::success('all data deleted successfully', 'all data deleted successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            return redirect()->back();
        }
    }// end of bulkDelete
}
