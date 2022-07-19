<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $payment_methods = PaymentMethod::query()
            ->when(\request()->keyword != '', function ($q){
                $q->search(\request()->keyword);
            })
            ->when(\request()->status != '', function ($q){
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('dashboard.payments.index', compact('payment_methods'));
    }

    public function create()
    {
        return view('dashboard.payments.create');
    }

    public function store(PaymentMethodRequest $request)
    {
        PaymentMethod::create($request->validated());
        Alert::success('تمت الاضافه بنجاح', 'Payment Method Added Successfully');
        return redirect()->route('admin.payment_method.index');

    }

    public function show(PaymentMethod $payment_method)
    {
        return view('dashboard.payments.show', compact('payment_method'));
    }

    public function edit(PaymentMethod $payment_method)
    {
        return view('dashboard.payments.edit', compact('payment_method'));
    }

    public function update(PaymentMethodRequest $request, PaymentMethod $payment_method)
    {
        $payment_method->update($request->validated());
        Alert::success('تمت التعديل بنجاح', 'Payment Method Updated Successfully');
        return redirect()->route('admin.payment_method.index');
    }

    public function destroy(PaymentMethod $payment_method)
    {
        $payment_method->delete();
        Alert::success('تمت الحذف بنجاح', 'Deleted successfully');
        return redirect()->back();
    }
}
