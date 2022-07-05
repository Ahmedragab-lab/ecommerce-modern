<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_products')->only(['index']);
        $this->middleware('permission:create_products')->only(['create', 'store']);
        $this->middleware('permission:update_products')->only(['edit', 'update']);
        $this->middleware('permission:delete_products')->only(['delete', 'bulk_delete']);

    }// end of __construct
    public function index()
    {
        $products=Product::with('category','tags','firstMedia')
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
            // $query->where('name', 'like', '%' . \request()->keyword . '%');
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.products.index',compact('products'));
    }
    public function create()
    {
        $cats=ProductCategory::whereStatus('1')->get(['id','name']);
        $tags=Tag::whereStatus('1')->get(['id','name']);
        return view('dashboard.products.create',compact('cats','tags'));
    }
    public function store(ProductRequest $request)
    {
        $input['name'] = $request->name;
        $input['price'] = $request->price;
        $input['quantity'] = $request->quantity;
        $input['product_category_id'] = $request->product_category_id;
        $input['status'] = $request->status;
        $input['featured'] = $request->featured;
        $input['description'] = $request->description;
        $product = Product::create($input);
        $product->tags()->attach($request->tags);
        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $image) {
                $file_name = $product->slug. '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('images/products/' . $file_name);
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $product->media()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => true,
                    'file_sort' => $i,
                ]);
                $i++;
            }
        }
        Alert::success('تمت الاضافه بنجاح', 'Product added successfully');
        return redirect()->route('admin.products.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $cats=ProductCategory::whereStatus('1')->get(['id','name']);
        $tags=Tag::whereStatus('1')->get(['id','name']);
        return view('dashboard.products.edit',compact('product','cats','tags'));
    }


    public function update(ProductRequest $request, Product $product)
    {
        $input['name'] = $request->name;
        $input['slug'] = null;
        $input['price'] = $request->price;
        $input['quantity'] = $request->quantity;
        $input['product_category_id'] = $request->product_category_id;
        $input['status'] = $request->status;
        $input['featured'] = $request->featured;
        $input['description'] = $request->description;
        $product->update($input);
        $product->tags()->sync($request->tags);
        if ($request->images && count($request->images) > 0) {
            $i = $product->media()->count() +1;
            foreach ($request->images as $image) {
                $file_name = $product->slug. '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('images/products/' . $file_name);
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $product->media()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => true,
                    'file_sort' => $i,
                ]);
                $i++;
            }
        }
        Alert::success('تمت التعديل بنجاح', 'updated successfully');
        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        if($product->media()->count() > 0){
            foreach ($product->media as $media){
                if(File::exists(public_path('images/products/'.$media->file_name))){
                    unlink('images/products/' . $media->file_name);
                }
                $media->delete();
            }
        }
        $product->delete();
        Alert::success('تمت الحذف بنجاح', 'Deleted successfully');
        return redirect()->back();
    }

    public function bulkDelete(Request $request)
    {
        try {
            if ($request->delete_select_id) {
                $delete_select_id = explode(",", $request->delete_select_id);
                foreach ($delete_select_id as $products_ids) {
                    $Product = Product::findorfail($products_ids);
                    if($Product->media()->count() > 0){
                        foreach ($Product->media as $media){
                            if(File::exists(public_path('images/products/'.$media->file_name))){
                                unlink('images/products/' . $media->file_name);
                            }
                            $media->delete();
                        }
                    }
                }
            } else {
                Alert::error('لم يتم تحديد أي عنصر', 'لم يتم تحديد أي عنصر');
                return redirect()->back();
            }
            Product::destroy($delete_select_id);
            Alert::success('all data deleted successfully', 'تمت حذف القسم بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            return redirect()->back();
        }
    }// end of bulkDelete

    public function remove_image(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $image = $product->media()->whereId($request->image_id)->first();
        if (File::exists('images/products/'. $image->file_name)){
            unlink('images/products/'. $image->file_name);
        }
        $image->delete();
        return true;
    }
}
