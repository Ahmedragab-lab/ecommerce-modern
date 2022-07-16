<?php
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cache;
function getNumbers()
{
    $subtotal = str_replace(",", "", Cart::instance('cart')->subtotal());
    // dd(($subtotal));
    $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0.00;
    // dd($discount);
    $discount_code = session()->has('coupon') ? session()->get('coupon')['code'] : null;

    $subtotal_after_discount = $subtotal - $discount;
    $subtotal_after_discount =  number_format($subtotal,2);
    $subtotal_after_discount = $subtotal - $discount;
    // dd($subtotal_after_discount);
    $tax = config('cart.tax') / 100; //0.21
    $taxText = config('cart.tax') . '%'; // 21%

    $productTaxes = round($subtotal_after_discount * $tax, 2);
    $newSubTotal = $subtotal_after_discount + $productTaxes;

    $shipping = session()->has('shipping') ? session()->get('shipping')['cost'] : 0.00;
    $shipping_code = session()->has('shipping') ? session()->get('shipping')['code'] : null;

    $total = ($newSubTotal + $shipping) > 0 ? round($newSubTotal + $shipping, 2) : 0.00;
    // $total = $newSubTotal ;

    return collect([
        'subtotal' => $subtotal,
        'tax' => $productTaxes,
        'taxText' => $taxText,
        'productTaxes' => (float)$productTaxes,
        'newSubTotal' => (float)$newSubTotal,
        'discount' => (float)$discount,
        'discount_code' => $discount_code,
        'shipping' => (float)$shipping,
        'shipping_code' => $shipping_code,
        'total' => (float)$total,
    ]);
}
