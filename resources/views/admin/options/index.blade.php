@extends('admin.layouts.master')
@section('title')
    الخيارات
@endsection
@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/
            </span>
        </a>
        الخيارات
    </h4>
    <a class="btn btn-primary mb-2" href="{{ route('admin.options.create') }}">اضافة خيار جديد</a>

    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>النوع</th>
                        <th>العمليات</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($options as $option)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $option->name }}</td>

                            <td>{{ $option->input_type }}</td>
                            <td>
                                @if ($option->input_type != 'text')
                                    @include('admin.options.option-values')
                                @endif

                                <a href="{{ route('admin.options.edit', $option->id) }}" class="btn btn-info btn-sm"
                                    role="button" aria-pressed="true" title="تعديل">
                                    <i class="fa fa-edit"></i></a>


                                <a onclick="fireDeleteEvent({{ $option->id }})" type="button" title="حذف"
                                    data-toggle="tooltip" class="btn btn-danger btn-sm text-white"><i
                                        class="fas fa-trash-alt"></i></a>
                                <form action="{{ route('admin.options.destroy', $option->id) }}" method="POST"
                                    id="form-{{ $option->id }}">
                                    @csrf
                                    @method('Delete')
                                </form>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
