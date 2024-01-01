@extends('admin.layouts.master')
@section('title')
     تفاصيل الطلب
@endsection
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-2"><span class="text-muted fw-light">الرئيسية /</span> تفاصيل الطلب </h4>

      <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
        <div class="d-flex flex-column justify-content-center gap-2 gap-sm-0">
          <h5 class="mb-1 mt-3 d-flex flex-wrap gap-2 align-items-end">
            رقم الطلب # {{ $order->order_number }}
          </h5>
          <span class="d-block mt-2 mb-2">{!! $order->statusWithLabel() !!}</span>
          <p class="text-body"> {{ $order->created_at->format('Y-m-d') }}, <span id="orderYear"></span> {{ $order->created_at->format('h:i a') }}</p>
        </div>

        @if($order->order_status != 4)
        <div class="ml-auto" style="width:45%">
        <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-row align-items-center">
                    <div class="d-flex justify-content-center">
                        <div class="input-group-prepend" style="width: 20%">
                            <div class="input-group-text btn btn-danger pe-none"> تغيير الطلب</div>
                        </div>
                        <select class="form-control" name="order_status" style="outline-style: none;width:50%" onchange="this.form.submit()">
                            <option value=""> اختار العملية  </option>
                            @foreach($order_status_array as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
        @endif




        <div class="d-flex align-content-center flex-wrap gap-2">
          <a onclick="fireDeleteEvent({{ $order->id }})" type="button" title="حذف"
            data-toggle="tooltip" class="btn btn-label-danger delete-order">حذف الطلب</a>
        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
            id="form-{{ $order->id }}">
            @csrf
            @method('Delete')
        </form>
        </div>
      </div>

      <!-- Order Details Table -->

      <div class="row">
        <div class="col-12 col-lg-8">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="card-title m-0">تفاصيل الطلب</h5>
              {{-- <h6 class="m-0"><a href=" javascript:void(0)">Edit</a></h6> --}}
            </div>
            <div class="table-responsive p-2">
                  <table class="table table-bordered fw-bold">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>المنتجات</th>
                    <th>السعر</th>
                    <th>الكمية</th>
                    <th>الخيارات</th>
                    {{-- <th>الاجمالى</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach ($order->products as $product)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $product->name }}</td>
                          <td class="text-center">{{ $product->pivot->price }}</td>
                          <td class="text-center">{{ $product->pivot->quantity }}</td>
                          <?php
                          $options = App\Models\OptionValue::whereIn('id',json_decode($product->pivot->options,true))->get();

                        ?>
                        <td>

                            <ul class="list-unstyled p-0">
                                @foreach ($options as $option)
                              <li class="mb-1 d-flex fw-bold">{{ $option->value }} <span class="ms-auto "> <span style="color:red">السعر:</span> {{ $option->price }}</span></li>
                               <hr>
                              @endforeach
                            </ul>
                                <span class="d-block text-center"><span style="color:red">المجموع:</span>  {{ $options->sum('price') }}</span>
                            </td>
                      </tr>
                  @endforeach
              </tbody>
              </table>
              <?php

              $cityId = $order->location->city_id;

              $city = App\Models\City::where('id',$cityId,function($q){

              $q->where('shipping_cost','!=',null)
              ->orWhere('shipping_cost','!=',0);

              })->first();
        ?>
              <div class="d-flex justify-content-end align-items-center m-3 mb-2 p-1 fw-bold">
                <div class="order-calculations">
                  <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100 text-heading">التكلفة : </span>
                    <h6 class="mb-0">{{ $order->subtotal }}</h6>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100 text-heading">الخضم: </span>
                    <h6 class="mb-0">{{  $order->subtotal -  ($order->total - $city->shipping_cost) }}</h6>
                  </div>

                  <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100 text-heading"> تكلفة التوصيل:</span>
                    <h6 class="mb-0">{{ $city->shipping_cost }}</h6>
                  </div>
                  <div class="d-flex justify-content-between ">
                    <h6 class="w-px-100 mb-0 fw-bold">الاجمالى:</h6>
                    <h6 class="mb-0">{{ $order->total }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-header">
              <h5 class="card-title m-0">نشاط الشحن</h5>
            </div>
            <div class="card-body">
               
                
           
              <ul class="timeline pb-0 mb-0">
                @if ($order->order_status >= 0 )
                <li class="timeline-item timeline-item-transparent border-primary">
                  <span class="timeline-point timeline-point-primary"></span>
                  <div class="timeline-event">
                    <div class="timeline-header">
                      <h6 class="mb-0">تم تقديم الطلب (رقم الطلب: #{{ $order->order_number }})</h6>
                      <span class="text-muted">{{ $order->created_at->format('Y-m-d h:i a') }}</span>
                    </div>
                    <p class="mt-2 btn btn-primary pe-none"> قيد الانتظار </p>
                    
                  </div>
                </li>
                @endif
                @if ($order->order_status >= 1)
                <li class="timeline-item timeline-item-transparent border-primary">
                  <span class="timeline-point timeline-point-primary"></span>
                  <div class="timeline-event">
                    <div class="timeline-header">
                      <h6 class="mb-0"></h6>
                      <span class="text-muted">{{ $order->updated_at->format('Y-m-d h:i a') }}</span>
                    </div>
                    <p class="mt-2 btn btn-warning pe-none">تحت التنفيذ</p>
                  </div>
                </li>
                @endif
                @if ($order->order_status >= 2)
                <li class="timeline-item timeline-item-transparent border-primary">
                  <span class="timeline-point timeline-point-primary"></span>
                  <div class="timeline-event">
                    <div class="timeline-header">
                      <h6 class="mb-0"></h6>
                      <span class="text-muted">{{ $order->updated_at->format('Y-m-d h:i a') }}</span>
                    </div>
                    <p class="mt-2 btn btn-info pe-none">فى الطريق</p>
                  </div>
                </li>
                @endif
                @if ($order->order_status >= 3)
                <li class="timeline-item timeline-item-transparent border-primary">
                  <span class="timeline-point timeline-point-primary"></span>
                  <div class="timeline-event">
                    <div class="timeline-header">
                      <h6 class="mb-0"></h6>
                      <span class="text-muted">{{ $order->updated_at->format('Y-m-d h:i a') }}</span>
                    </div>
                    <p class="mt-2 btn btn-success pe-none">منتهى</p>
                   </div>
                </li>
                @endif
                @if ($order->order_status == 4)
                <li class="timeline-item timeline-item-transparent border-primary">
                  <span class="timeline-point timeline-point-primary"></span>
                  <div class="timeline-event">
                    <div class="timeline-header">
                      <h6 class="mb-0"></h6>
                      <span class="text-muted">{{ $order->updated_at->format('Y-m-d h:i a') }}</span>
                    </div>
                    <p class="mt-2 btn btn-success pe-none">مكتمل الدفع</p>
                   </div>
                </li>
                @endif
               
                </li>
              </ul>
              @endif
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-4">
          <div class="card mb-4">
            <div class="card-header">
              <h6 class="card-title m-0">بيانات العميل</h6>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-start align-items-center mb-4">
                <div class="avatar me-2">
                  <img src="{{ $order->user->image != null ? asset('Files/images/users/'.$order->user->image) : asset('Files/images/users/avatar.jpg') }}" alt="Avatar" class="rounded-circle" />
                </div>
                <div class="d-flex flex-column">
                  <a href="app-user-view-account.html" class="text-body text-nowrap">
                    <h6 class="mb-0">{{ $order->user->full_name }}</h6>
                  </a>
                  <small class="text-muted">العميل ID: #{{ $order->user->id }}</small>
                </div>
              </div>
              <div class="d-flex justify-content-start align-items-center mb-4">
                <span
                  class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"
                  ><i class="ti ti-shopping-cart ti-sm"></i
                ></span>
                <?php
                $user = App\Models\User::where('id',$order->user_id)->first();
                ?>
                <h6 class="text-body text-nowrap mb-0">{{ $user->orders->count() }}</h6>
              </div>
              <div class="d-flex justify-content-between">
                <h6>بيانات التواصل</h6>
                {{-- <h6>
                  <a href=" javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editUser">Edit</a>
                </h6> --}}
              </div>
              <p class="mb-1">البريد الالكترونى: {{ $order->user->email }}</p>
              <p class="mb-0">الهاتف: {{ $order->user->phone }}</p>
            </div>
          </div>

          @if ($order->delivery_type == 'shipping')
            <div class="card mb-4">
                  <div class="card-header d-flex justify-content-between">
                  <h6 class="card-title m-0">عنوان الشحن</h6>
                  {{-- <h6 class="m-0">
                  <a href=" javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addNewAddress">Edit</a>
                  </h6> --}}
                  </div>
                  <div class="card-body">
                  <p class="mb-0">{{ $order->location->address }}</p>
                  </div>
            </div>
          @endif

          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
              <h6 class="card-title m-0">Billing address</h6>
              <h6 class="m-0">
                <a href=" javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addNewAddress">Edit</a>
              </h6>
            </div>
            <div class="card-body">
              <p class="mb-4">45 Roker Terrace <br />Latheronwheel <br />KW5 8NW,London <br />UK</p>
              <h6 class="mb-0 pb-2">Mastercard</h6>
              <p class="mb-0">Card Number: ******4291</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
@endsection
