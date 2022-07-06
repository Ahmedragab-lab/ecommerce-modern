<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CityRequest;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CityController extends Controller
{
    public function index()
    {
        $states = State::select('id','name')->get();
        $cities=City::query()->with('state')
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.cities.index',compact('states','cities'));
    }

    public function store(CityRequest $request)
    {
        City::create($request->validated());
        Alert::success('تمت الاضافه بنجاح', 'City added successfully');
        return redirect()->back();
    }
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());
        Alert::success('تم التعديل بنجاح', 'City updated successfully');
        return redirect()->back();
    }
    public function destroy(City $city)
    {
        $city->delete();
        Alert::success('تم الحذف بنجاح', 'City deleted successfully');
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
            State::destroy($delete_select_id);
            Alert::success('all data deleted successfully', 'all data deleted successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error($e->getMessage(), 'حدث خطأ غير متوقع');
            return redirect()->back();
        }
    }// end of bulkDelete
}
