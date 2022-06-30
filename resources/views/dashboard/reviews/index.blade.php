@extends('dashboard.layout.master')
@section('title', 'Reviews')
@section('css')

@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Reviews</h3>
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
                                <h4 class="card-title">Reviews
                                    <span style="color: red;font-weight:bolder;"> {{\App\Models\Review::count() }} </span>
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
                                <a href="{{ route('admin.reviews.index') }}" class="btn btn-info mb-3 " style="margin-left: 50px;float: left;">
                                    <i class="icon-action-undo"></i> Back to Reviews
                                </a>
                                {{-- <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary mb-3 " style="margin-right: 10px">
                                    <i class="icon-plus"></i> Add New review
                                </a> --}}
                                <button type="button" class="btn btn-warning mb-3" style="margin-right: 10px"
                                    id="btn_delete_all" data-toggle="modal"
                                    data-target="#bulkdelete" >
                                    <i class="icon-trash"></i>
                                    Bulk Delete
                                </button>

                                <div class="card-body card-dashboard">
                                    @include('dashboard.Reviews.filter')
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th> <input type="checkbox" name="select_all" id="select-all"> </th>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Title</th>
                                                    <th>Product Name</th>
                                                    <th>Rating</th>
                                                    <th>Status</th>
                                                    <th>created at</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($reviews as $index=>$review)
                                                    <tr>
                                                       <th >
                                                        <div class="animated-checkbox">
                                                            <label class="m-0">
                                                                <input type="checkbox" value="{{ $review->id }}" name="delete_select" id="delete_select">
                                                                <span class="label-text"></span>
                                                            </label>
                                                        </div>
                                                       </th>
                                                        <th scope="row">{{ $index +1 }}</th>
                                                        <td>
                                                            {{ $review->name  }} <br>
                                                            {{  $review->email }} <br>
                                                            <span class="badge badge-success">{!! $review->user_id != '' ? $review->user->firstname . ' '. $review->user->lastname :'-' !!}</span>
                                                        </td>
                                                        <td title="{{ $review->title }}" style="color: red;">{{ Str::limit($review->title,20) }}</td>
                                                        <td >{{ $review->product->name }}</td>
                                                        <td > <span class="badge badge-success">{{ $review->rating ?? '-'}}</span></td>
                                                        <td>{{ $review->status()}}</td>
                                                        <td>{{ $review->created_at() }}</td>
                                                        <td>
                                                            @include('dashboard.Reviews.action')
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="12" class="text-center">no Reviews found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <tfoot>
                                            <tr>
                                                <th colspan="6">
                                                    <div class="float-right">
                                                        {!! $reviews->appends(request()->all())->links() !!}
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
@section('js')

@endsection
