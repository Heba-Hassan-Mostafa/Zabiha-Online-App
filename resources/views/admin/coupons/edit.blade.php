@extends('admin.layouts.master')
@section('title')
    تعديل كوبون
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/datepicker/themes/classic.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/datepicker/themes/classic.date.css') }}">
<style>
    .picker__select--month, .picker__select--year {
        padding: 0 !important;
    }
</style>
@endsection
@section('content')
    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/</span>
        </a>
        <a href="{{ route('admin.coupons.index') }}">
            <span class="text-muted fw-light"> كوبونات الخصم/</span>
        </a>
        تعديل كوبون
    </h4>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Form controls -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header"> تعديل كوبون </h5>
                    <div class="card-body">
                        <form action="{{ route('admin.coupons.update',$coupon->id) }}" method="Post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">اسم الكوبون</label>
                                <input type="text" name="name"  id="code" value="{{ $coupon->name }}" class="form-control" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> الخصم</label>
                                <input type="text" name="discount" value="{{ $coupon->discount }}" class="form-control" />
                                @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="type">النوع</label>
                                    <select name="type" class="form-control">
                                        <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : null }}>
                                            fixed</option>
                                        <option value="percentage" {{ $coupon->type == 'percentage' ? 'selected' : null }}>
                                            percentage</option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> اقصى عدد للاستخدام</label>
                                <input type="number" name="max_users" value="{{ $coupon->max_users }}"
                                    class="form-control" />
                                @error('max_users')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> من</label>
                                <input type="text" name="valid_from" id="valid_from" value="{{ $coupon->valid_from }}" class="form-control">
                                    @error('valid_from')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> الى</label>
                                <input type="text" name="valid_to" id="valid_to" value="{{ $coupon->valid_to }}" class="form-control">
                                    @error('valid_to')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group pt-4 mr-4">
                                <button type="submit" name="save" class="btn btn-primary">
                                    حفظ</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    @endsection
    @section('script')
    <script src="{{ asset('assets/vendor/datepicker/picker.js') }}"></script>
    <script src="{{ asset('assets/vendor/datepicker/picker.date.js') }}"></script>
    <script>
        $(function(){
            $('#code').keyup(function () {
                this.value = this.value.toUpperCase();
            });

            $('#valid_from').pickadate({
                format: 'yyyy-mm-dd',
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // Creates a dropdown to control month
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true // Close upon selecting a date,
            });
            var startdate = $('#valid_from').pickadate('picker');
            var enddate = $('#expire_date').pickadate('picker');

            $('#valid_from').change(function() {
                selected_ci_date ="";
                selected_ci_date = $('#valid_from').val();
                if (selected_ci_date != null)   {
                    var cidate = new Date(selected_ci_date);
                    min_codate = "";
                    min_codate = new Date();
                    min_codate.setDate(cidate.getDate()+1);
                    enddate.set('min', min_codate);
                }
            });

            $('#valid_to').pickadate({
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
