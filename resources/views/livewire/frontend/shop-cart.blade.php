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
          <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
          <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
                @if(Cart::instance('cart')->count() > 0)
                    <button class="btn btn-warning btn-sm mb-3 "
                            wire:click.prevent="destroyAll()" >
                        <i class="fas fa-trash-alt" style="color: red;"></i>
                        <span>Empty cart</span>
                    </button>
                @endif
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class="table text-nowrap">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Product</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Price</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Quantity</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Total</strong></th>
                      <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase"></strong></th>
                    </tr>
                  </thead>
                  <tbody class="border-0">
                    {{-- @dd(Cart::instance('cart')->content()) --}}
                    @forelse (Cart::instance('cart')->content() as $item)
                        <tr>
                            <th class="ps-0 py-3 border-light" scope="row">
                                <div class="d-flex align-items-center"><a class="reset-anchor d-block animsition-link" href="{{ route('product_details',$item->model->slug) }}">
                                    <img src="{{ asset('images/products/' . $item->model->firstMedia->file_name) }}" alt=" {{ $item->model->name }}" width="70"/></a>
                                <div class="ms-3"><strong class="h6">
                                    <a class="reset-anchor animsition-link" href="{{ route('product_details',$item->model->slug) }}">
                                        {{ $item->model->name }}
                                </a></strong></div>
                                </div>
                            </th>
                            <td class="p-3 align-middle border-light">
                                <p class="mb-0 small btn btn-dark btn-sm">LE{{ number_format($item->model->price,2) }}</p>
                            </td>
                            <td class="p-3 align-middle border-light">
                                <div class="border d-flex align-items-center justify-content-between px-3">
                                {{-- <span class="small text-uppercase text-gray headings-font-family">Quantity</span> --}}
                                <div class="quantity">
                                    <button wire:click.prevent='decreaseQuantity("{{ $item->rowId }}")' class="p-0"><i class="fas fa-caret-left"></i></button>
                                    <input class="form-control form-control-sm border-0 shadow-0 p-0" type="text" value="{{ $item->qty}}" onkeydown="return false" />
                                    <button wire:click.prevent='increaseQuantity("{{ $item->rowId }}")' class="p-0"><i class="fas fa-caret-right"></i></button>
                                </div>
                                </div>
                            </td>
                            <td class="p-3 align-middle border-light">
                                {{-- <p class="mb-0 small">LE{{ number_format($item->model->price * $item->qty  ,2) }}</p> --}}
                                <p class="mb-0 small btn btn-warning ">LE{{ $item->subtotal() }}</p>
                            </td>
                            <td class="p-3 align-middle border-light">
                                <a class="reset-anchor" wire:click.prevent='removeItem("{{ $item->rowId }}")'>
                                    <i class="fas fa-trash-alt small" style="color:red;font-size: 17px;"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <h5 class="text-center">No items in cart</h5>
                            </td>
                        </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <!-- CART NAV-->
              <div class="bg-light px-4 py-3">
                <div class="row align-items-center text-center">
                  <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a class="btn btn-link p-0 text-dark btn-sm" href="{{ route('shop') }}">
                    <i class="fas fa-long-arrow-alt-left me-2"> </i>Continue shopping</a></div>
                  <div class="col-md-6 text-md-end">
                    @if(Cart::instance('cart')->count() > 0)
                        {{-- <a class="btn btn-dark btn-sm" href="{{ route('checkout') }}">Proceed to checkout</a> --}}
                        <a class="btn btn-outline-dark btn-sm" href="{{ route('checkout') }}">Procceed to checkout
                            <i class="fas fa-long-arrow-alt-right ms-2"></i>
                        </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <!-- ORDER TOTAL-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Cart total</h5>
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between">
                        <strong class="text-uppercase small font-weight-bold">Subtotal</strong>
                        <span class="text-muted small">LE{{ Cart::instance('cart')->subtotal() }}</span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between">
                        <strong class="text-uppercase small font-weight-bold">Tax</strong>
                        <span class="text-muted small">LE{{ Cart::instance('cart')->tax() }}</span>
                    </li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4">
                        <strong class="text-uppercase small font-weight-bold">Total</strong>
                        <span>LE{{ Cart::instance('cart')->total() }}</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
</div>
