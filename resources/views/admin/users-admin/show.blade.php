@extends('admin.layouts.master')
@section('title')
    حسابى
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">الرئيسية/</span>
        </a>
        <a href="{{ route('admin.categories.index') }}">
            <span class="text-muted fw-light">حسابى</span>
        </a>
    </h4>
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image"
                            class="rounded-top" />
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            @if (auth()->user()->image != null)
                                <img src="{{ asset('Files/images/users/' . auth()->user()->image) }}" alt="user image"
                                    class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                            @else
                                <img src="{{ asset('Files/images/users/avatar.jpg') }}" alt="user image"
                                    class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                            @endif
                        </div>
                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div
                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4>{{ auth()->user()->full_name }}</h4>
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item d-flex gap-1">
                                            <i class="ti ti-color-swatch"></i>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $v)
                                                    {{ $v }}
                                                @endforeach
                                            @endif
                                        </li>
                                        <li class="list-inline-item d-flex gap-1">
                                            <i class="ti ti-calendar"></i> Joined
                                            {{ auth()->user()->created_at->format('Y-m-d') }}
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ route('admin.users.edit', auth()->user()->id) }}" class="btn btn-primary">
                                    <i class="ti ti-check me-1"></i>تعديل
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->

        <!-- Navbar pills -->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-user-check me-1"></i>
                            حسابى</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--/ Navbar pills -->

        <!-- User Profile Content -->
        <div class="row">
            <div class="col-xl-8 col-lg-7 col-md-7">
                <!-- About User -->
                <div class="card mb-4">
                    <div class="card-body">
                        <small class="card-text text-uppercase">عن</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">
                                    الاسم بالكامل:</span> <span>{{ auth()->user()->full_name }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-check text-heading"></i><span class="fw-medium mx-2 text-heading">البريد
                                    الالكترونى:</span> <span>{{ auth()->user()->email }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-crown text-heading"></i><span
                                    class="fw-medium mx-2 text-heading">الهاتف:</span>
                                <span>{{ auth()->user()->phone }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-flag text-heading"></i><span
                                    class="fw-medium mx-2 text-heading">الصلاحية:</span> <span>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                            <label class="btn btn-success">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/ About User -->

            </div>
        </div>
        <!--/ User Profile Content -->
    </div>
    <!-- / Content -->
@endsection
