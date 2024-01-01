@extends('admin.layouts.master')
@section('title')
   اوقات التوصيل
@endsection
@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/
            </span>
        </a>
       اوقات التوصيل
    </h4>
    <a class="btn btn-primary mb-2" href="{{ route('admin.delivery-time.create') }}">اضافة وقت جديد</a>

    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> من</th>
                        <th>الى</th>
                        <th>الخيارات</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($times as $time)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $time->from }}</td>
                           
                            <td>{{ $time->to }}</td>
                            <td>
                                <div class="m-2">

                                    <a href="{{ route('admin.delivery-time.edit', $time->id) }}" class="btn btn-info btn-sm"
                                        role="button" aria-pressed="true" title="تعديل">
                                        <i class="fa fa-edit"></i></a>


                                    <a onclick="fireDeleteEvent({{ $time->id }})" type="button" title="حذف"
                                        data-toggle="tooltip" class="btn btn-danger btn-sm text-white"><i
                                            class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.delivery-time.destroy', $time->id) }}" method="POST"
                                        id="form-{{ $time->id }}">
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
