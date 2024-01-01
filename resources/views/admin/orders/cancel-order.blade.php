@extends('admin.layouts.master')
@section('title')
    قائمة الطلبات الملغية
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-2"><span class="text-muted fw-light">الرئيسية /</span> قائمة الطلبات الملغية</h4>

        <div class="card">
            <div class="table-responsive p-2">
                <table class="myDatatable table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> رقم الطلب</th>
                            <th>العميل</th>
                            <th> سبب الغاء الطلب </th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>#{{ $order->order->order_number }}</td>
                                <td>{{ $order->user->full_name }}</td>
                                <td>{{  $order->reason  }}</td>
                                <td>{{ $order->created_at->format('Y-m-d h:i a') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
