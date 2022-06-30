@extends('dashboard.layout.master')
@section('title', 'coupons')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Add new coupon</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحه التحكم</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">coupons</a>
                                </li>
                                <li class="breadcrumb-item active">Add new coupon
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
                                        <form class="form" action="{{ route('admin.coupons.store') }}" method="post">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="code">coupon Code</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="coupon Name"
                                                                   name="code" id="code"
                                                                   value="{{ old('code') }}" >
                                                            @error('code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="status">Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="" readonly selected disabled >--select status--</option>
                                                            <option value="1" {{ old('status') == '1' ? 'selected' : null }}>Active</option>
                                                            <option value="0" {{ old('status') == '0' ? 'selected' : null }}>Inactive</option>
                                                        </select>
                                                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="type">Type</label>
                                                        <select name="type" class="form-control">
                                                            <option value="" readonly selected disabled >--select Type--</option>
                                                            <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : null }}>Fixed</option>
                                                            <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : null }}>Percentage</option>
                                                        </select>
                                                        @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="value">coupon value</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="coupon value"
                                                                   name="value"
                                                                   value="{{ old('value') }}" >
                                                            @error('value')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="start_date">Start Date</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="coupon start_date"
                                                                   name="start_date" id="start_date"
                                                                   value="{{ old('start_date') }}" >
                                                            @error('start_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="expire_date">Expire Date</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="coupon expire_date"
                                                                   name="expire_date" id="expire_date"
                                                                   value="{{ old('expire_date') }}" >
                                                            @error('expire_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="greater_than">greater than</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="coupon greater_than"
                                                                   name="greater_than"
                                                                   value="{{ old('greater_than') }}" >
                                                            @error('greater_than')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="use_times">use times</label>
                                                            <input type="number" min="1"
                                                                   class="form-control"
                                                                   placeholder="coupon use_times"
                                                                   name="use_times"
                                                                   value="{{ old('use_times') }}" >
                                                            @error('use_times')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 ">
                                                        <fieldset  class="form-group">
                                                            <label for="description">Description</label>
                                                            <textarea  class="form-control summernote" name="description" rows="3" placeholder="discripe product">
                                                                {!! old('description') !!}
                                                            </textarea>
                                                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Add Coupon
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
@section('js')
<script>
    $(function(){
        $('#code').keyup(function () {
            this.value = this.value.toUpperCase();
        });

        $('#start_date').pickadate({
            format: 'yyyy-mm-dd',
            selectMonths: true, // Creates a dropdown to control month
            selectYears: true, // Creates a dropdown to control month
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: true // Close upon selecting a date,
        });
        var startdate = $('#start_date').pickadate('picker');
        var enddate = $('#expire_date').pickadate('picker');

        $('#start_date').change(function() {
            selected_ci_date ="";
            selected_ci_date = $('#start_date').val();
            if (selected_ci_date != null)   {
                var cidate = new Date(selected_ci_date);
                min_codate = "";
                min_codate = new Date();
                min_codate.setDate(cidate.getDate()+1);
                enddate.set('min', min_codate);
            }
        });

        $('#expire_date').pickadate({
            format: 'yyyy-mm-dd',
            min : new Date(),
            selectMonths: true, // Creates a dropdown to control month
            selectYears: true, // Creates a dropdown to control month
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: true // Close upon selecting a date,
        });

    });
</script>
@endsection
