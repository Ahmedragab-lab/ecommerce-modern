<div>
    <div class="container">
        <!-- HERO SECTION-->
        <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background: url({{ asset('images/sliders/slider-1.jpg') }})">
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
                  @if(Cart::instance('wishlist')->count() > 0)
                      <button class="btn btn-warning btn-sm mb-3 "
                              wire:click.prevent="destroyAll()" >
                          <i class="fas fa-trash-alt" style="color: red;"></i>
                          <span>Empty Wishlist</span>
                      </button>
                  @endif
                <!-- CART TABLE-->
                <div class="table-responsive mb-4">
                  <table class="table text-nowrap">
                    <thead class="bg-light">
                      <tr>
                        <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Product</strong></th>
                        <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Price</strong></th>
                        <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Move To Cart</strong></th>
                        <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase"></strong></th>
                      </tr>
                    </thead>
                    <tbody class="border-0">
                      {{-- @dd(Cart::instance('wishlist')->content()) --}}
                      @forelse (Cart::instance('wishlist')->content() as $item)
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
                                  <a class="mb-0 small btn btn-muted btn-sm" wire:click.prevent='removetocart("{{ $item->rowId }}")'>
                                    Move To Cart
                                  </a>
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
                                  <h5 class="text-center">No items in wishlist</h5>
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
                      <i class="fas fa-long-arrow-alt-left me-2"> </i>Continue shopping</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </div>
</div>
