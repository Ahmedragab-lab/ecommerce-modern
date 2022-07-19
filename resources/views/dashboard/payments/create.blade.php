@extends('dashboard.layout.master')
@section('title', 'payment_method')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Add New Payment</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحه التحكم</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.payment_method.index') }}">payment method</a>
                                </li>
                                <li class="breadcrumb-item active">Add new Payment Method
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
                                        <form class="form" action="{{ route('admin.payment_method.store') }}" method="post" >
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="Name"
                                                                   name="name"
                                                                   value="{{ old('name') }}" >
                                                            @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="code">code</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="code"
                                                                   name="code"
                                                                   value="{{ old('code') }}" >
                                                            @error('code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="driver_name">Driver Name</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="driver_name"
                                                                   name="driver_name"
                                                                   value="{{ old('driver_name') }}" >
                                                            @error('driver_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="merchant_email">Merchant Email</label>
                                                            <input type="email"
                                                                   class="form-control"
                                                                   placeholder="merchant_email"
                                                                   name="merchant_email"
                                                                   value="{{ old('merchant_email') }}" >
                                                            @error('merchant_email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="username">Username</label>
                                                            <input type="email"
                                                                   class="form-control"
                                                                   placeholder="username"
                                                                   name="username"
                                                                   value="{{ old('username') }}" >
                                                            @error('username')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password">Password</label>
                                                            <input type="password"
                                                                   class="form-control"
                                                                   placeholder="password"
                                                                   name="password"
                                                                   value="{{ old('password') }}" >
                                                            @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="secret">secret</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="secret"
                                                                   name="secret"
                                                                   value="{{ old('secret') }}" >
                                                            @error('secret')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sandbox_merchant_email">sandbox_merchant_email</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="sandbox_merchant_email"
                                                                   name="sandbox_merchant_email"
                                                                   value="{{ old('sandbox_merchant_email') }}" >
                                                            @error('sandbox_merchant_email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sandbox_username">sandbox_username</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="sandbox_username"
                                                                   name="sandbox_username"
                                                                   value="{{ old('sandbox_username') }}" >
                                                            @error('sandbox_username')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sandbox_password">sandbox_password</label>
                                                            <input type="password"
                                                                   class="form-control"
                                                                   placeholder="sandbox_password"
                                                                   name="sandbox_password"
                                                                   value="{{ old('sandbox_password') }}" >
                                                            @error('sandbox_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sandbox_secret">sandbox_secret</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="sandbox_secret"
                                                                   name="sandbox_secret"
                                                                   value="{{ old('sandbox_secret') }}" >
                                                            @error('sandbox_secret')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="sandbox">sandbox</label>
                                                        <select name="sandbox" class="form-control">
                                                            <option readonly selected disabled >--select sandbox--</option>
                                                            <option value="1" {{ old('sandbox') == '1' ? 'selected' : null }}>Sandbox</option>
                                                            <option value="0" {{ old('sandbox') == '0' ? 'selected' : null }}>Live</option>
                                                        </select>
                                                        @error('sandbox')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="status">Status</label>
                                                        <select name="status" class="form-control">
                                                            <option  readonly selected disabled >--select status--</option>
                                                            <option value="1" {{ old('status') == '1' ? 'selected' : null }}>Active</option>
                                                            <option value="0" {{ old('status') == '0' ? 'selected' : null }}>Inactive</option>
                                                        </select>
                                                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
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
