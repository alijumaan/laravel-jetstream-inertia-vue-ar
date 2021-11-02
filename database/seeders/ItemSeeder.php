<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'nomenclature' => 'بنطلون',
            'color' => 'فضي',
            'size' => 'small',
            'quantity' => 6,
        ]);

        Item::create([
            'nomenclature' => 'بنطلون',
            'color' => 'فضي',
            'size' => 'X-Large',
            'quantity' => 3,

        ]);

        Item::create([
            'nomenclature' => 'بنطلون',
            'color' => 'اصفر',
            'size' => 'Large',
            'quantity' => 13,

        ]);

        Item::create([
            'nomenclature' => 'بنطلون',
            'color' => 'اصفر',
            'size' => 'X-Large',
            'quantity' => 12,

        ]);

        Item::create([
            'nomenclature' => 'بنطلون',
            'color' => 'اصفر',
            'size' => 'Medium',
            'quantity' => 2,

        ]);

        Item::create([
            'nomenclature' => 'بنطلون',
            'color' => 'بني',
            'size' => 'X-Large',
            'quantity' => 9,

        ]);

        Item::create([
            'nomenclature' => 'بنطلون',
            'color' => 'اسود',
            'size' => 'X-Large',
            'quantity' => 4,

        ]);

        Item::create([
            'nomenclature' => 'بنطلون',
            'color' => 'اسود',
            'size' => 'Large',
            'quantity' => 6,

        ]);

        Item::create([
            'nomenclature' => 'بنطلون',
            'color' => 'اسود',
            'size' => 'Medium',
            'quantity' => 4,

        ]);

        Item::create([
            'nomenclature' => 'سترة',
            'color' => 'فضي',
            'size' => 'Medium',
            'quantity' => 2,

        ]);

        Item::create([
            'nomenclature' => 'سترة',
            'color' => 'فضي',
            'size' => 'X-Large',
            'quantity' => 1,

        ]);

        Item::create([
            'nomenclature' => 'سترة',
            'color' => 'فضي',
            'size' => 'Large',
            'quantity' => 5,

        ]);

        Item::create([
            'nomenclature' => 'سترة',
            'color' => 'اصفر',
            'size' => 'Medium',
            'quantity' => 7,

        ]);

        Item::create([
            'nomenclature' => 'سترة',
            'color' => 'اصفر',
            'size' => 'Large',
            'quantity' => 9,

        ]);

        Item::create([
            'nomenclature' => 'سترة',
            'color' => 'اصفر',
            'size' => 'X-Large',
            'quantity' => 9,

        ]);

        Item::create([
            'nomenclature' => 'سترة',
            'color' => 'بني',
            'size' => 'X-Large',
            'quantity' => 1,

        ]);

        Item::create([
            'nomenclature' => 'بساطير',
            'color' => null,
            'size' => null,
            'quantity' => 59,

        ]);

        Item::create([
            'nomenclature' => 'خوذة',
            'color' => 'اصفر',
            'size' => null,
            'quantity' => 15,

        ]);

        Item::create([
            'nomenclature' => 'خوذة',
            'color' => 'احمر',
            'size' => null,
            'quantity' => 9,

        ]);

        Item::create([
            'nomenclature' => 'خوذة',
            'color' => 'ليموني',
            'size' => null,
            'quantity' => 3,

        ]);

        Item::create([
            'nomenclature' => 'خوذة',
            'color' => 'رصاصي',
            'size' => null,
            'quantity' => 6,

        ]);

        Item::create([
            'nomenclature' => 'خوذة',
            'color' => 'ابيض',
            'size' => null,
            'quantity' => 4,

        ]);

        Item::create([
            'nomenclature' => 'قفازات',
            'color' => 'رصاصي',
            'size' => null,
            'quantity' => 52,

        ]);

        Item::create([
            'nomenclature' => 'قفازات',
            'color' => 'بني',
            'size' => null,
            'quantity' => 14,

        ]);

        Item::create([
            'nomenclature' => 'واقي وجه',
            'color' => null,
            'size' => null,
            'quantity' => 3,

        ]);

        Item::create([
            'nomenclature' => 'رايقر (حامل)',
            'color' => null,
            'size' => null,
            'quantity' => 7,

        ]);

        Item::create([
            'nomenclature' => 'سكود (حامل)',
            'color' => null,
            'size' => null,
            'quantity' => 5,

        ]);

        Item::create([
            'nomenclature' => 'ليات',
            'color' => 'ابيض',
            'size' => '2.5',
            'quantity' => 22,

        ]);

        Item::create([
            'nomenclature' => 'ليات',
            'color' => 'احمر',
            'size' => '2.5',
            'quantity' => 1,

        ]);

        Item::create([
            'nomenclature' => 'ليات',
            'color' => 'احمر',
            'size' => '1.5',
            'quantity' => 2,

        ]);

        Item::create([
            'nomenclature' => 'ليات',
            'color' => 'اصفر',
            'size' => '1.5',
            'quantity' => 1,

        ]);
    }
}
