@extends('dashboard.layout.master')
@section('title', 'Reviews-show')
@section('css')

@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Reviews Show</h3>
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
                                    <h4 class="card-title">Reviews show </h4>
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
                                    <a class="btn btn-success" href="{{ route('admin.reviews.edit',$review->id )}}" title="edit" style="margin-left: 50px;float: left;">
                                        <i class="icon-note"></i> Edit Review
                                    </a>
                                    <div class="card-body card-dashboard">
                                        <div class="row" id="ui">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-content collapse show">
                                                        <div class="table-responsive">
                                                            <table class="table table-responsive table-bordered mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="width-200">Name</td>
                                                                        <td>{{ $review->name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Email</td>
                                                                        <td>{{  $review->email }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Customer Name</td>
                                                                        <td>{{ $review->user->firstname . ' '. $review->user->lastname }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Rating</td>
                                                                        <td > <span class="badge badge-success">{{ $review->rating ?? '-'}}</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Title</td>
                                                                        <td>{{ $review->title }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Message</td>
                                                                        <td>{{ $review->message }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Product Name</td>
                                                                        <td>{{ $review->product->name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Product Image</td>
                                                                        <td>
                                                                            @if($review->product->firstMedia)
                                                                                <img src="{{ asset('images/products/'.$review->product->firstMedia->file_name) }}" alt="" class="img-thumbnail" width="100px" height="100px">
                                                                            @else
                                                                                <img src="{{ asset('images/no-image.jpg') }}" alt="" class="img-thumbnail" width="100px">
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Created At</td>
                                                                        <td>{{ $review->created_at() }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
