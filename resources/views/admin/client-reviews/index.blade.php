@extends('admin.layouts.master')
@section('title')
    تعليقات العملاء
@endsection
@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/
            </span>
        </a>
        تعليقات العملاء
    </h4>
    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>رقم الطلب</th>
                        <th>التقييم</th>
                        <th>التعليق</th>
                        <th>الخيارات</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $review->user->full_name }}</td>
                            <td>#{{ $review->order->order_number }}</td>
                            <td>
                                <ul class="list-inline mb-2">
                                    @if ($review->rate != '')
                                        @for ($i = 0; $i < 5; $i++)
                                            <li class="list-inline-item m-0"><i class="{{ round($review->rate) <= $i ? 'far' : 'fas' }} fa-star fa-sm text-warning"></i></li>
                                        @endfor
                                    @else
                                        <li class="list-inline-item m-0"><i class="far fa-star fa-sm text-warning"></i></li>
                                        <li class="list-inline-item m-0"><i class="far fa-star fa-sm text-warning"></i></li>
                                        <li class="list-inline-item m-0"><i class="far fa-star fa-sm text-warning"></i></li>
                                        <li class="list-inline-item m-0"><i class="far fa-star fa-sm text-warning"></i></li>
                                        <li class="list-inline-item m-0"><i class="far fa-star fa-sm text-warning"></i></li>
                                    @endif
                                </ul>
                              </td>
                            <td>{{\Illuminate\Support\Str::limit($review->comment,30) }}</td>
                            <td>
                                <div class="m-2">

                                    <a type="button" data-bs-toggle="modal" data-bs-target="#message{{ $review->id }}"
                                        title="عرض الرسالة" class="btn btn-primary btn-sm text-white"><i
                                            class="far fa-eye"></i></a>

                                    <a onclick="fireDeleteEvent({{ $review->id }})" type="button" title="حذف"
                                        data-toggle="tooltip" class="btn btn-danger btn-sm text-white"><i
                                            class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.client-reviews.destroy', $review->id) }}" method="POST"
                                        id="form-{{ $review->id }}">
                                        @csrf
                                        @method('Delete')
                                    </form>


                                </div>
                            </td>

                        </tr>
                          <!-- Modal -->
                        <div class="modal fade" id="message{{ $review->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">عرض الرسالة</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                {{ $review->comment }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
