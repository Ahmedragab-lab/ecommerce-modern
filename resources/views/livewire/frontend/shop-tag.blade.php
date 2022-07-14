
<div >
    <livewire:frontend.product-modal-shared />
    <div class="container">
        <!-- HERO SECTION-->
        <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background: url({{ asset('images/sliders/slider-1.jpg') }})">
            <div class="container py-5">
                <div class="row px-4 px-lg-5">
                <div class="col-lg-6">
                    <p class="text-muted small text-uppercase mb-2">New Inspiration 2020</p>
                    <h1 class="h2 text-uppercase mb-3">محلات صبايا ترحب بكم</h1><a class="btn btn-dark" href="shop.html">Browse collections</a>
                </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container p-0">
                <div class="row" >
                    <!-- SHOP SIDEBAR-->
                    <div class="col-lg-3 order-2 order-lg-1">
                        <h5 class="text-uppercase mb-4">Categories</h5>
                        @foreach($shop_categories_menu as $shop_category)
                            <div class="py-2 px-4 bg-dark text-white mb-3">
                                <strong class="small text-uppercase font-weight-bold">
                                    {{ $shop_category->name }}
                                </strong>
                            </div>
                            <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                                @forelse($shop_category->appearedChildren as $sub_shop_category)
                                <li class="mb-2">
                                    <a class="reset-anchor" href="{{ route('shop', $sub_shop_category->slug) }}">
                                        {{ $sub_shop_category->name }}
                                    </a>
                                </li>
                                @empty
                                @endforelse
                            </ul>
                        @endforeach
                        <div>
                            <h5 class="text-uppercase mb-4">Tags</h5>
                            <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                                @forelse($shop_tags_menu as $shop_tag)
                                    <li class="mb-2">
                                        <a class="reset-anchor badge text-white bg-info" href="{{ route('shoptag', $shop_tag->slug) }}">
                                            {{ $shop_tag->name }}
                                        </a>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                        <h6 class="text-uppercase mb-4">Price range</h6>
                        <div class="price-range pt-4 mb-5">
                        <div id="range"></div>
                        <div class="row pt-2">
                            <div class="col-6"><strong class="small fw-bold text-uppercase">From</strong></div>
                            <div class="col-6 text-end"><strong class="small fw-bold text-uppercase">To</strong></div>
                        </div>
                        </div>
                            <h6 class="text-uppercase mb-3">Show only</h6>
                            <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" id="checkbox_1">
                            <label class="form-check-label" for="checkbox_1">Returns Accepted</label>
                            </div>
                            <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" id="checkbox_2">
                            <label class="form-check-label" for="checkbox_2">Returns Accepted</label>
                            </div>
                            <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" id="checkbox_3">
                            <label class="form-check-label" for="checkbox_3">Completed Items</label>
                            </div>
                            <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" id="checkbox_4">
                            <label class="form-check-label" for="checkbox_4">Sold Items</label>
                            </div>
                            <div class="form-check mb-1">
                            <input class="form-check-input" type="checkbox" id="checkbox_5">
                            <label class="form-check-label" for="checkbox_5">Deals &amp; Savings</label>
                            </div>
                            <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="checkbox_6">
                            <label class="form-check-label" for="checkbox_6">Authorized Seller</label>
                            </div>
                            <h6 class="text-uppercase mb-3">Buying format</h6>
                            <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="customRadio" id="radio_1">
                            <label class="form-check-label" for="radio_1">All Listings</label>
                            </div>
                            <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="customRadio" id="radio_2">
                            <label class="form-check-label" for="radio_2">Best Offer</label>
                            </div>
                            <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="customRadio" id="radio_3">
                            <label class="form-check-label" for="radio_3">Auction</label>
                            </div>
                            <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" name="customRadio" id="radio_4">
                            <label class="form-check-label" for="radio_4">Buy It Now</label>
                        </div>
                    </div>
                    <!-- SHOP LISTING-->
                    <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0" >
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-6 mb-2 mb-lg-0">
                                <p class="text-sm text-muted mb-0">Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} results</p>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0" >
                                    <li class="list-inline-item text-muted mr-3">
                                        <a class="reset-anchor p-0" href="javascript:void(0);" id="four_items">
                                            <i class="fas fa-th-list"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item text-muted mr-3">
                                        <a class="reset-anchor p-0" href="javascript:void(0);" id="three_items">
                                            <i class="fas fa-th"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item text-muted mr-3">
                                        <a class="reset-anchor p-0" href="javascript:void(0);" id="two_items">
                                            <i class="fas fa-th-large"></i>
                                        </a>
                                    </li>
                                    <li  class="list-inline-item" >
                                        <select  data-customclass="form-control form-control-sm" wire:model='sorting' >
                                            <option value="default" selected='selected'>Default sorting </option>
                                            <option value="popularity">Popularity </option>
                                            <option value="low-high">Price: Low to High </option>
                                            <option value="high-low">Price: High to Low </option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <!-- PRODUCT-->
                            @forelse($products as $product)
                                <div class="col-3 " id="products-container-area">
                                    <div class="product text-center">
                                        <div class="mb-3 position-relative">
                                            <div class="badge text-white bg-"></div>
                                            <a class="d-block" href="{{ route('product_details',$product->slug) }}">
                                                @if($product->firstMedia)
                                                <img src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}" class="img-fluid w-100" >
                                                @else
                                                <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $product->name }}" class="img-fluid w-100" >
                                                @endif
                                            </a>
                                            <div class="product-overlay">
                                                <ul class="mb-0 list-inline">
                                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" wire:click.prevent='addToWishlist("{{ $product->id }}")' ><i class="far fa-heart"></i></a></li>
                                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" wire:click.prevent='addToCart("{{ $product->id }}")' >Add to cart</a></li>
                                                    <li class="list-inline-item me-0"><a class="btn btn-sm btn-outline-dark"
                                                    wire:click.prevent="$emit('showProductModalAction', '{{ $product->slug }}')"
                                                    href="#productView"
                                                    data-bs-toggle="modal">
                                                    <i class="fas fa-expand"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h6> <a class="reset-anchor" href="{{ route('product_details',$product->slug) }}">{{ $product->name }}</a></h6>
                                        <p class="small text-muted">LE{{ number_format($product->price,2) }}</p>
                                    </div>
                                </div>
                            @empty
                            <div class="alert alert-info">
                                <strong>No related products yet!</strong>
                            </div>
                            @endforelse
                        </div>
                        <!-- PAGINATION-->
                        @if (count($products))
                            {{-- {{ $products->links() }} --}}
                            {{-- {!! $products->appends(request()->all())->links() !!} --}}
                            {!! $products->appends(request()->all())->onEachSide(1)->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@section('js')
    <script>
        let product_blocks = document.querySelectorAll('#products-container-area');
        document.getElementById('two_items').onclick = function () {
            Array.prototype.forEach.call(product_blocks, function (product_block) {
                if (product_block.classList.contains('col-3')||product_block.classList.contains('col-4')) {
                    product_block.classList.remove('col-3')||product_block.classList.remove('col-4');
                    product_block.classList.add('col-6');
                }
            });
        }
        document.getElementById('three_items').onclick = function () {
            Array.prototype.forEach.call(product_blocks, function (product_block) {
                if (product_block.classList.contains('col-3')||product_block.classList.contains('col-6')) {
                    product_block.classList.remove('col-3')||product_block.classList.remove('col-6');
                    product_block.classList.add('col-4');
                }
            });
        }
        document.getElementById('four_items').onclick = function () {
            Array.prototype.forEach.call(product_blocks, function (product_block) {
                if (product_block.classList.contains('col-4')||product_block.classList.contains('col-6')) {
                    product_block.classList.remove('col-4')||product_block.classList.remove('col-6');
                    product_block.classList.add('col-3');
                }
            });
        }
    </script>
@endsection
