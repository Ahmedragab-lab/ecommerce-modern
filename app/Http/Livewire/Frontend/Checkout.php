<?php

namespace App\Http\Livewire\Frontend;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use Livewire\Component;

class Checkout extends Component
{
    use LivewireAlert;
    public $code;
    public $cart_subtotal;
    public $cart_tax;
    public $cart_total;
    public $cart_discount;
    protected $listeners = [
        'updateCart' => 'mount'
    ];
    public function mount(){
        $this->cart_subtotal = getNumbers()->get('subtotal');
        $this->cart_tax = getNumbers()->get('productTaxes');
        $this->cart_total = getNumbers()->get('total');
        $this->cart_discount = getNumbers()->get('discount');
    }
    public function resetFields()
    {
       $this->code = '';
    }
    public function updated($fields){
        $this->validateOnly($fields,[
         'code'    =>'required|min:3|max:10|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
        ]);
     }
     public function applyDiscount()
     {
        $this->validate([
            'code'    =>'required|min:3|max:10|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
        ]);
         if ($this->cart_subtotal > 0) {
             $coupon = Coupon::whereCode($this->code)->first();
             if(!$coupon) {
                //  $this->cart_coupon = '';
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
                     $this->emit('updateCart');
                     $this->alert('success', 'coupon is applied successfully');
                 } else {
                     $this->alert('error', 'product coupon is invalid');
                 }
             }
         } else {
            //  $this->cart_coupon = '';
             $this->resetFields();
             $this->alert('error', 'No products available in your cart');
         }
     }
     public function removeCoupon()
     {
         session()->remove('coupon');
         $this->code = '';
         $this->emit('updateCart');
         $this->alert('success', 'Coupon is removed');
     }
    // public function applyDiscount(){
    //     $this->validate([
    //         'code'    =>'required|min:3|max:10|regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
    //        ]);
    //    $coupon = Coupon::whereCode($this->code)->first();
    //    if(!$coupon){
    //         $this->alert('error', 'This coupon is not valid!');
    //    }else{
    //         if($code->expire_date < now()){
    //             $this->alert('error', 'This coupon is expired!');
    //         }elseif($code->used_times >= $code->use_times){
    //             $this->alert('error', 'This coupon is already used!');
    //         }else{
    //             $this->alert('success', 'Coupon applied successfully!');
    //         }
    //     }
    //     $this->resetFields();
    // }
    public function render()
    {
        return view('livewire.frontend.checkout')->layout('layouts.master');
    }
}
