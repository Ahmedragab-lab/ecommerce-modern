@extends('dashboard.layout.master')
@section('title', 'products')
@section('fileinputcss')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/fileinput/css/fileinput.min.css') }}">
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Edit product :<strong style="color: red;">{{ $product->name }}</strong></h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحه التحكم</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a>
                                </li>
                                <li class="breadcrumb-item active">Edit product
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('admin.products.update',$product->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Product Name</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="Product Name"
                                                                   name="name"
                                                                   value="{{ old('name',$product->name) }}" >
                                                            @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="price">Price</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="Product Price"
                                                                   name="price"
                                                                   value="{{ old('price',$product->price) }}" >
                                                            @error('price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="quantity">Quantity</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="Product Quantity"
                                                                   name="quantity"
                                                                   value="{{ old('quantity',$product->quantity) }}" >
                                                            @error('quantity')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="product_category_id">Categories</label>
                                                            <select name="product_category_id" class="form-control select2">
                                                                <option value="" selected disabled readonly>---Selet category---</option>
                                                                @forelse($cats as $cat)
                                                                    <option value="{{ $cat->id }}"
                                                                        {{ old('product_category_id',$product->product_category_id)==$cat->id?'selected':null }} >
                                                                        {{ $cat->name }}
                                                                    </option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                            @error('product_category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- @dd($product->tags->pluck('id')->toArray()) --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tags">Tags</label>
                                                                <select name="tags[]" class="select2 form-control" multiple="multiple" id="id_h5_multi">
                                                                <optgroup label="---Select tags---">
                                                                    @forelse($tags as $tag)
                                                                        <option value="{{ $tag->id }}"
                                                                            {{ in_array($tag->id,$product->tags->pluck('id')->toArray()) ? 'selected' : null }} >
                                                                            {{ $tag->name }}
                                                                        </option>
                                                                    @empty
                                                                    @endforelse
                                                                </optgroup>
                                                            </select>
                                                            @error('tags')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="status">Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="" selected readonly disabled>--select status--</option>
                                                            <option value="1" {{ old('status',$product->status) == '1' ? 'selected' : null }}>Active</option>
                                                            <option value="0" {{ old('status',$product->status) == '0' ? 'selected' : null }}>Inactive</option>
                                                        </select>
                                                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="featured">Featured</label>
                                                        <select name="featured" class="form-control">
                                                            <option value="" selected readonly disabled>--select Featured--</option>
                                                            <option value="1" {{ old('featured',$product->featured) == '1' ? 'selected' : null }}>Yes</option>
                                                            <option value="0" {{ old('featured',$product->featured) == '0' ? 'selected' : null }}>No</option>
                                                        </select>
                                                        @error('featured')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                    <div class="col-md-12 ">
                                                        <fieldset  class="form-group">
                                                            <label for="description">Description</label>
                                                            <textarea  class="form-control summernote" name="description" rows="3" placeholder="discripe product">
                                                                {!! old('description',$product->description) !!}
                                                            </textarea>
                                                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row pt-4">
                                                    <div class="col-12">
                                                        <label for="images">Images</label>
                                                        <br>
                                                        <div class="file-loading">
                                                            <input type="file" name="images[]" id="product-images" class="file-input-overview" multiple="multiple">
                                                            @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('fileinputjs')
<script src="{{ asset('dashboard/fileinput/js/plugins/piexif.min.js') }}"></script>
<script src="{{ asset('dashboard/fileinput/js/plugins/sortable.min.js') }}"></script>
<script src="{{ asset('dashboard/fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('dashboard/fileinput/themes/bs5/theme.min.js') }}"></script>
<script>
        $(function(){
            $("#product-images").fileinput({
                    theme: "bs5",
                    maxFileCount: 5,
                    allowedFileTypes: ['image'],
                    showCancel: true,
                    showRemove: false,
                    showUpload: false,
                    overwriteInitial: false,
                    initialPreview: [
                        @if($product->media()->count() > 0)
                            @foreach($product->media as $media)
                                "{{ asset('images/products/' . $media->file_name) }}",
                            @endforeach
                        @endif
                    ],
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: [
                        @if($product->media()->count() > 0)
                            @foreach($product->media as $media)
                                {
                                    caption: "{{ $media->file_name }}",
                                    size: '{{ $media->file_size }}',
                                    width: "120px",
                                    url: "{{ route('admin.products.remove_image', ['image_id' => $media->id, 'product_id' => $product->id, '_token' => csrf_token()]) }}",
                                    key: {{ $media->id }}
                                },
                            @endforeach
                        @endif
                    ]
                }).on('filesorted', function (event, params) {
                    console.log(params.previewId, params.oldIndex, params.newIndex, params.stack);
                });
        });
</script>
@endsection
