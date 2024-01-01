@extends('admin.layouts.master')
@section('title')
  صور slider
@endsection
@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/
            </span>
        </a>
        صور slider
    </h4>
    <a class="btn btn-primary mb-2" href="{{ route('admin.slider.create') }}">اضافة صورة جديد</a>

    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الصورة</th>
                        <th>المنتج</th>
                        <th>الحالة</th>
                        <th>الخيارات</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($slider->file_name)
                                    <img src="{{ asset('Files/images/slider/' . $slider->file_name) }}"
                                        style="width: 100px; height:100px; margin:0.5rem">
                                @else
                                    ----
                                @endif
                            </td>
                            <td>{{ $slider->product->name }}</td>
                            <td>{{ $slider->status() }}</td>
                            <td>
                                <div>

                                    <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-info btn-sm"
                                        role="button" aria-pressed="true" title="تعديل">
                                        <i class="fa fa-edit"></i></a>


                                    <a onclick="fireDeleteEvent({{ $slider->id }})" type="button" title="Delete"
                                        data-toggle="tooltip" class="btn btn-danger btn-sm text-white"><i
                                            class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST"
                                        id="form-{{ $slider->id }}">
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
