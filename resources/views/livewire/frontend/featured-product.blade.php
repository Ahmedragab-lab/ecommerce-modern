<div wire:ignore>
    <section class="py-5">
            <header>
            <p class="small text-muted small text-uppercase mb-1">Made the hard way</p>
            <h2 class="h5 text-uppercase mb-4">Top trending products</h2>
            </header>
            <!-- PRODUCT////////////////////////////////////////////-->
            <div class="row">
            @forelse (  $feat_products as $product)
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="product text-center">
                        <div class="position-relative mb-3">
                            <div class="badge text-white bg-info">New</div><a class="d-block" href="{{ route('product_details',$product->slug) }}">
                                @if($product->firstMedia)
                                <img src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}" class="img-fluid w-100" >
                                @else
                                <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $product->name }}" class="img-fluid w-100" >
                                @endif
                                <div class="product-overlay">
                                    <ul class="mb-0 list-inline">
                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" wire:click.prevent='addToWishlist("{{ $product->id }}")' ><i class="far fa-heart"></i></a></li>
                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" wire:click.prevent='addToCart("{{ $product->id }}")' >Add to cart</a></li>
                                    <li class="list-inline-item me-0"><a class="btn btn-sm btn-outline-dark"
                                        wire:click.prevent="$emit('showProductModalAction', '{{ $product->slug }}')"
                                        {{-- wire:click.prevent="showProductModalAction, '{{ $product->slug }}')" --}}
                                        {{-- data-target="#productView" --}}
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
                        <div class="col-12">
                            <div class="alert alert-info">
                            <p class="mb-0">No products found</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        <!-- END PRODUCT////////////////////////////////////////////-->

    </section>
</div>
