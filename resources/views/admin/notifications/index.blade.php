@extends('admin.layouts.master')
@section('title')
    الاشعارات
@endsection
@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/
            </span>
        </a>
        الاشعارات
    </h4>
    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المستخدم</th>
                        <th>النوع</th>
                        <th>العنوان</th>
                        <th> الوصف</th>
                        <th>الحالة</th>
                        <th>الخيارات</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->data['username'] ?? '' }}</td>
                            <td>{{ $d->data['type'] }}</td>
                            <td>{{ $d->data['title'] ?? '' }}</td>
                            <td>{{ $d->data['body'] ?? '' }}</td>
                            <td>
                                 @if ($d->read_at)
                                    <span class="btn btn-success btn-sm pe-none">
                                        <i class="far fa-check-circle"></i> تم قراءتها </span>
                                        @else
                                        <span class="btn btn-danger btn-sm pe-none">
                                            <i class="far fa-times-circle"></i>لم يتم قراءتها </span>
                                @endif
                            </td>
                            <td>
                                <div class="m-2">

                                    @if ($d->read_at)
                                        <span class="btn btn-success btn-sm pe-none">
                                            <i class="far fa-check-circle"></i></span>
                                    @else
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('admin.notifications.markAsRead', $d->id) }}">
                                            <i class="fa fa-book-open"></i>
                                        </a>
                                    @endif
                                    <a onclick="fireDeleteEvent('{{ $d->id }}')" type="button" title="حذف"
                                        data-toggle="tooltip" class="btn btn-danger btn-sm text-white"><i
                                            class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.notifications.destroy', $d->id) }}" method="POST"
                                        id="form-{{ $d->id }}">
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
