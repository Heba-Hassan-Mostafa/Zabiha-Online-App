@extends('admin.layouts.master')
@section('title')
    العملاء
@endsection
@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/
            </span>
        </a>
        العملاء
    </h4>
    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الالكترونى</th>
                        <th>الهاتف</th>
                        <th>المدينة</th>
                        <th>الخيارات</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $client->full_name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->city != null ? $client->city->name_ar : '----' }}</td>
                            <td>
                                <div class="m-2">

                                    <a onclick="fireDeleteEvent({{ $client->id }})" type="button" title="حذف"
                                        data-toggle="tooltip" class="btn btn-danger btn-sm text-white"><i
                                            class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST"
                                        id="form-{{ $client->id }}">
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
