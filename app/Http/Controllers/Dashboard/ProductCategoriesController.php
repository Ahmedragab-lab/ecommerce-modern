<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_product_categories')->only(['index']);
        $this->middleware('permission:create_product_categories')->only(['create', 'store']);
        $this->middleware('permission:update_product_categories')->only(['edit', 'update']);
        $this->middleware('permission:delete_product_categories')->only(['delete', 'bulk_delete']);
    }// end of __construct

    public function index()
    {
        $cats=ProductCategory::withCount('products')
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
            // $query->where('name', 'like', '%' . \request()->keyword . '%');
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.product_categories.index',compact('cats'));
    }


    public function create()
    {
        $cats=ProductCategory::whereNull('parent_id')->get(['id','name']);
        return view('dashboard.product_categories.create',compact('cats'));
    }

    public function store(ProductCategoryRequest $request)
    {
        $input['name'] = $request->name;
        $input['status'] = $request->status;
        $input['parent_id'] = $request->parent_id;
        if ($image = $request->file('cover')) {
            $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension();
            $path = public_path('/images/product_categories/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['cover'] = $file_name;
        }
        ProductCategory::create($input);
        Alert::success('تمت الاضافه بنجاح', 'تمت اضافه القسم بنجاح');
        return redirect()->route('admin.product_categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(ProductCategory $productCategory)
    {
        $cats=ProductCategory::whereNull('parent_id')->get(['id','name']);
        return view('dashboard.product_categories.edit',compact('productCategory','cats'));
    }


    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $input['name'] = $request->name;
        $input['slug'] = null;
        $input['status'] = $request->status;
        $input['parent_id'] = $request->parent_id;
        if ($image = $request->file('cover')) {
            // Storage::disk('public')->delete('images/product_categories/' . $productCategory->cover);
            if($productCategory->cover != null && file_exists(public_path('/images/product_categories/' . $productCategory->cover))){
                unlink('images/product_categories/' . $productCategory->cover);
            }
            $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension();
            $path = public_path('/images/product_categories/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['cover'] = $file_name;
        }
        $productCategory->update($input);
        Alert::success('تمت التعديل بنجاح', 'تمت تعديل القسم بنجاح');
        return redirect()->route('admin.product_categories.index');
    }

    public function destroy(ProductCategory $productCategory)
    {
        if($productCategory->cover != null && file_exists(public_path('/images/product_categories/' . $productCategory->cover))){
            unlink('images/product_categories/' . $productCategory->cover);
        }
        $productCategory->delete();
        Alert::success('تمت الحذف بنجاح', 'تمت حذف القسم بنجاح');
        return redirect()->back();
    }

    public function bulkDelete(Request $request)
    {
        try {
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $cats_ids) {
                    $productCategory = ProductCategory::findorfail($cats_ids);
                    if($productCategory->cover != null && file_exists(public_path('/images/product_categories/' . $productCategory->cover))){
                        unlink('images/product_categories/' . $productCategory->cover);
                    }
                }
            } else {
                Alert::error('لم يتم تحديد أي عنصر', 'لم يتم تحديد أي عنصر');
                return redirect()->back();
            }
            ProductCategory::destroy($delete_select_id);
            Alert::success('all data deleted successfully', 'تمت حذف القسم بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            return redirect()->back();
        }
    }// end of bulkDelete
}
