@extends('dashboard.layout.master')
@section('title', 'product_categories')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Products</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحه التحكم</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Products
                                    <span style="color: red;font-weight:bolder;"> {{\App\Models\Product::count() }} </span>
                                </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-info mb-3 " style="margin-left: 50px;float: left;">
                                    <i class="icon-action-undo"></i> Back to product
                                </a>
                                @if (auth()->user()->hasPermission('create_products'))
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3 " style="margin-right: 10px">
                                    <i class="icon-plus"></i> Add new product
                                </a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_products'))
                                <button type="button" class="btn btn-warning mb-3" style="margin-right: 10px"
                                    id="btn_delete_all" data-toggle="modal"
                                    data-target="#bulkdelete" >
                                    <i class="icon-trash"></i>
                                    Delete All
                                </button>
                                @endif
                                <div class="card-body card-dashboard">
                                    @include('dashboard.products.filter')
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th> <input type="checkbox" name="select_all" id="select-all"> </th>
                                                    <th>#</th>
                                                    <th>Cover</th>
                                                    <th>Name</th>
                                                    <th>Category Name</th>
                                                    <th>tag</th>
                                                    {{-- <th>Dscription</th> --}}
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Feature</th>
                                                    <th>status</th>
                                                    <th>created at</th>
                                                    <th class="text-center" >Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($products as $index=>$product)
                                                    <tr>
                                                       <th>
                                                        <div class="animated-checkbox">
                                                            <label class="m-0">
                                                                <input type="checkbox" value="{{ $product->id }}" name="delete_select" id="delete_select">
                                                                <span class="label-text"></span>
                                                            </label>
                                                        </div>
                                                       </th>
                                                        <th scope="row">{{ $index +1 }}</th>
                                                        <td>
                                                            @if($product->firstMedia)
                                                            <img src="{{ asset('images/products/'.$product->firstMedia->file_name) }}" alt="{{ $product->name }}" class="img-thumbnail" width="100px" height="100px">
                                                            @else
                                                            <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $product->name }}" class="img-thumbnail" width="100px">
                                                            @endif
                                                        </td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->category->name }}</td>
                                                        {{-- <td>{{ $product->tags->pluck('name')->join(', ') }}</td> --}}
                                                        <td>
                                                            @foreach ($product->tags as $tag)
                                                                <div class="text-primary text-bold">
                                                                    <span>{{$tag->name}}</span>
                                                                </div>
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>{{ $product->quantity }}</td>
                                                        <td>{{ $product->featured() }}</td>
                                                        <td>{{ $product->status()}}</td>
                                                        <td>{{ $product->created_at() }}</td>
                                                        <td>
                                                            @include('dashboard.products.action')
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="12" class="text-center">No product found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <tfoot>
                                            <tr>
                                                <th colspan="6">
                                                    <div class="float-right">
                                                        {!! $products->appends(request()->all())->links() !!}
                                                    </div>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </div>
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
