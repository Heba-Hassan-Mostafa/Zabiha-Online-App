@extends('admin.layouts.master')
@section('title')
    تعديل المنتج
@endsection
@section('content')
    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/</span>
        </a>
        <a href="{{ route('admin.categories.index') }}">
            <span class="text-muted fw-light"> المنتجات/</span>
        </a>
        تعديل  المنتج
    </h4>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Form controls -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header"> تعديل المنتج  </h5>
                    <div class="card-body">
                        <form action="{{ route('admin.products.update',$product->id) }}" method="Post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">اسم المنتج</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="category_id">القسم التابع لة</label>
                                    <select name="category_id" class="form-control">
                                        @forelse ($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}</option>
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
                                            <option value="{{ $city->id }}" {{ $product->city_id == $city->id ? 'selected' : '' }}>
                                                {{ $city->name_ar }}</option>
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
                                        <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : null }}>
                                           ظاهر</option>
                                        <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : null }}>
                                            مخفى</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> السعر</label>
                                <input type="text" name="main_price" value="{{ $product->main_price }}"
                                    class="form-control" />
                                @error('main_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> السعر بعد الخصم</label>
                                <input type="text" name="discount_price" value="{{ $product->discount_price }}"
                                    class="form-control" />
                                @error('discount_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الكمية المتاحة </label>
                                <input type="number" name="store_quantity" value="{{ $product->store_quantity }}"
                                    class="form-control" />
                                @error('store_quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الوصف</label>
                                <textarea name="description" class="form-control">{!! $product->description !!}</textarea>
                                @error('discount_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الصورة</label>
                                <input type="file" accept="image/*" name="image" class="form-control" />
                                @if ($product->image)
                                <img src="{{ asset('Files/images/products/'.$product->image) }}" style="width: 100px; height:100px;margin-top : 5px">
                                @else
                                <span>لا يوجد صورة لهذا المنتج</span>
                                @endif
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
