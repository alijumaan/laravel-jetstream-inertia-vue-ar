<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('items')->delete();

        \DB::table('items')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nomenclature' => 'بنطلون',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'فضي',
                'size' => 'small',
                'quantity' => 6,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'nomenclature' => 'بنطلون',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'فضي',
                'size' => 'X-Large',
                'quantity' => 3,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'nomenclature' => 'بنطلون',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'اصفر',
                'size' => 'Large',
                'quantity' => 13,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'nomenclature' => 'بنطلون',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'اصفر',
                'size' => 'X-Large',
                'quantity' => 12,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'nomenclature' => 'بنطلون',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'اصفر',
                'size' => 'Medium',
                'quantity' => 2,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'nomenclature' => 'بنطلون',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'بني',
                'size' => 'X-Large',
                'quantity' => 9,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'nomenclature' => 'بنطلون',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'اسود',
                'size' => 'X-Large',
                'quantity' => 4,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'nomenclature' => 'بنطلون',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'اسود',
                'size' => 'Large',
                'quantity' => 6,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'nomenclature' => 'بنطلون',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'اسود',
                'size' => 'Medium',
                'quantity' => 4,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'nomenclature' => 'سترة',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'فضي',
                'size' => 'Medium',
                'quantity' => 2,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'nomenclature' => 'سترة',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'فضي',
                'size' => 'X-Large',
                'quantity' => 1,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'nomenclature' => 'سترة',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'فضي',
                'size' => 'Large',
                'quantity' => 5,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'nomenclature' => 'سترة',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'اصفر',
                'size' => 'Medium',
                'quantity' => 7,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'nomenclature' => 'سترة',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'اصفر',
                'size' => 'Large',
                'quantity' => 9,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'nomenclature' => 'سترة',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'اصفر',
                'size' => 'X-Large',
                'quantity' => 9,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'nomenclature' => 'سترة',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'بني',
                'size' => 'X-Large',
                'quantity' => 1,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'nomenclature' => 'بساطير',
                'sku' => NULL,
                'part' => NULL,
                'color' => NULL,
                'size' => NULL,
                'quantity' => 59,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            17 =>
            array (
                'id' => 18,
                'nomenclature' => 'خوذة',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'اصفر',
                'size' => NULL,
                'quantity' => 15,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            18 =>
            array (
                'id' => 19,
                'nomenclature' => 'خوذة',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'احمر',
                'size' => NULL,
                'quantity' => 9,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            19 =>
            array (
                'id' => 20,
                'nomenclature' => 'خوذة',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'ليموني',
                'size' => NULL,
                'quantity' => 3,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            20 =>
            array (
                'id' => 21,
                'nomenclature' => 'خوذة',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'رصاصي',
                'size' => NULL,
                'quantity' => 6,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            21 =>
            array (
                'id' => 22,
                'nomenclature' => 'خوذة',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'ابيض',
                'size' => NULL,
                'quantity' => 4,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            22 =>
            array (
                'id' => 23,
                'nomenclature' => 'قفازات',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'رصاصي',
                'size' => NULL,
                'quantity' => 52,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            23 =>
            array (
                'id' => 24,
                'nomenclature' => 'قفازات',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'بني',
                'size' => NULL,
                'quantity' => 14,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            24 =>
            array (
                'id' => 25,
                'nomenclature' => 'واقي وجه',
                'sku' => NULL,
                'part' => NULL,
                'color' => NULL,
                'size' => NULL,
                'quantity' => 3,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            25 =>
            array (
                'id' => 26,
             'nomenclature' => 'رايقر (حامل)',
                'sku' => NULL,
                'part' => NULL,
                'color' => NULL,
                'size' => NULL,
                'quantity' => 7,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            26 =>
            array (
                'id' => 27,
                'nomenclature' => 'سكود (حامل)',
                'sku' => NULL,
                'part' => NULL,
                'color' => NULL,
                'size' => NULL,
                'quantity' => 5,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            27 =>
            array (
                'id' => 28,
                'nomenclature' => 'ليات',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'ابيض',
                'size' => '2.5',
                'quantity' => 22,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            28 =>
            array (
                'id' => 29,
                'nomenclature' => 'ليات',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'احمر',
                'size' => '2.5',
                'quantity' => 1,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            29 =>
            array (
                'id' => 30,
                'nomenclature' => 'ليات',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'احمر',
                'size' => '1.5',
                'quantity' => 2,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
            30 =>
            array (
                'id' => 31,
                'nomenclature' => 'ليات',
                'sku' => NULL,
                'part' => NULL,
                'color' => 'اصفر',
                'size' => '1.5',
                'quantity' => 1,
                'status' => 1,
                'created_at' => '2021-09-20 23:07:17',
                'updated_at' => '2021-09-20 23:07:17',
                'deleted_at' => NULL,
            ),
        ));


    }
}