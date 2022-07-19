<?php

namespace App\Http\Livewire\Frontend;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use App\Models\ShippingCompany;
use App\Models\UserAddress;
use Livewire\Component;

class Checkout extends Component
{
    use LivewireAlert;
    public $havecoupon_code;
    public $code;
    public $coupon;
    public $cart_subtotal;
    public $cart_tax;
    public $cart_total;
    public $cart_discount;

    public $addresses;
    public $customer_address_id=0;

    public $shipping_companies;
    public $shipping_company_id = 0;
    public $cart_shipping;
    // public $payment_methods;
    // public $payment_method_id = 0;
    // public $payment_method_code;
    protected $listeners = [
        'updateCart' => 'mount'
    ];
    public function mount(){
        $this->cart_subtotal = getNumbers()->get('subtotal');
        $this->cart_tax = getNumbers()->get('productTaxes');
        $this->cart_total = getNumbers()->get('total');
        $this->cart_discount = getNumbers()->get('discount');
        $this->cart_shipping = getNumbers()->get('shipping');
        $this->addresses = auth()->user()->addresses;
        $this->customer_address_id = session()->has('saved_customer_address_id') ? session()->get('saved_customer_address_id') : '';
        if ($this->customer_address_id == '') {
            $this->shipping_companies = collect([]);
        } else {
            $this->updateShippingCompanies();
        }
        $this->shipping_company_id = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
    }
     public function resetFields(){
      $this->code = '';
     }
     public function updated($fields){
        $this->validateOnly($fields,[
        'code'    =>'required|min:3|max:10|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
        ]);
     }
     public function applyDiscount(){
        $this->validate([
            'code'    =>'required|min:3|max:10|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
        ]);
         if ($this->cart_subtotal > 0) {
             $coupon = Coupon::whereCode($this->code)->first();
            //  $this->coupon = $coupon->used_times;

             if(!$coupon) {
                 $this->resetFields();
                 $this->alert('error', 'Coupon is invalid!');
             } else {
                 $couponValue = $coupon->discount($this->cart_subtotal);
                 if ($couponValue > 0) {
                     session()->put('coupon', [
                         'code' => $coupon->code,
                         'value' => $coupon->value,
                         'discount' => $couponValue,
                     ]);
                     $this->code = session()->get('coupon')['code'];
                     $this->coupon = $coupon->used_times +1;
                     $coupon->update(['used_times' =>  $this->coupon]);
                     $this->emit('updateCart');
                     $this->alert('success', 'coupon is applied successfully');
                    } else {
                     $this->alert('error', 'product coupon is invalid');
                 }
             }
         } else {
             $this->resetFields();
             $this->alert('error', 'No products available in your cart');
         }
     }
     public function removeCoupon(){
        $coupon = Coupon::whereCode($this->code)->first();
        $coupon->update(['used_times' =>  $coupon->used_times -1]);
        session()->forget('coupon');
        $this->resetFields();
        $this->emit('updateCart');
        $this->alert('info', 'coupon is removed successfully');
     }
     // =================================================
     public function updateShippingCompany(){
        // dd($this->user_address_id);
         $addressCountry = UserAddress::whereId($this->customer_address_id)->first();
         $this->shipping_companies = ShippingCompany::whereHas('countries', function($query) use ($addressCountry) {
             $query->where('country_id', $addressCountry->country_id);
         })->get();

     }
     public function updateShippingCost(){
         $selectedShippingCompany = ShippingCompany::whereId($this->shipping_company_id)->first();
         session()->put('shipping', [
             'code' => $selectedShippingCompany->code,
             'cost' => $selectedShippingCompany->cost,
         ]);
         $this->emit('updateCart');
         $this->alert('success', 'Shipping cost is applied successfully');
     }

     // cycle hooks
     public function updateingUserAddressId(){
        session()->forget('saved_user_address_id');
        session()->put('saved_user_address_id', $this->customer_address_id);
        // $this->user_address_id = session()->get('saved_user_address_id')??null;
        $this->customer_address_id = session()->has('saved_user_address_id')?session()->get('saved_user_address_id'):null;
        $this->emit('updateCart');
    }
     public function updatedUserAddressId(){
        session()->forget('saved_user_address_id');
        session()->put('saved_user_address_id', $this->customer_address_id);
        // $this->user_address_id = session()->get('saved_user_address_id')??null;
        $this->customer_address_id = session()->has('saved_user_address_id')?session()->get('saved_user_address_id'):null;
        $this->emit('updateCart');
     }
     public function updatingShippingCompanyId(){
         session()->forget('saved_shipping_company_id');
         session()->put('saved_shipping_company_id', $this->customer_address_id);
         $this->customer_address_id = session()->has('saved_customer_address_id') ? session()->get('saved_customer_address_id') : '';
         $this->shipping_company_id = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
        //  $this->payment_method_id = session()->has('saved_payment_method_id') ? session()->get('saved_payment_method_id') : '';
         $this->emit('updateCart');
     }
     public function updatedShippingCompanyId(){
         session()->forget('saved_shipping_company_id');
         session()->put('saved_shipping_company_id', $this->shipping_company_id);
         $this->customer_address_id = session()->has('saved_customer_address_id') ? session()->get('saved_customer_address_id') : '';
         $this->shipping_company_id = session()->has('saved_shipping_company_id') ? session()->get('saved_shipping_company_id') : '';
        //  $this->payment_method_id = session()->has('saved_payment_method_id') ? session()->get('saved_payment_method_id') : '';
         $this->emit('updateCart');
     }
     // end cycle hooks
    public function render(){
        return view('livewire.frontend.checkout')->layout('layouts.master');
    }
}
