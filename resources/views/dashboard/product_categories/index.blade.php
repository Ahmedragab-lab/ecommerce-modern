@extends('dashboard.layout.master')
@section('title', 'product_categories')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">اقسام المنتجات</h3>
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
                                <h4 class="card-title">اقسام المنتجات
                                    <span style="color: red;font-weight:bolder;"> {{\App\Models\ProductCategory::count() }} </span>
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
                                <a href="{{ route('admin.product_categories.index') }}" class="btn btn-info mb-3 " style="margin-left: 50px;float: left;">
                                    <i class="icon-action-undo"></i> الرجوع الى الاقسام
                                </a>
                                <a href="{{ route('admin.product_categories.create') }}" class="btn btn-primary mb-3 " style="margin-right: 10px">
                                    <i class="icon-plus"></i> اضف قسم جديد
                                </a>
                                <button type="button" class="btn btn-warning mb-3" style="margin-right: 10px"
                                    id="btn_delete_all" data-toggle="modal"
                                    data-target="#bulkdelete" >
                                    <i class="icon-trash"></i>
                                    مسح الكل
                                </button>

                                <div class="card-body card-dashboard">
                                    @include('dashboard.product_categories.filter')
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th> <input type="checkbox" name="select_all" id="select-all"> </th>
                                                    <th>#</th>
                                                    <th>Cover</th>
                                                    <th>Name</th>
                                                    <th>product count</th>
                                                    <th>parent</th>
                                                    <th>status</th>
                                                    <th>created at</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($cats as $index=>$cat)
                                                    <tr>
                                                       <th>
                                                        <div class="animated-checkbox">
                                                            <label class="m-0">
                                                                <input type="checkbox" value="{{ $cat->id }}" name="delete_select" id="delete_select">
                                                                <span class="label-text"></span>
                                                            </label>
                                                        </div>
                                                       </th>
                                                        <th scope="row">{{ $index +1 }}</th>
                                                        <td>
                                                            @if($cat->cover)
                                                            <img src="{{ asset('images/product_categories/'.$cat->cover) }}" alt="{{ $cat->name }}" class="img-thumbnail" width="100px">
                                                            @else
                                                            <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $cat->name }}" class="img-thumbnail" width="100px">
                                                            @endif
                                                        </td>
                                                        <td>{{ $cat->name }}</td>
                                                        <td>{{ $cat->products_count }}</td>
                                                        <td>{{ $cat->parents()}}</td>
                                                        <td>{{ $cat->status()}}</td>
                                                        <td>{{ $cat->created_at() }}</td>
                                                        <td>
                                                            @include('dashboard.product_categories.action')
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="12" class="text-center">no category</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <tfoot>
                                            <tr>
                                                <th colspan="12">
                                                    <div class="float-right">
                                                        {!! $cats->appends(request()->all())->links() !!}
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
