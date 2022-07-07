@extends('dashboard.layout.master')
@section('title', 'profile')
@section('css')

@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- users view start -->
            <section class="users-view">
                <!-- users view media object start -->
                <div class="row">
                    <div class="col-12 col-sm-7">
                        <div class="media mb-2">

                            @if(Auth::user()->image)
                            <a class="mr-1" href="#">
                                <img src="{{ Auth::user()->adminImage() }}" alt="{{ Auth::user()->full_name }}" class="users-avatar-shadow rounded-circle" height="64" width="64">
                            </a>
                            @else
                            <img src="{{ asset('images/no-image.jpg') }}" alt="{{Auth::user()->full_name }}" class="users-avatar-shadow rounded-circle" height="64" width="64">
                            @endif
                            <div class="media-body pt-25">
                                <h4 class="media-heading"><span class="users-view-name">{{ Auth::user()->full_name }} </span></h4>
                                <span class="users-view-id">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                        <a href="{{ route('admin.profile.edit',Auth::user()->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    </div>
                </div>
                <!-- users view media object ends -->
                <!-- users view card data start -->
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>Created At:</td>
                                                <td>{{ Auth::user()->created_at() }}</td>
                                            </tr>
                                            <tr>
                                                <td>Role:</td>
                                                <td class="users-view-role">
                                                    @foreach(Auth::user()->roles as $role)
                                                        <span class="badge badge-warning">{{ $role->name }}</span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status:</td>
                                                <td><span class="badge badge-success users-view-status">{{ Auth::user()->status() }}</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- users view card data ends -->
                <!-- users view card details start -->
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="col-12">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Username:</td>
                                            <td class="users-view-username">{{ Auth::user()->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>E-mail:</td>
                                            <td class="users-view-email">{{ Auth::user()->email }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5 class="mb-1"><i class="ft-info"></i> Personal Info</h5>
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Birthday:</td>
                                            <td>03/04/1990</td>
                                        </tr>
                                        <tr>
                                            <td>Country:</td>
                                            <td>USA</td>
                                        </tr>
                                        <tr>
                                            <td>Languages:</td>
                                            <td>English</td>
                                        </tr>
                                        <tr>
                                            <td>Contact:</td>
                                            <td>{{ Auth::user()->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- users view card details ends -->

            </section>
            <!-- users view ends -->
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
