@extends('admin.layouts.master')
@section('title')
    تواصل معنا
@endsection
@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/
            </span>
        </a>
        تواصل معنا
    </h4>
    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم</th>
                        <th>الهاتف</th>
                        <th>الرسالة</th>
                        <th>الخيارات</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($contact->message, 30) }}</td>
                            <td>
                                <div class="m-2">
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#message{{ $contact->id }}"
                                        title="عرض الرسالة" class="btn btn-primary btn-sm text-white"><i
                                            class="far fa-eye"></i></a>


                                    <a onclick="fireDeleteEvent({{ $contact->id }})" type="button" title="حذف"
                                        data-toggle="tooltip" class="btn btn-danger btn-sm text-white"><i
                                            class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.contact-us.destroy', $contact->id) }}" method="POST"
                                        id="form-{{ $contact->id }}">
                                        @csrf
                                        @method('Delete')
                                    </form>


                                </div>
                            </td>

                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="message{{ $contact->id }}" tabindex="-1"
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
                                                {{ $contact->message }}
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
