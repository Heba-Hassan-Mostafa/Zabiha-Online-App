<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('admin.dashboard')}}" class="app-brand-link m-auto">
      <span class="app-brand-logo demo" style="height: 70px ; width : 70px">
        <?php
        $logo = \App\Models\Setting::where('key','logo')->first()->value;
        ?>
        <img src="{{asset('Files/images/settings/'.$logo)}}" alt="logo"
             class="img-fluid" style="    border-radius: 30px;
             height: 55px;
             width: 55px;"/>
      </span>
            <span
                class="app-brand-text demo menu-text fw-bold"></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{(url()->current() == route('admin.dashboard'))?'active':''}}">
            <a href="{{route('admin.dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-home"></i>
                <div>الرئيسية</div>
            </a>
        </li>
        <!-- Products -->
        <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-building-factory-2"></i>
                <div>المنتجات</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{(url()->current() == route('admin.categories.index'))?'active':''}}">
                    <a href="{{ route('admin.categories.index') }}"
                       class="menu-link">
                        <div>اقسام المنتجات</div>
                    </a>
                </li>
                <li class="menu-item {{(url()->current() == route('admin.options.index'))?'active':''}}">
                    <a href="{{ route('admin.options.index') }}"
                       class="menu-link">
                        <div>الخيارات</div>
                    </a>
                </li>
                <li class="menu-item {{(url()->current() == route('admin.products.index'))?'active':''}}">
                    <a href="{{ route('admin.products.index') }}"
                       class="menu-link">
                        <div>المنتجات</div>
                    </a>
                </li>

            </ul>
        </li>

         <!-- coupon -->
         <li class="menu-item {{(url()->current() == route('admin.coupons.index'))?'active':''}}">
            <a href="{{route('admin.coupons.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-file-dollar"></i>
                <div>كوبونات الخصم  </div>
            </a>
        </li>

           <!-- delivery-time-->
           <li class="menu-item {{(url()->current() == route('admin.delivery-time.index'))?'active':''}}">
            <a href="{{route('admin.delivery-time.index')}}" class="menu-link">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-2 me-2" width="22" height="22" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 4m0 1a1 1 0 0 1 1 -1h14a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-14a1 1 0 0 1 -1 -1z"></path>
                    <path d="M12 7v5l3 3"></path>
                    <path d="M4 12h1"></path>
                    <path d="M19 12h1"></path>
                    <path d="M12 19v1"></path>
                 </svg>
                <div> اوقات التوصيل</div>
            </a>
        </li>

        <!-- slider -->
        <li class="menu-item {{(url()->current() == route('admin.slider.index'))?'active':''}}">
            <a href="{{route('admin.slider.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-photo"></i>
                <div>صور slider</div>
            </a>
        </li>

          <!-- orders -->
          <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-truck"></i>
                <div>الطلبات</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{route('admin.orders.index',['type'=>\App\Models\Order::PENDING])}}">
                    <a href="{{route('admin.orders.index',['type'=>\App\Models\Order::PENDING])}}"
                       class="menu-link">
                        <div>الطلبات الجديدة</div>
                    </a>
                </li>
                <li class="menu-item {{route('admin.orders.index',['type'=>\App\Models\Order::IN_PROCESS])}}">
                    <a href="{{route('admin.orders.index',['type'=>\App\Models\Order::IN_PROCESS])}}"
                       class="menu-link">
                        <div> تحت التنفيذ</div>
                    </a>
                </li>
                <li class="menu-item {{route('admin.orders.index',['type'=>\App\Models\Order::UNDER_WAY])}}">
                    <a href="{{route('admin.orders.index',['type'=>\App\Models\Order::UNDER_WAY])}}"
                       class="menu-link">
                        <div>فى الطريق</div>
                    </a>
                </li>
                <li class="menu-item {{route('admin.orders.index',['type'=>\App\Models\Order::COMPLETED])}}">
                    <a href="{{route('admin.orders.index',['type'=>\App\Models\Order::COMPLETED])}}"
                       class="menu-link">
                        <div>المكتملة</div>
                    </a>
                </li>
                <li class="menu-item {{route('admin.orders.index',['type'=>\App\Models\Order::PAYMENT_COMPLETED])}}">
                    <a href="{{route('admin.orders.index',['type'=>\App\Models\Order::PAYMENT_COMPLETED])}}"
                       class="menu-link">
                        <div>مكتملة الدفع</div>
                    </a>
                </li>
                <li class="menu-item {{route('admin.orders.cancel-order')}}">
                    <a href="{{route('admin.orders.cancel-order')}}"
                       class="menu-link">
                        <div>ملغية من العميل</div>
                    </a>
                </li>

            </ul>
        </li>

         <!-- users -->
         <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div style="font-size: 14px">الصلاحيات والمستخدمين</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{(url()->current() == route('admin.roles.index'))?'active':''}}">
                    <a href="{{ route('admin.roles.index') }}"
                       class="menu-link">
                        <div>الصلاحيات</div>
                    </a>
                </li>
            </ul>

            <ul class="menu-sub">
                <li class="menu-item {{(url()->current() == route('admin.users.index'))?'active':''}}">
                    <a href="{{ route('admin.users.index') }}"
                       class="menu-link">
                        <div>المستخدمين</div>
                    </a>
                </li>
            </ul>
        </li>


           <!-- contact-us-->
           <li class="menu-item {{(url()->current() == route('admin.contact-us.index'))?'active':''}}">
            <a href="{{route('admin.contact-us.index')}}" class="menu-link">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-pause me-2" width="22" height="22" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                    <path d="M20 3l0 4"></path>
                    <path d="M16 3l0 4"></path>
                 </svg>
                <div>تواصل معنا</div>
            </a>
        </li>
        
         <!-- clients-->
         <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div style="font-size: 14px"> العملاء</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{(url()->current() == route('admin.clients.index'))?'active':''}}">
                    <a href="{{ route('admin.clients.index') }}"
                       class="menu-link">
                        <div>العملاء</div>
                    </a>
                </li>
            </ul>

            <ul class="menu-sub">
                <li class="menu-item {{(url()->current() == route('admin.client-reviews.index'))?'active':''}}">
                    <a href="{{ route('admin.client-reviews.index') }}"
                       class="menu-link">
                        <div>تعليقات العملاء</div>
                    </a>
                </li>
            </ul>
        </li>
         <!-- slider -->
         <li class="menu-item {{(url()->current() == route('admin.notifications.index'))?'active':''}}">
            <a href="{{route('admin.notifications.index')}}" class="menu-link">
                <i class="ti ti-bell ti-md"></i>
                <div>الاشعارات</div>
            </a>
        </li>
           <!-- settings-->
           <li class="menu-item {{(url()->current() == route('admin.settings.index'))?'active':''}}">
            <a href="{{route('admin.settings.index')}}" class="menu-link">
                <i class="ti ti-settings me-2 ti-sm"></i>
                <div>الاعدادات</div>
            </a>
        </li>
    </ul>

</aside>
<!-- / Menu -->
