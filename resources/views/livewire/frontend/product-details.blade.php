<div wire:ignore>
    <!--  Modal -->
    <livewire:frontend.product-modal-shared />
    <!--  End Modal -->
    <section class="py-5">
        <div class="container">
          <div class="row mb-5">
            <div class="col-lg-6">
              <!-- PRODUCT SLIDER-->
              <div class="row m-sm-0">
                <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0 px-xl-2">
                  <div class="swiper product-slider-thumbs">
                    <div class="swiper-wrapper">
                        @if($product->media()->count() > 0)
                            @foreach($product->media as $media)
                            <div class="swiper-slide h-auto swiper-thumb-item mb-3">
                                <img class="w-100 " src="{{ asset('images/products/' . $media->file_name) }}" alt="{{ $product->name }}">
                            </div>
                            @endforeach
                        @endif
                    </div>
                  </div>
                </div>
                <div class="col-sm-10 order-1 order-sm-2">
                  <div class="swiper product-slider">
                    <div class="swiper-wrapper">
                        @if($product->media()->count() > 0)
                        @foreach($product->media as $media)
                          <div class="swiper-slide  swiper-thumb-item mb-3">
                            <div class="swiper-slide ">
                                <a class="glightbox product-view" href="{{ asset('images/products/' . $media->file_name) }}"
                                    data-gallery="gallery2" data-glightbox="Product item 1">
                                    <img class="img-fluid " style="width:1000px; height:500px;"
                                    src="{{ asset('images/products/' . $media->file_name) }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                          </div>
                        @endforeach
                        @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- PRODUCT DETAILS-->
            <div class="col-lg-6">
              <ul class="list-inline mb-2 text-sm">
                @if($product->reviews_avg_rating !='')
                    @for($i=0; $i < round($product->reviews_avg_rating); $i++)
                        <li class="list-inline-item mr-0"><i class="fas fa-star text-warning"></i></li>
                    @endfor
                    @for($i=0; $i < 5 - round($product->reviews_avg_rating); $i++)
                        <li class="list-inline-item mr-0"><i class="far fa-star text-warning"></i></li>
                    @endfor
                @else
                    <li class="list-inline-item m-0"><i class="far fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0 1"><i class="far fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0 2"><i class="far fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0 3"><i class="far fa-star small text-warning"></i></li>
                    <li class="list-inline-item m-0 4"><i class="far fa-star small text-warning"></i></li>
                @endif
              </ul>
              <h1>{{ $product->name }}</h1>
              <p class="text-muted lead">LE{{ number_format($product->price,2) }}</p>
              <p class="text-sm mb-4">{!! $product->description !!}</p>
              <div class="row align-items-stretch mb-4">
                <div class="col-sm-5 pr-sm-0">
                  <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                    <span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                    <div class="quantity">
                      <button wire:click.prevent='decreaseQuantity()' class=" p-0"><i class="fas fa-caret-left"></i></button>
                      <input class="form-control border-0 shadow-0 p-0" type="text" wire:model='quantity' onkeydown="return false">
                      <button wire:click.prevent='increaseQuantity()' class=" p-0"><i class="fas fa-caret-right"></i></button>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3 pl-sm-0"><a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" wire:click.prevent='addToCart("{{ $product->id }}")'>Add to cart</a></div>
              </div><a class="text-dark p-0 mb-4 d-inline-block" wire:click.prevent='addToWishlist("{{ $product->id }}")'><i class="far fa-heart me-2"></i>Add to wish list</a><br>
              <ul class="list-unstyled small d-inline-block">
                {{-- <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">SKU:</strong><span class="ms-2 text-muted">039</span></li> --}}
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Category:</strong><a class="reset-anchor ms-2" href="#!">{{ $product->category->name }}</a></li>
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Tags:</strong>
                    <a class="reset-anchor ms-2" href="#!">
                        @foreach ($product->tags as $tag)
                                <span class="badge text-white bg-info">{{$tag->name}}</span>
                        @endforeach
                   </a>
               </li>
              </ul>
            </div>
          </div>
          <!-- DETAILS TABS-->
          <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link text-uppercase active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a></li>
            <li class="nav-item"><a class="nav-link text-uppercase" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a></li>
          </ul>
          <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
              <div class="p-4 p-lg-5 bg-white">
                <h6 class="text-uppercase">{{ $product->name }} description </h6>
                <p class="text-muted text-sm mb-0">{!! $product->description !!}</p>
              </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
              <div class="p-4 p-lg-5 bg-white">
                <div class="row">
                  <div class="col-lg-8">
                    @forelse($product->reviews as $review)
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            @if($review->user->image)
                             <img class="rounded-circle" src="{{ asset('images/users/'.$review->user->image) }}" alt="" width="50"/>
                            @else
                             <img class="rounded-circle" src="{{ asset('images/no-image.jpg') }}" alt="" width="50">
                            @endif
                        </div>
                        <div class="ms-3 flex-shrink-1">
                            <h6 class="mb-0 text-uppercase">{{ $review->user->full_name }}</h6>
                            <p class="small text-muted mb-0 text-uppercase">{{ $review->user->created_at() }}</p>
                            <ul class="list-inline mb-1 text-xs">
                                @if($review->rating !='')
                                    @for($i=0; $i < round($review->rating); $i++)
                                        <li class="list-inline-item mr-0"><i class="fas fa-star text-warning"></i></li>
                                    @endfor
                                    @for($i=0; $i < 5 - round($review->rating); $i++)
                                        <li class="list-inline-item mr-0"><i class="far fa-star text-warning"></i></li>
                                    @endfor
                                @else
                                    <li class="list-inline-item m-0"><i class="far fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="far fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="far fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="far fa-star text-warning"></i></li>
                                    <li class="list-inline-item m-0"><i class="far fa-star text-warning"></i></li>
                                @endif
                            </ul>
                            <p class="text-sm mb-0 text-muted">
                                {!! $review->message !!}
                            </p>
                        </div>
                    </div>
                    @empty
                        <div class="alert alert-info">
                            <strong>No reviews yet!</strong>
                        </div>
                    @endforelse
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- RELATED PRODUCTS-->
          <h2 class="h5 text-uppercase mb-4">Related products</h2>
          <div class="row">
            @forelse($related_products as $product)
            <!-- PRODUCT-->
                <div class="col-lg-3 col-sm-6">
                    <div class="product text-center skel-loader">
                    <div class="d-block mb-3 position-relative"><a class="d-block" href="{{ route('product_details',$product->slug) }}">
                        @if($product->firstMedia)
                        <img class="img-fluid w-100" src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}" >
                        @else
                        <img class="img-fluid w-100" src="{{ asset('images/no-image.jpg') }}" alt="{{ $product->name }}" >
                        @endif
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
              <!-- PRODUCT-->
            @empty
                <div class="alert alert-info">
                    <strong>No related products yet!</strong>
                </div>
            @endforelse
          </div>
        </div>
    </section>
</div>
