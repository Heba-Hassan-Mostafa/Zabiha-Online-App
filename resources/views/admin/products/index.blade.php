@extends('admin.layouts.master')
@section('title')
     المنتجات
@endsection
@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/
            </span>
        </a>
         المنتجات
    </h4>
    <a class="btn btn-primary mb-2" href="{{ route('admin.products.create') }}">اضافة منتج جديد</a>

    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم المنتج</th>
                        <th>القسم</th>
                        <th>الصورة</th>
                        <th>السعر</th>
                        <th>السعر بعد الخصم</th>
                        <th>الكمية</th>
                        <th>الحالة</th>
                        <th>الخيارات</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                @if ($product->image)
                                    <img src="{{ asset('Files/images/products/' . $product->image) }}"
                                        style="width: 50px; height:50px;">
                                @else
                                    ----
                                @endif
                            </td>
                            <td>{{ $product->main_price }}</td>
                            <td>{{ $product->discount_price != null ? $product->discount_price : '----' }}</td>
                            <td>{{ $product->store_quantity }}</td>
                            <td>{{ $product->status() }}</td>
                            <td>
                                <div>

                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info btn-sm"
                                        role="button" aria-pressed="true" title="تعديل">
                                        <i class="fa fa-edit"></i></a>


                                    <a onclick="fireDeleteEvent({{ $product->id }})" type="button" title="Delete"
                                        data-toggle="tooltip" class="btn btn-danger btn-sm text-white"><i
                                            class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        id="form-{{ $product->id }}">
                                        @csrf
                                        @method('Delete')
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
