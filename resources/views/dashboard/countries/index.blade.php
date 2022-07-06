@extends('dashboard.layout.master')
@section('title', 'countries')
@section('css')

@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">countries</h3>
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
                                <h4 class="card-title">countries
                                    <span style="color: red;font-weight:bolder;"> {{\App\Models\Country::count() }} </span>
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
                                <a href="{{ route('admin.countries.index') }}" class="btn btn-info mb-3 " style="margin-left: 50px;float: left;">
                                    <i class="icon-action-undo"></i> Back to countries
                                </a>
                                {{-- <a href="{{ route('admin.countries.create') }}" class="btn btn-primary mb-3 " style="margin-right: 10px">
                                    <i class="icon-plus"></i> Add New Country
                                </a> --}}
                                <button type="button" class="btn btn-primary  mb-3" data-toggle="modal"
                                        data-target="#add">
                                        <i class="icon-plus"></i>
                                    Add New Country
                                </button>
                                @include('dashboard.countries.create')
                                <button type="button" class="btn btn-warning mb-3" style="margin-right: 10px"
                                    id="btn_delete_all" data-toggle="modal"
                                    data-target="#bulkdelete" >
                                    <i class="icon-trash"></i>
                                    Bulk Delete
                                </button>

                                <div class="card-body card-dashboard">
                                    @include('dashboard.countries.filter')
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th> <input type="checkbox" name="select_all" id="select-all"> </th>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>State Num</th>
                                                    <th>status</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($countries as $index=>$country)
                                                    <tr>
                                                       <th >
                                                        <div class="animated-checkbox">
                                                            <label class="m-0">
                                                                <input type="checkbox" value="{{ $country->id }}" name="delete_select" id="delete_select">
                                                                <span class="label-text"></span>
                                                            </label>
                                                        </div>
                                                       </th>
                                                        <th scope="row">{{ $index +1 }}</th>
                                                        <td>{{ $country->name }}</td>
                                                        <td> <span class="badge block badge-primary">{{ $country->states->count() }}</span></td>
                                                        <td>{{ $country->status()}}</td>
                                                        <td>
                                                            @include('dashboard.countries.action')
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="12" class="text-center">no countries found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <tfoot>
                                            <tr>
                                                <th colspan="6">
                                                    <div class="float-right">
                                                        {!! $countries->appends(request()->all())->links() !!}
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
