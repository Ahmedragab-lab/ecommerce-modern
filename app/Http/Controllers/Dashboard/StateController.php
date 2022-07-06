<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StateRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StateController extends Controller
{
    public function index()
    {
        $countries = Country::select('id','name')->get();
        $states=State::query()->with('country','cities')
        ->when(\request()->keyword != null, function ($query) {
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query) {
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.states.index',compact('states','countries'));
    }

    public function store(StateRequest $request)
    {
        State::create($request->validated());
        Alert::success('تمت الاضافه بنجاح', 'State added successfully');
        return redirect()->back();
    }
    public function update(StateRequest $request, State $state)
    {
        $state->update($request->validated());
        Alert::success('تم التعديل بنجاح', 'State updated successfully');
        return redirect()->back();
    }
    public function destroy(State $state)
    {
        $state->delete();
        Alert::success('تم الحذف بنجاح', 'State deleted successfully');
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
