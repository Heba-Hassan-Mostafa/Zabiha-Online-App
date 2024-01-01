@extends('admin.layouts.master')
@section('title')
    اضافة مستخدم جديد
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/</span>
        </a>
        <a href="{{ route('admin.categories.index') }}">
            <span class="text-muted fw-light">المستخدمين /</span>
        </a>
        اضافة مستخدم جديد
    </h4>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Form controls -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header"> اضافة مستخدم جديد </h5>
                    <div class="card-body">
                        <form action="{{ route('admin.users.store') }}" method="Post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">الاسم الاول</label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" />
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">الاسم الاخير</label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" />
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> البريد الالكترونى</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الهاتف</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" />
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">كلمة المرور</label>
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control" />
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">تاكيد كلمة المرور</label>
                                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" />
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الصورة</label>
                                <input type="file" name="image" class="form-control" />
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group ">
                                    <div class="col-md-12">
                                        <span>الصلاحية</span>
                                    </div>
                                    <div class="col-md-12">
                                        <select required class="form-control select2" name="roles">
                                            @forelse($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
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
                placeholder: "اختر الصلاحية",
                allowClear: true
            });

        });

    </script>
@endsection
