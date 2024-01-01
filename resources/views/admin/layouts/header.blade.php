<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                    <i class="ti ti-search ti-md me-2"></i>
                    <span class="d-none d-md-inline-block text-muted">البحث</span>
                </a>
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- Style Switcher -->
            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="ti ti-md"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                            <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                            <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- / Style Switcher-->



            <!-- Notification -->

            <?php
            $data = auth()->user()->notifications;
            $count = auth()
                ->user()
                ->unreadNotifications->count();
            ?>
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class="ti ti-bell ti-md"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">{{ $count }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h5 class="text-body mb-0 me-auto">الاشعارات</h5>
                            <a href="javascript:void(0)" class="dropdown-notifications-all text-body pe-none"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i
                                    class="ti ti-mail-opened fs-4"></i></a>
                        </div>
                    </li>

                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            @forelse ($data as $d)
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="ti ti-mail-opened fs-4"></i>
                                            {{-- <div class="avatar">
                                        <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                    </div> --}}
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $d->data['username'] ?? '' }}</h6>
                                            <p class="mb-0">{{ $d->data['body'] ?? '' }}</p>
                                            <small class="text-muted">{{ $d->created_at->diffForHumans() }}</small>
                                        </div>
                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                            @if ($d->read_at)
                                            @else
                                                <a href="{{ route('admin.notifications.markAsRead', $d->id) }}"
                                                    class="dropdown-notifications-read"><span
                                                        class="badge badge-dot"></span></a>
                                            @endif

                                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                    class="ti ti-x"></span></a>
                                        </div>
                                    </div>
                                </li>
                            @empty
                            @endforelse

                        </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top">
                        <a href="{{ route('admin.notifications.index') }}"
                            class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                            كل الاشعارات
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if (auth()->user()->image != null)
                            <img src="{{ asset('Files/images/users/' . auth()->user()->image) }}" alt
                                class="h-auto rounded-circle" />
                        @else
                            <img src="{{ asset('Files/images/users/avatar.jpg') }}" alt class="h-auto rounded-circle" />
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        @if (auth()->user()->image != null)
                                            <img src="{{ asset('Files/images/users/' . auth()->user()->image) }}" alt
                                                class="h-auto rounded-circle" />
                                        @else
                                            <img src="{{ asset('Files/images/users/avatar.jpg') }}" alt
                                                class="h-auto rounded-circle" />
                                        @endif
                                    </div>
                                </div>
                                {{ auth()->user()->full_name }}
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.users.show', auth()->user()->id) }}">
                            <i class="ti ti-user-check me-2 ti-sm"></i>
                            <span class="align-middle">حسابى</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                            <i class="ti ti-settings me-2 ti-sm"></i>
                            <span class="align-middle">الاعدادات</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href=""
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"\>
                            <i class="ti ti-logout me-2 ti-sm"></i>
                            <span class="align-middle">تسجيل خروج</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
            aria-label="Search..." />
        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
    </div>
</nav>

<!-- / Navbar -->
