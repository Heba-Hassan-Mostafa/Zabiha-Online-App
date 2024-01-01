@extends('admin.layouts.master')
@section('title')
    اضافة كوبون جديد
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
        <a href="{{ route('admin.categories.index') }}">
            <span class="text-muted fw-light">اقسام المنتجات/</span>
        </a>
        اضافة كوبون جديد
    </h4>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Form controls -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header"> اضافة كوبون جديد </h5>
                    <div class="card-body">
                        <form action="{{ route('admin.coupons.store') }}" method="Post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">اسم الكوبون</label>
                                <input type="text" name="name"  id="code" value="{{ old('name') }}" class="form-control" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> الخصم</label>
                                <input type="text" name="discount" value="{{ old('discount') }}" class="form-control" />
                                @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="type">النوع</label>
                                    <select name="type" class="form-control">
                                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : null }}>
                                            fixed</option>
                                        <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : null }}>
                                            percentage</option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> اقصى عدد للاستخدام</label>
                                <input type="number" name="max_users" value="{{ old('max_users') }}"
                                    class="form-control" />
                                @error('max_users')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> من</label>
                                <input type="text" name="valid_from" id="valid_from" value="{{ old('valid_from') }}" class="form-control">
                                    @error('valid_from')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> الى</label>
                                <input type="text" name="valid_to" id="valid_to" value="{{ old('valid_to') }}" class="form-control">
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
