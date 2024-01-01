@extends('admin.layouts.master')
@section('title')
    تعديل صورة
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
            <span class="text-muted fw-light"> صور slider/</span>
        </a>
        تعديل صورة
    </h4>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Form controls -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">تعديل صورة  </h5>
                    <div class="card-body">
                        <form action="{{ route('admin.slider.update',$slider->id) }}" method="Post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">الصورة</label>
                                <input type="file" name="file_name" class="form-control" />
                                @if ($slider->file_name)
                                <img src="{{ asset('Files/images/slider/'.$slider->file_name) }}" style="width: 150px; height:150px; margin:0.5rem">
                                @else
                                <span>لا يوجد صورة  </span>
                                @endif
                                @error('file_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">المسار</label>
                                <input type="url" name="url" value="{{ $slider->url }}" class="form-control">
                                @error('url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="product_id">المنتجات</label>
                                    <select name="product_id" class="form-control search">
                                        <option selected disabled value="">اختر المنتج </option>
                                        @forelse ($products as $product)
                                            <option value="{{ $product->id }}" {{ $slider->product_id == $product->id ? 'selected' : ''}}>
                                                {{ $product->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('product_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="status">الحالة</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status', $slider->status) == '1' ? 'selected' : null }}>
                                           ظاهر</option>
                                        <option value="0" {{ old('status', $slider->status) == '0' ? 'selected' : null }}>
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
    @endsection
    @section('script')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.search').select2({
                theme: "classic"
            });
        });
        </script>
@endsection
