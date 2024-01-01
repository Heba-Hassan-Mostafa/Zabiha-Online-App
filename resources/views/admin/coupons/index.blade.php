@extends('admin.layouts.master')
@section('title')
     كوبونات الخصم
@endsection
@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/
            </span>
        </a>
         كوبونات الخصم
    </h4>
    <a class="btn btn-primary mb-2" href="{{ route('admin.coupons.create') }}">اضافة كوبون جديد</a>

    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الكوبون</th>
                        <th>الخصم</th>
                        <th>اقصى عدد للاستخدام</th>
                        <th>من</th>
                        <th>الى</th>
                        <th>الخيارات</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $coupon->name }}</td>
                            <td>{{ $coupon->discount }} {{  $coupon->type == 'percentage' ? '%' : ''  }} </td>
                            <td>{{ $coupon->max_users }}</td>
                            <td>{{ $coupon->valid_from->format('Y-m-d') }}</td>
                            <td>{{ $coupon->valid_to->format('Y-m-d') }}</td>
                            <td>
                                <div class="m-2">

                                    <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-info btn-sm"
                                        role="button" aria-pressed="true" title="تعديل">
                                        <i class="fa fa-edit"></i></a>


                                    <a onclick="fireDeleteEvent({{ $coupon->id }})" type="button" title="حذف"
                                        data-toggle="tooltip" class="btn btn-danger btn-sm text-white"><i
                                            class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST"
                                        id="form-{{ $coupon->id }}">
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
