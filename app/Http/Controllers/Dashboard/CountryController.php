<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CountryController extends Controller
{
    public function index()
    {
        $countries=Country::query()->with('states')
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.countries.index',compact('countries'));
    }

    public function store(CountryRequest $request)
    {
        Country::create($request->validated());
        Alert::success('تمت الاضافه بنجاح', 'tag added successfully');
        return redirect()->back();
    }
    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        Alert::success('تم التعديل بنجاح', 'country updated successfully');
        return redirect()->back();
    }
    public function destroy(Country $country)
    {
        $country->delete();
        Alert::success('تم الحذف بنجاح', 'country deleted successfully');
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
            Country::destroy($delete_select_id);
            Alert::success('all data deleted successfully', 'all data deleted successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            return redirect()->back();
        }
    }// end of bulkDelete
}
