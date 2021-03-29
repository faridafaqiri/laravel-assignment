
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('images/logo_faucet.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">

                        <a href="{{route('admin.')}}" class="nav-link {{isActive('admin.')}}">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>داشبورد</p>
                        </a>
                    </li>
<!--                        @can('show-settings')
                        <li class="nav-item">
                            <a href="{{route('admin.settings')}}" class="nav-link {{isActive('admin.settings')}}">
                                <i class="nav-icon fa fa-cogs"></i>
                                <p>تنظیمات سایت</p>
                            </a>
                        </li>
                    @endcan-->

                    @canany(['show-permissions','show-roles','show-users'])
                        <li class="nav-item has-treeview {{isActive(['admin.users.index','admin.users.create','admin.users.edit','admin.roles.index','admin.roles.edit','admin.roles.create','admin.permissions.index','admin.permissions.edit','admin.permissions.create'],'menu-open')}}">
                            <a href="#" class="nav-link {{isActive(['admin.users.index','admin.users.create','admin.users.edit','admin.roles.index','admin.roles.edit','admin.roles.create','admin.permissions.index','admin.permissions.edit','admin.permissions.create'])}}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    کاربران
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('show-users')
                                <li class="nav-item">
                                    <a href="{{route('admin.users.index')}}" class="nav-link {{isActive('admin.users.index')}}">
                                        <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                        <p>کاربران</p>
                                    </a>
                                </li>
                                @endcan

                                @can('show-roles')
                                    <li class="nav-item">
                                        <a href="{{route('admin.roles.index')}}" class="nav-link {{isActive('admin.roles.index')}}">
                                            <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                            <p> مقام ها</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('show-permissions')
                                    <li class="nav-item">
                                        <a href="{{route('admin.permissions.index')}}" class="nav-link {{isActive('admin.permissions.index')}}">
                                            <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                            <p> دسترسی ها</p>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endcanany

                    @canany(['show-zones','provinces','provincial-zones','leakages','show-incomes','show-planning-incomes','show-web-lengths','show-develop-web-lengths','show-change-web-lengths','show-wall-chambers','show-wall-controllings'])
                    <li class="nav-item has-treeview {{isActive(['admin.zones.index','admin.zones.create','admin.zones.edit','admin.provinces.index','admin.provinces.create','admin.provinces.edit','admin.provincial-zones.index','admin.provincial-zones.create','admin.provincial-zones.edit','admin.leakages.index','admin.leakages.edit','admin.leakages.create','admin.change_web_lengths.index','admin.change_web_lengths.edit','admin.change_web_lengths.create','admin.develop_web_lengths.index','admin.develop_web_lengths.edit','admin.develop_web_lengths.create','admin.planning_incomes.index','admin.planning_incomes.create','admin.planning_incomes.edit','admin.incomes.index','admin.incomes.edit','admin.incomes.create','admin.web_lengths.index','admin.web_lengths.create','admin.web_lengths.edit','admin.wall_chambers.index','admin.wall_chambers.create','admin.wall_chambers.edit','admin.wall_controllings.index','admin.wall_controllings.edit','admin.wall_controllings.create'],'menu-open')}}">
                        <a href="#" class="nav-link {{isActive(['admin.zones.index','admin.zones.create','admin.zones.edit','admin.provinces.index','admin.provinces.create','admin.provinces.edit','admin.provincial-zones.index','admin.provincial-zones.create','admin.provincial-zones.edit','admin.leakages.index','admin.leakages.edit','admin.leakages.create','admin.change_web_lengths.index','admin.change_web_lengths.edit','admin.change_web_lengths.create','admin.develop_web_lengths.index','admin.develop_web_lengths.edit','admin.develop_web_lengths.create','admin.planning_incomes.index','admin.planning_incomes.create','admin.planning_incomes.edit','admin.incomes.index','admin.incomes.edit','admin.incomes.create','admin.web_lengths.index','admin.web_lengths.create','admin.web_lengths.edit','admin.wall_chambers.index','admin.wall_chambers.create','admin.wall_chambers.edit','admin.wall_controllings.index','admin.wall_controllings.edit','admin.wall_controllings.create'])}}">
                            <i class="nav-icon fa fa-circle-o text-primary"></i>
                            <p>
                                زون ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('show-zones')
                            <li class="nav-item">
                                <a href="{{route('admin.zones.index')}}" class="nav-link {{isActive('admin.zones.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> زون ها</p>
                                </a>
                            </li>
                            @endcan
                            @can('show-provinces')
                            <li class="nav-item">
                                <a href="{{route('admin.provinces.index')}}" class="nav-link {{isActive('admin.provinces.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p>ولایات</p>
                                </a>
                            </li>
                            @endcan
                            @can('show-provincial-zones')
                            <li class="nav-item">
                                <a href="{{route('admin.provincial-zones.index')}}" class="nav-link {{isActive('admin.provincial-zones.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> زون های ولایتی</p>
                                </a>
                            </li>
                            @endcan
                            @can('show-leakages')
                            <li class="nav-item">
                                <a href="{{route('admin.leakages.index')}}" class="nav-link {{isActive('admin.leakages.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> نل های لیک شده</p>
                                </a>
                            </li>
                            @endcan
                            @can('show-incomes')
                                    <li class="nav-item">
                                        <a href="{{route('admin.incomes.index')}}" class="nav-link {{isActive('admin.incomes.index')}}">
                                            <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                            <p>عواید</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('show-planning-incomes')
                                    <li class="nav-item">
                                        <a href="{{route('admin.planning_incomes.index')}}" class="nav-link {{isActive('admin.planning_incomes.index')}}">
                                            <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                            <p>عواید پلان  شده</p>
                                        </a>
                                    </li>
                                @endcan
                            @can('show-web-lengths')
                                    <li class="nav-item">
                                        <a href="{{route('admin.web_lengths.index')}}" class="nav-link {{isActive('admin.web_lengths.index')}}">
                                            <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                            <p>طول شبکه</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('show-develop-web-lengths')
                                    <li class="nav-item">
                                        <a href="{{route('admin.develop_web_lengths.index')}}" class="nav-link {{isActive('admin.develop_web_lengths.index')}}">
                                            <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                            <p>توسعه طول شبکه</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('show-change-web-lengths')
                                    <li class="nav-item">
                                        <a href="{{route('admin.change_web_lengths.index')}}" class="nav-link {{isActive('admin.change_web_lengths.index')}}">
                                            <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                            <p>تعویض طول شبکه</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('show-wall-chambers')
                                    <li class="nav-item">
                                        <a href="{{route('admin.wall_chambers.index')}}" class="nav-link {{isActive('admin.wall_chambers.index')}}">
                                            <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                            <p>وال چمبر</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('show-wall-controllings')
                                    <li class="nav-item">
                                        <a href="{{route('admin.wall_controllings.index')}}" class="nav-link {{isActive('admin.wall_controllings.index')}}">
                                            <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                            <p>وال کنترولینگ</p>
                                        </a>
                                    </li>
                                @endcan
                        </ul>
                    </li>
                    @endcanany

                    @canany(['show-assets','show-debts'])
                    <li class="nav-item has-treeview {{isActive(['admin.assets.index','admin.assets.create','admin.assets.edit','admin.debts.index','admin.debts.edit','admin.debts.create'],'menu-open')}}">
                        <a href="#" class="nav-link {{isActive(['admin.assets.index','admin.assets.create','admin.assets.edit','admin.debts.index','admin.debts.edit','admin.debts.create'])}}">
                            <i class="nav-icon fa fa-circle-o text-primary"></i>
                            <p>
                                 دارایی و دیون
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @can('show-assets')
                            <li class="nav-item">
                                <a href="{{route('admin.assets.index')}}" class="nav-link {{isActive('admin.assets.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> دارایی ها</p>
                                </a>
                            </li>
                            @endcan
                            @can('show-debts')
                            <li class="nav-item">
                                <a href="{{route('admin.debts.index')}}" class="nav-link {{isActive('admin.debts.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p>دیون</p>
                                </a>
                            </li>
                           @endcan
                        </ul>
                    </li>
                    @endcanany

                    @canany(['show-customers','show-illegal-customers','show-signboards','show-faucet-changes','show-faucet-diameter-customers','show-covered-populations'])
                    <li class="nav-item has-treeview {{isActive(['admin.customers.index','admin.customers.create','admin.customers.edit','admin.illegal_customers.index','admin.illegal_customers.create','admin.illegal_customers.edit','admin.signboards.index','admin.signboards.edit','admin.signboards.edit','admin.faucet_changes.index','admin.faucet_changes.create','admin.faucet_changes.edit','admin.faucet_diameter_customers.index','admin.faucet_diameter_customers.create','admin.faucet_diameter_customers.edit','admin.covered_populations.index','admin.covered_populations.edit','admin.covered_populations.create'],'menu-open')}}">
                        <a href="#" class="nav-link {{isActive(['admin.customers.index','admin.customers.create','admin.customers.edit','admin.illegal_customers.index','admin.illegal_customers.create','admin.illegal_customers.edit','admin.signboards.index','admin.signboards.edit','admin.signboards.edit','admin.faucet_changes.index','admin.faucet_changes.create','admin.faucet_changes.edit','admin.faucet_diameter_customers.index','admin.faucet_diameter_customers.create','admin.faucet_diameter_customers.edit','admin.covered_populations.index','admin.covered_populations.edit','admin.covered_populations.create'])}}">
                            <i class="nav-icon fa fa-circle-o text-primary"></i>
                            <p>
                                مشترکین
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @can('show-customers')
                            <li class="nav-item">
                                <a href="{{route('admin.customers.index')}}" class="nav-link {{isActive(['admin.customers.index','admin.customers.edit','admin.customers.create'])}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p>مشترکین قانونی</p>
                                </a>
                            </li>
                            @endcan

                            @can('show-illegal-customers')
                            <li class="nav-item">
                                <a href="{{route('admin.illegal_customers.index')}}" class="nav-link {{isActive(['admin.illegal_customers.index','admin.illegal_customers.edit','admin.illegal_customers.create'])}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> مشترکین غیرقانونی</p>
                                </a>
                            </li>
                            @endcan
                            @can('show-faucet-changes')
                            <li class="nav-item">
                                <a href="{{route('admin.faucet_changes.index')}}" class="nav-link {{isActive('admin.faucet_changes.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> تبدیلی نل مشترکین</p>
                                </a>
                            </li>
                            @endcan
                             @can('show-faucet-diameter-customers')
                            <li class="nav-item">
                                <a href="{{route('admin.faucet_diameter_customers.index')}}" class="nav-link {{isActive('admin.faucet_diameter_customers.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> قطر نل مشترکین</p>
                                </a>
                            </li>
                            @endcan
                             @can('show-signboards')
                            <li class="nav-item">
                                <a href="{{route('admin.signboards.index')}}" class="nav-link {{isActive('admin.signboards.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p>تثبیت لوحه مشترکین</p>
                                </a>
                            </li>
                             @endcan
                                @can('show-covered-populations')
                                    <li class="nav-item">
                                        <a href="{{route('admin.covered_populations.index')}}" class="nav-link {{isActive('admin.covered_populations.index')}}">
                                            <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                            <p>نفوس تحت پوشش</p>
                                        </a>
                                    </li>
                                @endcan

                        </ul>
                    </li>
                    @endcanany

                    @canany(['show-sources','show-source-types','show-impaired-pumps'])
                    <li class="nav-item has-treeview {{isActive(['admin.sources.index','admin.sources.create','admin.sources.edit','admin.source_types.index','admin.source_types.create','admin.source_types.edit','admin.impaired_pumps.index','admin.impaired_pumps.edit','admin.impaired_pumps.create'],'menu-open')}}">
                        <a href="#" class="nav-link {{isActive(['admin.sources.index','admin.sources.create','admin.sources.edit','admin.source_types.index','admin.source_types.create','admin.source_types.edit','admin.impaired_pumps.index','admin.impaired_pumps.edit','admin.impaired_pumps.create'])}}">
                            <i class="nav-icon fa fa-circle-o text-primary"></i>
                            <p>
                                منابع
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                            @can('show-source-types')
                            <li class="nav-item">
                                <a href="{{route('admin.source_types.index')}}" class="nav-link {{isActive('admin.source_types.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> انواع منابع</p>
                                </a>
                            </li>
                            @endcan

                            @can('show-sources')
                            <li class="nav-item">
                                <a href="{{route('admin.sources.index')}}" class="nav-link {{isActive('admin.sources.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> منابع</p>
                                </a>
                            </li>
                             @endcan
                             @can('show-impaired-pumps')
                            <li class="nav-item">
                                <a href="{{route('admin.impaired_pumps.index')}}" class="nav-link {{isActive('admin.impaired_pumps.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> پمپ های خراب شده</p>
                                </a>
                            </li>
                             @endcan
                        </ul>
                    </li>
                    @endcanany

                    @canany(['show-meter-changes','show-meter-readers','show-meter-readings',''])
                    <li class="nav-item has-treeview {{isActive(['admin.meter_changes.index','admin.meter_changes.create','admin.meter_changes.edit','admin.meter_readers.index','admin.meter_readers.edit','admin.meter_readers.create','admin.meter_readings.index','admin.meter_readings.edit','admin.meter_readings.create'],'menu-open')}}">
                        <a href="#" class="nav-link {{isActive(['admin.meter_changes.index','admin.meter_changes.create','admin.meter_changes.edit','admin.meter_readers.index','admin.meter_readers.edit','admin.meter_readers.create','admin.meter_readings.index','admin.meter_readings.edit','admin.meter_readings.create'])}}">
                            <i class="nav-icon fa fa-circle-o text-primary"></i>
                            <p>
                                میتر
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                        @can('show-meter-changes')
                            <li class="nav-item">
                                <a href="{{route('admin.meter_changes.index')}}" class="nav-link {{isActive('admin.meter_changes.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> تبدیلی میتر ها</p>
                                </a>
                            </li>
                         @endcan
                          @can('show-meter-readers')
                            <li class="nav-item">
                                <a href="{{route('admin.meter_readers.index')}}" class="nav-link {{isActive('admin.meter_readers.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> میتر خوان ها</p>
                                </a>
                            </li>
                            @endcan
                            @can('show-meter-readings')
                            <li class="nav-item">
                                <a href="{{route('admin.meter_readings.index')}}" class="nav-link {{isActive('admin.meter_readings.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p>میتر خوانی</p>
                                </a>
                            </li>
                            @endcan

                        </ul>
                    </li>
                    @endcanany

                    @canany(['show-printed-bills','show-distributed-bills'])
                    <li class="nav-item has-treeview {{isActive(['admin.printed_bills.index','admin.printed_bills.create','admin.printed_bills.edit','admin.distributed_bills.index','admin.distributed_bills.edit','admin.distributed_bills.create'],'menu-open')}}">
                        <a href="#" class="nav-link {{isActive(['admin.printed_bills.index','admin.printed_bills.edit','admin.printed_bills.create','admin.distributed_bills.index','admin.distributed_bills.edit','admin.distributed_bills.create'])}}">
                            <i class="nav-icon fa fa-circle-o text-primary"></i>
                            <p>
                                بل ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @can('show-printed-bills')
                            <li class="nav-item">
                                <a href="{{route('admin.printed_bills.index')}}" class="nav-link {{isActive('admin.printed_bills.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> بل های چاپ شده</p>
                                </a>
                            </li>
                            @endcan
                            @can('show-distributed-bills')
                            <li class="nav-item">
                                <a href="{{route('admin.distributed_bills.index')}}" class="nav-link {{isActive('admin.distributed_bills.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p> بل های توزیع شده</p>
                                </a>
                            </li>
                                @endcan
                        </ul>
                    </li>
                    @endcanany

                    @canany(['show-water-storages','show-storage-cleans'])
                    <li class="nav-item has-treeview {{isActive(['admin.water_storages.index','admin.water_storages.create','admin.water_storages.edit','admin.storage_cleans.index','admin.storage_cleans.edit','admin.storage_cleans.create'],'menu-open')}}">
                        <a href="#" class="nav-link {{isActive(['admin.water_storages.index','admin.water_storages.create','admin.water_storages.edit','admin.storage_cleans.index','admin.storage_cleans.edit','admin.storage_cleans.create'])}}">
                            <i class="nav-icon fa fa-circle-o text-primary"></i>
                            <p>
                                ذخایر آب
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @can('show-water-storage')
                            <li class="nav-item">
                                <a href="{{route('admin.water_storages.index')}}" class="nav-link {{isActive('admin.water_storages.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p>ذخایر آب</p>
                                </a>
                            </li>
                            @endcan
                            @can('show-storage-clean')
                            <li class="nav-item">
                                <a href="{{route('admin.storage_cleans.index')}}" class="nav-link {{isActive('admin.storage_cleans.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p>پاک کاری ذخایر</p>
                                </a>
                            </li>
                            @endcan

                        </ul>
                    </li>
                    @endcanany

                    @canany(['show-water-productions','show-water-distributions','show-water-wastages','show-water-tests'])
                    <li class="nav-item has-treeview {{isActive(['admin.water_productions.index','admin.water_productions.create','admin.water_productions.edit','admin.water_distributions.index','admin.water_distributions.edit','admin.water_distributions.create','admin.water_wastages.index','admin.water_wastages.edit','admin.water_wastages.create','admin.water_tests.index','admin.water_tests.edit','admin.water_tests.create'],'menu-open')}}">
                        <a href="#" class="nav-link {{isActive(['admin.water_productions.index','admin.water_productions.create','admin.water_productions.edit','admin.water_distributions.index','admin.water_distributions.edit','admin.water_distributions.create','admin.water_wastages.index','admin.water_wastages.edit','admin.water_wastages.create','admin.water_tests.index','admin.water_tests.edit','admin.water_tests.create'])}}">
                            <i class="nav-icon fa fa-circle-o text-primary"></i>
                            <p>
                                   تولید و توزیع آب
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                            @can('show-water-productions')
                            <li class="nav-item">
                                <a href="{{route('admin.water_productions.index')}}" class="nav-link {{isActive('admin.water_productions.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p>تولید آب</p>
                                </a>
                            </li>
                            @endcan
                            @can('show-water-distributions')
                            <li class="nav-item">
                                <a href="{{route('admin.water_distributions.index')}}" class="nav-link {{isActive('admin.water_distributions.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p>توزیع آب</p>
                                </a>
                            </li>
                             @endcan
                             @can('show-water-wastages')
                            <li class="nav-item">
                                <a href="{{route('admin.water_wastages.index')}}" class="nav-link {{isActive('admin.water_wastages.index')}}">
                                    <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                    <p>ضایع آب</p>
                                </a>
                            </li>
                            @endcan
                                @can('show-water-tests')
                                    <li class="nav-item">
                                        <a href="{{route('admin.water_tests.index')}}" class="nav-link {{isActive('admin.water_tests.index')}}">
                                            <i class="fa fa-circle-o nav-icon text-secondary"></i>
                                            <p>تست آب</p>
                                        </a>
                                    </li>
                                @endcan
                        </ul>
                    </li>
                    @endcanany


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
