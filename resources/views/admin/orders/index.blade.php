@extends('admin.layouts.master')
@section('title')
    قائمة الطلبات
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-2"><span class="text-muted fw-light">الرئيسية /</span> قائمة الطلبات</h4>

        <!-- Order List Widget -->

        <div class="card mb-4">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                <div>
                                    <h4 class="mb-2">{{ App\Models\Order::where('order_status',App\Models\Order::PENDING)->count() }}</h4>
                                    <p class="mb-0 fw-medium">الطلبات الجديدة</p>
                                </div>
                                <span class="avatar me-sm-4">
                                    <span class="avatar-initial bg-label-secondary rounded">
                                        <i class="ti-md ti ti-calendar-stats text-body"></i>
                                    </span>
                                </span>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-4" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                <div>
                                    <h4 class="mb-2">{{ App\Models\Order::where('order_status',App\Models\Order::PAYMENT_COMPLETED)->count() }}</h4>
                                    <p class="mb-0 fw-medium">مكتملة الدفع</p>
                                </div>
                                <span class="avatar p-2 me-lg-4">
                                    <span class="avatar-initial bg-label-secondary rounded"><i
                                            class="ti-md ti ti-checks text-body"></i></span>
                                </span>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                                <div>
                                    <h4 class="mb-2">{{ App\Models\Order::where('order_status',App\Models\Order::CANCELED)->count() }}</h4>
                                    <p class="mb-0 fw-medium">الملغية</p>
                                </div>
                                <span class="avatar p-2 me-sm-4">
                                    <span class="avatar-initial bg-label-secondary rounded"><i
                                            class="ti-md ti ti-wallet text-body"></i></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h4 class="mb-2">{{ App\Models\Order::where('order_status',App\Models\Order::REJECTED)->count() }}</h4>
                                    <p class="mb-0 fw-medium">المرفوضة</p>
                                </div>
                                <span class="avatar p-2">
                                    <span class="avatar-initial bg-label-secondary rounded"><i
                                            class="ti-md ti ti-alert-octagon text-body"></i></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order List Table -->
        <div class="card">
            <div class="table-responsive p-2">
                <table class="myDatatable table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> رقم الطلب</th>
                            <th>العميل</th>
                            <th>طريقة الدفع</th>
                            <th>الحالة</th>
                            <th>وقت الاستلام</th>
                            <th> الاجمالى</th>
                            <th>الخيارات</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->user->full_name }}</td>
                                <td></td>
                                <td>{!! $order->statusWithLabel() !!}</td>
                                <td>{{ $order->created_at->format('Y-m-d h:i a') }}</td>
                                <td>{{ $order->total }}</td>
                                <td>
                                    <div>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a onclick="fireDeleteEvent({{ $order->id }})" type="button" title="حذف"
                                            data-toggle="tooltip" class="btn btn-danger btn-sm text-white"><i
                                                class="fas fa-trash-alt"></i></a>

                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                            id="form-{{ $order->id }}">
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
    </div>
    <!-- / Content -->
@endsection
