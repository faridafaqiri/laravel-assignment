<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
               'name'=>'show-users',
               'label'=>'نمایش کاربران',
            ],
            [
                'name'=>'edit-user',
                'label'=>'ویرایش کاربران',
            ],
            [
                'name'=>'create-user',
                'label'=>'ثبت کاربران',
            ],
            [
                'name'=>'delete-user',
                'label'=>'حذف کاربران',
            ],
            [
                'name'=>'show-assets',
                'label'=>'نمایش دارایی'
            ],
            [
                'name'=>'edit-asset',
                'label'=>'ویرایش دارایی'
            ],
            [
                'name'=>'create-asset',
                'label'=>'ثبت دارایی',
            ],
            [
                'name'=>'delete-asset',
                'label'=>'حذف دارایی'
            ],
            [
                'name'=>'show-customers',
                'label'=>'نمایش مشترکین'
            ],
            [
                'name'=>'edit-customer',
                'label'=>'ویرایش مشرکین',
            ],
            [
                'name'=>'create-customer',
                'label'=>'ثبت مشترکین'
            ],
            [
                'name'=>'delete-customer',
                'label'=>'حذف مشترکین'
            ],
            [
                'name'=>'show-debts',
                'label'=>'نمایش دیون'
            ],
            [
                'name'=>'edit-debt',
                'label'=>'ویرایش دیون'
            ],
            [
                'name'=>'create-debt',
                'label'=>'ثبت دیون '
            ],
            [
                'name'=>'delete-debt',
                'label'=>'حذف دیون'
            ],
            [
                'name'=>'show-distributed-bills',
                'label'=>'نمایش بل های توزیع شده'
            ],
            [
                'name'=>'create-distributed-bill',
                'label'=>'ثبت بل های توزیع شده'
            ],
            [
                'name'=>'edit-distributed-bill',
                'label'=>'ویرایش بل های توزیع شده'
            ],
            [
                'name'=>'delete-distributed-bill',
                'label'=>'حذف بل های توزیع شده'
            ],
            [
                'name'=>'show-energy-types',
                'label'=>'نمایش انواع انرژی',
            ],
            [
                'name'=>'create-energy-type',
                'label'=>'ثبت نوع انرژی'
            ],
            [
                'name'=>'edit-energy-type',
                'label'=>'ویرایش نوع انرژی'
            ],
            [
                'name'=>'delete-energy-type',
                'label'=>'حذف نوع انرژی'
            ],
            [
                'name'=>'show-faucet-changes',
                'label'=>'نمایش  نل های تبدیل شده'
            ],
            [
                'name'=>'create-faucet-change',
                'label'=>'ثبت نل های تبدیل شده'
            ],
            [
                'name'=>'edit-faucet-change',
                'label'=>'ویرایش نل های تبدیل شده'
            ],
            [
                'name'=>'delete-faucet-change',
                'label'=>'حذف نل های تبدیل شده'
            ],
            [
                'name'=>'show-faucet-diameter-customers',
                'label'=>'نمایش قطر نل ها'
            ],
            [
                'name'=>'create-faucet-diameter-customer',
                'label'=>'ثبت قطر نل ها'
            ],
            [
                'name'=>'edit-faucet-diameter-customer',
                'label'=>'ویرایش قطر نل ها'
            ],
            [
                'name'=>'delete-faucet-diameter-customer',
                'label'=>'حذف قطر نل ها'
            ],
            [
                'name'=>'show-illegal-customers',
                'label'=>' مشترکین غیر قانونی'
            ],
            [
                'name'=>'creat-illegal-customer',
                'label'=>'ثبت مشترکین غیر قانونی'
            ],
            [
                'name'=>'edit-illegal-customer',
                'label'=>'ویرایش مشترکین غیر قانونی'
            ],
            [
                'name'=>'delete-illegal-customer',
                'label'=>'حذف مشترکین غیر قانونی'
            ],
            [
                'name'=>'show-impaired-pumps',
                'label'=>'نمایش  پمپ های خراب شده'
            ],
            [
                'name'=>'create-impaired-pump',
                'label'=>'ثبت پمپ های خراب شده'
            ],
            [
                'name'=>'edit-impaired-pump',
                'label'=>'ویرایش  پمپ های خراب شده'
            ],
            [
                'name'=>'delete-impaired-pump',
                'label'=>'حذف پمپ های خراب شده'
            ],
            [
                'name'=>'show-leakages',
                'label'=>'نمایش  نل های لیک شده'
            ],
            [
                'name'=>'create-leakage',
                'label'=>'ثبت نل های لیک شده'
            ],
            [
                'name'=>'edit-leakage',
                'label'=>'ویرایش نل های لیک شده'
            ],
            [
                'name'=>'delete-leakage',
                'label'=>'حذف نل های لیک شده'
            ],
            [
                'name'=>'show-meter-changes',
                'label'=>'نمایش میتر های تبدیل شده'
            ],
            [
                'name'=>'create-meter-change',
                'label'=>'ثبت میتر های تبدیل شده'
            ],
            [
                'name'=>'edit-meter-change',
                'label'=>'ویرایش میتر های تبدیل شده'
            ],
            [
                'name'=>'delete-meter-change',
                'label'=>'حذف میتر های تبدیل شده'
            ],
            [
                'name'=>'show-meter-readers',
                'label'=>'نمایش  میتر خوان ها'
            ],
            [
                'name'=>'create-meter-reader',
                'label'=>'ثبت میتر خوان ها'
            ],
            [
                'name'=>'edit-meter-reader',
                'label'=>'ویرایش میتر خوان ها'
            ],
            [
                'name'=>'delete-meter-reader',
                'label'=>'حذف میتر خوان ها'
            ],
            [
                'name'=>'show-meter-readings',
                'label'=>'نمایش  میتر خوانی ها'
            ],
            [
                'name'=>'create-meter-reading',
                'label'=>'ثبت میتر خوانی ها'
            ],
            [
                'name'=>'edit-meter-reading',
                'label'=>'ویرایش میتر خوانی ها'
            ],
            [
                'name'=>'delete-meter-reading',
                'label'=>'حذف میتر خوانی ها'
            ],
            [
                'name'=>'show-permissions',
                'label'=>'نمایش دسترسی ها'
            ],
            [
                'name'=>'create-permission',
                'label'=>'ثبت دسترسی'
            ],
            [
                'name'=>'edit-permission',
                'label'=>'ویرایش دسترسی'
            ],
            [
                'name'=>'delete-permission',
                'label'=>'حذف دسترسی'
            ],
            [
                'name'=>'staff-user-permissions',
                'label'=>'تغییر دادن دسترسی ها'
            ],
            [
                'name'=>'show-printed-bills',
                'label'=>'نمایش  بل های چاپ شده'
            ],
            [
                'name'=>'create-printed-bill',
                'label'=>'ثبت بل های چاپ شده'
            ],
            [
                'name'=>'edit-printed-bill',
                'label'=>'ویرایش بل های چاپ شده'
            ],
            [
                'name'=>'delete-printed-bill',
                'label'=>'حذف بل های چاپ شده'
            ],
            [
                'name'=>'show-provinces',
                'label'=>'نمایش  ولایات'
            ],
            [
                'name'=>'create-province',
                'label'=>'ثبت ولایات'
            ],
            [
                'name'=>'edit-province',
                'label'=>'ویرایش ولایات'
            ],
            [
                'name'=>'delete-province',
                'label'=>'حذف ولایات'
            ],
            [
                'name'=>'show-provincial-zones',
                'label'=>'نمایش  زون های ولایتی',
            ],
            [
                'name'=>'create-provincial-zone',
                'label'=>'ثبت زون های ولایتی',
            ],
            [
                'name'=>'edit-provincial-zone',
                'label'=>'ویرایش زون های ولایتی',
            ],
            [
                'name'=>'delete-provincial-zone',
                'label'=>'حذف زون های ولایتی',
            ],
            [
                'name'=>'show-roles',
                'label'=>'نمایش  مقام ها',
            ],
            [
                'name'=>'create-role',
                'label'=>'ثبت مقام ها',
            ],
            [
                'name'=>'edit-role',
                'label'=>'ویرایش مقام ها',
            ],
            [
                'name'=>'delete-role',
                'label'=>'حذف مقام ها',
            ],
            [
                'name'=>'show-signboards',
                'label'=>'نمایش لوحه ها',
            ],
            [
                'name'=>'create-signboard',
                'label'=>'ثبت لوحه',
            ],
            [
                'name'=>'edit-signboard',
                'label'=>'ویرایش لوحه',
            ],
            [
                'name'=>'delete-signboard',
                'label'=>'حذف لوحه',
            ],
            [
                'name'=>'show-source-types',
                'label'=>'نمایش انواع منابع',
            ],
            [
                'name'=>'create-source-type',
                'label'=>'ثبت انواع منابع',
            ],
            [
                'name'=>'edit-source-type',
                'label'=>'ویرایش انواع منابع',
            ],
            [
                'name'=>'delete-source-type',
                'label'=>'حذف انواع منابع',
            ],
            [
                'name'=>'show-sources',
                'label'=>'نمایش منابع',
            ],
            [
                'name'=>'create-source',
                'label'=>'ثبت منابع',
            ],
            [
                'name'=>'edit-source',
                'label'=>'ویرایش منابع',
            ],
            [
                'name'=>'delete-source',
                'label'=>'حذف منابع',
            ],
            [
                'name'=>'show-storage-cleans',
                'label'=>'نمایش پاک کاری ذخیره',
            ],
            [
                'name'=>'create-storage-clean',
                'label'=>'ثبت پاک کاری ذخیره',
            ],
            [
                'name'=>'create-storage-clean',
                'label'=>'ویرایش پاک کاری ذخیره',
            ],
            [
                'name'=>'create-storage-clean',
                'label'=>'حذف پاک کاری ذخیره',
            ],
            [
                'name'=>'show-users',
                'label'=>'نمایش  کاربران',
            ],
            [
                'name'=>'create-user',
                'label'=>'ثبت کاربران',
            ],
            [
                'name'=>'edit-user',
                'label'=>'ویرایش کاربران',
            ],
            [
                'name'=>'delete-user',
                'label'=>'حذف کاربران',
            ],
            [
                'name'=>'show-water-distributions',
                'label'=>'نمایش توزیع آب',
            ],
            [
                'name'=>'create-water-distribution',
                'label'=>'ثبت توزیع آب',
            ],
            [
                'name'=>'edit-water-distribution',
                'label'=>'ویرایش توزیع آب',
            ],
            [
                'name'=>'delete-water-distribution',
                'label'=>'حذف توزیع آب',
            ],
            [
                'name'=>'show-water-productions',
                'label'=>'نمایش تولید آب',
            ],
            [
                'name'=>'create-water-production',
                'label'=>'ثبت تولید آب',
            ],
            [
                'name'=>'edit-water-production',
                'label'=>'ویرایش تولید آب',
            ],
            [
                'name'=>'delete-water-production',
                'label'=>'حذف تولید آب',
            ],
            [
                'name'=>'show-water-storages',
                'label'=>'نمایش ذخایر آب',
            ],
            [
                'name'=>'create-water-storage',
                'label'=>'ثبت ‌ذخایر آب',
            ],
            [
                'name'=>'edit-water-storage',
                'label'=>'ویرایش ‌ذخایر آب',
            ],
            [
                'name'=>'delete-water-storage',
                'label'=>'حذف ذخایر آب',
            ],
            [
                'name'=>'show-water-wastages',
                'label'=>'نمایش ضایعات آب',
            ],
            [
                'name'=>'create-water-wastage',
                'label'=>'ثبت ضایعات آب',
            ],
            [
                'name'=>'edit-water-wastage',
                'label'=>'ویرایش ضایعات آب',
            ],
            [
                'name'=>'delete-water-wastage',
                'label'=>'حذف ضایعات آب',
            ],
            [
                'name'=>'show-incomes',
                'label'=>'نمایش عایدات',
            ],
            [
                'name'=>'create-income',
                'label'=>'ثبت عایدات',
            ],
            [
                'name'=>'edit-income',
                'label'=>'ویرایش عایدات',
            ],
            [
                'name'=>'delete-income',
                'label'=>'حذف عایدات',
            ],

            [
                'name'=>'show-water-tests',
                'label'=>'نمایش آب های تست شده'
            ],
            [
                'name'=>'create-water-test',
                'label'=>'ایجاد آب های تست شده'
            ],
            [
                'name'=>'edit-water-test',
                'label'=>'ویرایش آب های تست شده'
            ],
            [
                'name'=>'delete-water-test',
                'label'=>'حذف آب های تست شده'
            ],
            [
                'name'=>'show-develop-web-lengths',
                'label'=>'نمایش توسعه طول شبکه'
            ],
            [
                'name'=>'create-develop-web-length',
                'label'=>'ایجاد توسعه طول شبکه'
            ],
            [
                'name'=>'edit-develop-web-length',
                'label'=>'ویرایش توسعه طول شبکه'
            ],
            [
                'name'=>'delete-develop-web-length',
                'label'=>'حذف توسعه طول شبکه'
            ],
            [
                'name'=>'show-change-web-lengths',
                'label'=>'نمایش تعویض طول شبکه'
            ],
            [
                'name'=>'create-change-web-length',
                'label'=>'ایجاد تعویض طول شبکه'
            ],
            [
                'name'=>'edit-change-web-length',
                'label'=>'ویرایش تعویض طول شبکه'
            ],
            [
                'name'=>'delete-change-web-length',
                'label'=>'حذف تعویض طول شبکه'
            ],
            [
                'name'=>'show-planning-incomes',
                'label'=>'نمایش عواید پلان شده'
            ],
            [
                'name'=>'create-planning-income',
                'label'=>'ایجاد عواید پلان شده'
            ],
            [
                'name'=>'edit-planning-income',
                'label'=>'ویرایش عواید پلان شده'
            ],
            [
                'name'=>'delete-planning-income',
                'label'=>'حذف عواید پلان شده'
            ],
            [
                'name'=>'show-wall-chambers',
                'label'=>'نمایش وال چمبر'
            ],
            [
                'name'=>'create-wall-chamber',
                'label'=>'ایجاد وال چمبر'
            ],
            [
                'name'=>'edit-wall-chamber',
                'label'=>'ویرایش وال چمبر'
            ],
            [
                'name'=>'delete-wall-chamber',
                'label'=>'حذف وال چمبر'
            ],
            [
                'name'=>'show-wall-controllings',
                'label'=>'نمایش وال چمبر'
            ],
            [
                'name'=>'create-wall-controlling',
                'label'=>'ایجاد وال چمبر'
            ],
            [
                'name'=>'edit-wall-controlling',
                'label'=>'ویرایش وال چمبر'
            ],
            [
                'name'=>'delete-wall-controlling',
                'label'=>'حذف وال چمبر'
            ],
            [
                'name'=>'show-covered-populations',
                'label'=>'نمایش نفوس تحت پوشش'
            ],
            [
                'name'=>'create-covered-population',
                'label'=>'ایجاد نفوس تحت پوشش'
            ],
            [
                'name'=>'edit-covered-population',
                'label'=>'ویرایش نفوس تحت پوشش'
            ],
            [
                'name'=>'delete-covered-population',
                'label'=>'حذف نفوس تحت پوشش'
            ],
            [
                'name'=>'show-settings',
                'label'=>'دسترسی به تنظیمات'
            ],

            //------------------------------------reports

            [
                'name'=>'show-customers-report',
                'label'=>'نمایش گزارش کاربران',
            ],
            [
                'name'=>'show-bills-report',
                'label'=>'نمایش گزارش بل ها',
            ],

            [
                'name'=>'show-water-storages-report',
                'label'=>'نمایش گزارش ذخایر آب',
            ],

            [
                'name'=>'show-water-distributions-report',
                'label'=>'نمایش گزارش آب های توزیع شده',
            ],

            [
                'name'=>'show-meter-readers-report',
                'label'=>'نمایش گزارش  میتر خوان ها',
            ],

            [
                'name'=>'show-meter-readings-report',
                'label'=>'نمایش گزارش میتر خوانی ها',
            ],

            [
                'name'=>'show-assets-report',
                'label'=>'نمایش گزارش دارایی ها',
            ],

            [
                'name'=>'show-sources-report',
                'label'=>'نمایش گزارش منابع',
            ],

            [
                'name'=>'show-impaired-pumps-report',
                'label'=>'نمایش گزارش پمپ های خراب شده',
            ],
            [
                'name'=>'show.leakages.report',
                'label'=>'نمایش گزارش نل های لیک شده',
            ],
            [
                'name'=>'show-incomes-report',
                'label'=>'نمایش گزارش عواید',
            ],

            [
                'name'=>'show-wall-chambers-wall-controllings-report',
                'label'=>'نمایش گزارش وال چمبر و وال کنترولینگ',
            ],

            [
                'name'=>'show-covered-populations-report',
                'label'=>'نمایش گزارش نفوس تحت پوشش',
            ],

            [
                'name'=>'show-web-lengths-report',
                'label'=>'نمایش گزارش طول شبکه',
            ],

            [
                'name'=>'show-meter-changes-report',
                'label'=>'نمایش گزارش میتر های تعویض شده',
            ],

        ]);
    }
}
