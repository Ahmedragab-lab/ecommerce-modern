<div>
    <div class="container">
        <!-- HERO SECTION-->
        <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background: url({{ asset('images/sliders/slider-3.jpg') }})">
            <div class="container py-5">
                <div class="row px-4 px-lg-5">
                <div class="col-lg-6">
                    <p class="btn btn-dark small  text-white mb-2">New Inspiration 2020</p>
                    <h1 class="h2 text-white mb-3">محلات صبايا ترحب بكم</h1><a class="btn btn-dark" href="shop.html">Browse collections</a>
                </div>
                </div>
            </div>
        </section>
        <section class="py-5">
          <!-- BILLING ADDRESS-->
          <h2 class="h5 text-uppercase mb-4">Shipping Addresses</h2>
          <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    {{-- @dd($addresses) --}}
                    @forelse($addresses as $address)
                        <div class="col-lg-6">
                            <button class="btn btn-link text-dark p-0 shadow-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#alternateAddress">
                                <div class="form-check">
                                <input class="form-check-input"
                                        id="address-{{ $address->id }}"
                                        type="radio"
                                        {{ $customer_address_id == $address->id ? 'checked' : '' }}
                                        wire:model="customer_address_id"
                                        wire:click="updateShippingCompany()"
                                        value="{{ $address->id }}" >
                                <label class="form-check-label"
                                       for="address-{{ $address->id }}">
                                    <b>{{ $address->address_title }}</b>
                                    <small>
                                        {{ $address->address }} <br>
                                        {{ $address->country->name }} {{ $address->state->name }} {{ $address->city->name }}
                                    </small>
                                </label>
                                </div>
                            </button>
                        </div>
                    @empty
                    <p> No Addresses found </p>
                    @endforelse
                </div>
                @if ($customer_address_id != 0)
                    <h2 class="h5 text-uppercase mb-4">Shipping way</h2>
                    <div class="row">
                        @forelse($shipping_companies as $shipping_company)
                            <div class="col-6 form-group">
                                <div class="custom-control custom-radio">
                                    <input
                                        type="radio"
                                        id="shipping-company-{{ $shipping_company->id }}"
                                        class="custom-control-input"
                                        wire:model="shipping_company_id"
                                        wire:click="updateShippingCost()"
                                        {{ intval($shipping_company_id) == $shipping_company->id ? 'checked' : '' }}
                                        value="{{ $shipping_company->id }}">
                                    <label for="shipping-company-{{ $shipping_company->id }}" class="custom-control-label text-small">
                                        <b>{{ $shipping_company->name }}</b>
                                        <small>
                                            {{ $address->description }} - (${{ $shipping_company->cost }})
                                        </small>
                                    </label>
                                </div>
                            </div>

                        @empty
                            <p>No shipping companies found</p>
                        @endforelse
                    </div>
                @endif
              {{-- <form action="#">
                <div class="row gy-3">
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="firstName">First name </label>
                    <input class="form-control form-control-lg" type="text" id="firstName" placeholder="Enter your first name" value="{{ Auth::user()->firstname }}">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="lastName">Last name </label>
                    <input class="form-control form-control-lg" type="text" id="lastName" placeholder="Enter your last name">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="email">Email address </label>
                    <input class="form-control form-control-lg" type="email" id="email" placeholder="e.g. Jason@example.com">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="phone">Phone number </label>
                    <input class="form-control form-control-lg" type="tel" id="phone" placeholder="e.g. +02 245354745">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="company">Company name (optional) </label>
                    <input class="form-control form-control-lg" type="text" id="company" placeholder="Your company name">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="form-label text-sm text-uppercase" for="country">Country</label>
                    <select class="country" id="country" data-customclass="form-control form-control-lg rounded-0">
                      <option value>Choose your country</option>
                    </select>
                  </div>
                  <div class="col-lg-12">
                    <label class="form-label text-sm text-uppercase" for="address">Address line 1 </label>
                    <input class="form-control form-control-lg" type="text" id="address" placeholder="House number and street name">
                  </div>
                  <div class="col-lg-12">
                    <label class="form-label text-sm text-uppercase" for="addressalt">Address line 2 </label>
                    <input class="form-control form-control-lg" type="text" id="addressalt" placeholder="Apartment, Suite, Unit, etc (optional)">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="city">Town/City </label>
                    <input class="form-control form-control-lg" type="text" id="city">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label text-sm text-uppercase" for="state">State/County </label>
                    <input class="form-control form-control-lg" type="text" id="state">
                  </div>
                  <div class="col-lg-6">
                    <button class="btn btn-link text-dark p-0 shadow-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#alternateAddress">
                      <div class="form-check">
                        <input class="form-check-input" id="alternateAddressCheckbox" type="checkbox">
                        <label class="form-check-label" for="alternateAddressCheckbox">Alternate billing address</label>
                      </div>
                    </button>
                  </div>
                  <div class="collapse" id="alternateAddress">
                    <div class="row gy-3">
                      <div class="col-12 mt-4">
                        <h2 class="h4 text-uppercase mb-4">Alternative billing details</h2>
                      </div>
                      <div class="col-lg-6">
                        <label class="form-label text-sm text-uppercase" for="firstName2">First name </label>
                        <input class="form-control form-control-lg" type="text" id="firstName2" placeholder="Enter your first name">
                      </div>
                      <div class="col-lg-6">
                        <label class="form-label text-sm text-uppercase" for="lastName2">Last name </label>
                        <input class="form-control form-control-lg" type="text" id="lastName2" placeholder="Enter your last name">
                      </div>
                      <div class="col-lg-6">
                        <label class="form-label text-sm text-uppercase" for="email2">Email address </label>
                        <input class="form-control form-control-lg" type="email" id="email2" placeholder="e.g. Jason@example.com">
                      </div>
                      <div class="col-lg-6">
                        <label class="form-label text-sm text-uppercase" for="phone2">Phone number </label>
                        <input class="form-control form-control-lg" type="tel" id="phone2" placeholder="e.g. +02 245354745">
                      </div>
                      <div class="col-lg-6">
                        <label class="form-label text-sm text-uppercase" for="company2">Company name (optional) </label>
                        <input class="form-control form-control-lg" type="text" id="company2" placeholder="Your company name">
                      </div>
                      <div class="col-lg-6 form-group">
                        <label class="form-label text-sm text-uppercase" for="countryAlt">Country</label>
                        <select class="country" id="countryAlt" data-customclass="form-control form-control-lg rounded-0">
                          <option value>Choose your country</option>
                        </select>
                      </div>
                      <div class="col-lg-12">
                        <label class="form-label text-sm text-uppercase" for="address2">Address line 1 </label>
                        <input class="form-control form-control-lg" type="text" id="address2" placeholder="House number and street name">
                      </div>
                      <div class="col-lg-12">
                        <label class="form-label text-sm text-uppercase" for="addressalt2">Address line 2 </label>
                        <input class="form-control form-control-lg" type="text" id="addressalt2" placeholder="Apartment, Suite, Unit, etc (optional)">
                      </div>
                      <div class="col-lg-6">
                        <label class="form-label text-sm text-uppercase" for="city2">Town/City </label>
                        <input class="form-control form-control-lg" type="text" id="city2">
                      </div>
                      <div class="col-lg-6">
                        <label class="form-label text-sm text-uppercase" for="state2">State/County </label>
                        <input class="form-control form-control-lg" type="text" id="state2">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 form-group">
                    <button class="btn btn-dark" type="submit">Place order</button>
                  </div>
                </div>
              </form> --}}
            </div>
            <!-- ORDER SUMMARY-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Your order</h5>
                  <ul class="list-unstyled mb-0">

                    <table class="table text-nowrap">
                        <thead class="bg-light">
                          <tr>
                            <th class="border-0 " scope="col"> <strong class="text-sm text-uppercase">Product</strong></th>
                            <th class="border-0 " scope="col"> <strong class="text-sm text-uppercase">Quantity</strong></th>
                            <th class="border-0 " scope="col"> <strong class="text-sm text-uppercase">Total</strong></th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse(Cart::instance('cart')->content() as $item)
                                <tr>
                                    <td class="border-0 align-middle" title="{{$item->name}}">
                                        <img src="{{ asset('images/products/' . $item->model->firstMedia->file_name) }}"
                                            alt=" {{ $item->model->name }}" width="40"/>
                                    </td>
                                    <td class="border-0 align-middle">{{$item->qty}}</td>
                                    <td class="border-0 align-middle">LE {{$item->subtotal}}</td>
                                </tr>
                          @empty
                          @endforelse
                        </tbody>
                    </table>
                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="text-uppercase small font-weight-bold">Subtotal</strong>
                            <span >LE {{ $cart_subtotal }}</span>
                        </li>
                        @if(session()->has('coupon'))
                            <li class="border-bottom my-2"></li>
                            <li class="d-flex align-items-center justify-content-between">
                                <strong class="small font-weight-bold">Discount <small>({{ getNumbers()->get('discount_code') }})</small></strong>
                                <span style="color: red;">- LE ({{ $cart_discount }})</span>
                            </li>
                        @endif
                        @if(session()->has('shipping'))
                            <li class="border-bottom my-2"></li>
                            <li class="d-flex align-items-center justify-content-between">
                                <strong class="small font-weight-bold">Shipping <small>({{ getNumbers()->get('shipping_code') }})</small></strong>
                                <span class="text-muted small">LE {{ $cart_shipping }}</span>
                            </li>
                        @endif
                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="text-uppercase small fw-bold">Tax</strong>
                            <span style="color: rgb(119, 156, 209);">({{ getNumbers()->get('taxText') }})</span>
                            <span>LE {{ $cart_tax }}</span>
                        </li>
                        <li class="border-bottom my-2"></li>
                        <li class="d-flex align-items-center justify-content-between mb-3">
                            <strong class="text-uppercase small fw-bold">Total</strong>
                            <span>LE {{ $cart_total }}</span>
                        </li>
                    <li>
                        <label class="checkbox-field mb-3">
                            <input class="frm-input " name="have-code" id="have-code" value="1" type="checkbox"
                                wire:model='havecoupon_code' >
                            <span class="text-uppercase small ">I have coupon code</span>
                        </label>
                        @if($havecoupon_code == 1)

                        <form wire:submit.prevent="applyDiscount()">
                            <div class="input-group mb-0">
                                @if (!session()->has('coupon'))
                                    <input type="text" wire:model="code" class="form-control" placeholder="Enter your coupon">
                                @endif
                                @if(session()->has('coupon'))
                                    <button type="button" wire:click.prevent="removeCoupon()" class="btn btn-danger btn-sm w-100">
                                        <i class="fas fa-trash-alt mr-2"></i> Remove coupon
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-dark btn-sm w-100" >
                                        <i class="fas fa-gift me-2"></i> Apply coupon
                                    </button>
                                @endif
                                @error('code')
                                   <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                        @endif
                        {{-- <form wire:submit.prevent='applyDiscount()'>
                          <div class="input-group mb-0">
                            <input class="form-control" type="text" placeholder="Enter your coupon" wire:model='code'>
                            <button class="btn btn-dark btn-sm w-100" type="submit">
                              <i class="fas fa-gift me-2"></i>Apply coupon
                            </button>
                            @error('code')
                               <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </form> --}}
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
</div>
