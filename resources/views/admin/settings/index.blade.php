@extends('admin.layouts.master')
@section('title')
    الاعدادات
@endsection
@section('content')
    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/</span>
        </a>
        <a href="{{ route('admin.settings.index') }}">
            <span class="text-muted fw-light"> الاعدادات</span>
        </a>

    </h4>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Form controls -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header"> الاعدادات </h5>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.update','test') }}" method="Post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label"> الاسم</label>
                                <input type="text" name="app_name" value="{{ $setting['app_name'] }}" class="form-control" />
                                @error('app_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> القيمة المضافة</label>
                                <input type="text" name="value_added" value="{{ $setting['value_added'] }}"
                                    class="form-control" />
                                @error('value_added')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">من نحن</label>
                                <textarea name="about_us" class="form-control">{!!  $setting['about_us'] !!}</textarea>
                                @error('about_us')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                              <label class="form-label">سياسة الخصوصية</label>
                              <textarea name="privacy_policy" class="form-control">{!! $setting['privacy_policy'] !!}</textarea>
                              @error('privacy_policy')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>

                          <div class="mb-3">
                              <label class="form-label">الشروط والاحكام</label>
                              <textarea name="terms_conditions" class="form-control">{!! $setting['terms_conditions'] !!}</textarea>
                              @error('terms_conditions')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>


                            <div class="mb-3">
                                <label class="form-label">لوجو</label>
                                <input type="file" accept="image/*" name="logo" class="form-control" />

                                @if ($setting['logo'])
                              <img class="mt-2" style="width: 100px; height:100px;" src="{{ URL::asset('Files/images/settings/'.$setting['logo']) }}" alt="">
                              @else
                              <span>لا يوجد صورة  لوجو</span>
                              @endif
                                @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group pt-4 mr-4">
                                <button type="submit" name="save" class="btn btn-primary"> حفظ</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    @endsection
