@extends('dashboard.layout.master')
@section('title', ' reviews')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Edit review</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">لوحه التحكم</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}"> reviews</a>
                                </li>
                                <li class="breadcrumb-item active">edit review
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
                                        <form class="form" action="{{ route('admin.reviews.update',$review->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="name"> review name</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="review Name"
                                                                   name="name" id="name"
                                                                   value="{{ old('name',$review->name) }}" >
                                                            @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email"> email</label>
                                                            <input type="email"
                                                                   class="form-control"
                                                                   placeholder="review email"
                                                                   name="email" id="email"
                                                                   value="{{ old('email',$review->email) }}" >
                                                            @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="status">Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="" readonly selected disabled >--select status--</option>
                                                            <option value="1" {{ old('status',$review->status) == '1' ? 'selected' : null }}>Active</option>
                                                            <option value="0" {{ old('status',$review->status) == '0' ? 'selected' : null }}>Inactive</option>
                                                        </select>
                                                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="rating">Rating</label>
                                                        <select name="rating" class="form-control">
                                                            <option value="" readonly selected disabled >--select rating--</option>
                                                            <option value="1" {{ old('rating',$review->rating) == '1' ? 'selected' : null }}>1</option>
                                                            <option value="2" {{ old('rating',$review->rating) == '2' ? 'selected' : null }}>2</option>
                                                            <option value="3" {{ old('rating',$review->rating) == '3' ? 'selected' : null }}>3</option>
                                                            <option value="4" {{ old('rating',$review->rating) == '4' ? 'selected' : null }}>4</option>
                                                            <option value="5" {{ old('rating',$review->rating) == '5' ? 'selected' : null }}>5</option>
                                                        </select>
                                                        @error('rating')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="user">Customer name</label>
                                                            <input type="text" readonly
                                                                   class="form-control"
                                                                   value="{{ $review->user_id != '' ? $review->user->firstname . ' '. $review->user->lastname : '-'}}" >
                                                            <input type="hidden" readonly
                                                                   class="form-control"
                                                                   name="user_id" id="user"
                                                                   value="{{ $review->user_id ?? '-' }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="product">product name</label>
                                                            <input type="text" readonly
                                                                   class="form-control"
                                                                   value="{{ old('product',$review->product->name) }}" >
                                                            <input type="hidden" readonly
                                                                   class="form-control"
                                                                   name="product_id" id="product"
                                                                   value="{{ old('product_id',$review->product_id) }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 ">
                                                        <fieldset  class="form-group">
                                                            <label for="title">Title</label>
                                                            <textarea  class="form-control summernote" name="title" rows="3" placeholder="discripe product">
                                                                {!! old('title',$review->title) !!}
                                                            </textarea>
                                                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-md-12 ">
                                                        <fieldset  class="form-group">
                                                            <label for="message">Message</label>
                                                            <textarea  class="form-control summernote" name="message" rows="3" placeholder="discripe product">
                                                                {!! old('message',$review->message) !!}
                                                            </textarea>
                                                            @error('message')<span class="text-danger">{{ $message }}</span>@enderror
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Edit Review
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

