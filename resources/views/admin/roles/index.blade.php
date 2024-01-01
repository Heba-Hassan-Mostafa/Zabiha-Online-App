@extends('admin.layouts.master')
@section('title')
      الصلاحيات
@endsection
@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/
            </span>
        </a>
     الصلاحيات
    </h4>
    <a class="btn btn-primary mb-2" href="{{ route('admin.roles.create') }}">اضافة صلاحية جديد</a>

    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم </th>
                        <th>الخيارات</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <div class="m-2">

                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-info btn-sm"
                                        role="button" aria-pressed="true" title="تعديل">
                                        <i class="fa fa-edit"></i></a>


                                    <a onclick="fireDeleteEvent({{ $role->id }})" type="button" title="حذف"
                                        data-toggle="tooltip" class="btn btn-danger btn-sm text-white"><i
                                            class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                        id="form-{{ $role->id }}">
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
