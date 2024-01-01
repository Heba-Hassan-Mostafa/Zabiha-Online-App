@extends('admin.layouts.master')
@section('title')
    اضافة خيار جديد  
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/</span>
        </a>
        <a href="{{ route('admin.options.index') }}">
            <span class="text-muted fw-light">الخيارات/</span>
        </a>
        اضافة خيار جديد
    </h4>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Form controls -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header"> اضافة خيار جديد </h5>
                    <div class="card-body">
                        <form action="{{ route('admin.options.store') }}" method="Post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">الاسم</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <span>نوع الادخال</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select required class="form-control" name="input_type">
                                            <option selected disabled value="">اختار نوع الادخال</option>
                                            @foreach (config('types.input_types') as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group ">
                                    <div class="col-md-12">
                                        <span> اقسام المنتجات</span>
                                    </div>
                                    <div class="col-md-8">
                                        <select required class="form-control select2" name="categories[]"
                                            multiple="multiple">
                                            @forelse($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
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
        <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Select2 Multiple
                $('.select2').select2({
                    placeholder: "اختر القسم",
                    allowClear: true
                });
    
            });
    
        </script>
    @endsection
