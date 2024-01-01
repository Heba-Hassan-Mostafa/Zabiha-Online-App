@extends('admin.layouts.master')
@section('title')
    تعديل قسم
@endsection
@section('content')
    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/</span>
        </a>
        <a href="{{ route('admin.categories.index') }}">
            <span class="text-muted fw-light">اقسام المنتجات/</span>
        </a>
        تعديل فسم
    </h4>


    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Form controls -->
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">تعديل فسم </h5>
                        <div class="card-body">
                            <form action="{{ route('admin.categories.update', $category->id) }}" method="Post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label class="form-label">اسم القسم</label>
                                    <input type="text" name="name" value="{{ $category->name }}"
                                        class="form-control" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">الصورة</label>
                                    <input type="file" name="image" class="form-control" />
                                    @if ($category->image)
                                        <img src="{{ asset('Files/images/categories/' . $category->image) }}"
                                            style="width: 180px;
                                                    height: 180px;
                                                    margin: 0.5rem;">
                                    @else
                                        <span>لا يوجد صورة لهذا القسم</span>
                                    @endif
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="status">الحالة</label>
                                        <select name="status" class="form-control">
                                            <option value="1"
                                                {{ old('status', $category->status) == '1' ? 'selected' : null }}>
                                                ظاهر</option>
                                            <option value="0"
                                                {{ old('status', $category->status) == '0' ? 'selected' : null }}>
                                                مخفى</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
            <!-- / Content -->
        </div>
    @endsection
