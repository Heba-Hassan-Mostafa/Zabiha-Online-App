@extends('admin.layouts.master')
@section('title')
    اضافة منتج جديد
@endsection
@section('content')
    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/</span>
        </a>
        <a href="{{ route('admin.categories.index') }}">
            <span class="text-muted fw-light"> المنتجات/</span>
        </a>
        اضافة منتج جديد
    </h4>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Form controls -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header"> اضافة منتج جديد </h5>
                    <div class="card-body">
                        <form action="{{ route('admin.products.store') }}" method="Post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">اسم المنتج</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="category_id">القسم التابع لة</label>
                                    <select name="category_id" class="form-control">
                                        @forelse ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @empty
                                        @endforelse

                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="city_id"> المدينة</label>
                                    <select name="city_id" class="form-control">
                                        @forelse ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name_ar }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('city_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="status">الحالة</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status') == '1' ? 'selected' : null }}>
                                            ظاهر</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : null }}>
                                            مخفى</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> السعر</label>
                                <input type="text" name="main_price" value="{{ old('main_price') }}"
                                    class="form-control" />
                                @error('main_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> السعر بعد الخصم</label>
                                <input type="text" name="discount_price" value="{{ old('discount_price') }}"
                                    class="form-control" />
                                @error('discount_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الكمية المتاحة </label>
                                <input type="number" name="store_quantity" value="{{ old('store_quantity') }}"
                                    class="form-control" />
                                @error('store_quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الوصف</label>
                                <textarea name="description" class="form-control">{!! old('description') !!}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الصورة</label>
                                <input type="file" accept="image/*" name="image" class="form-control" />
                                @error('image')
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
