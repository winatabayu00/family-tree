<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SeedFamilyTree extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $familyData = [
            [
                'name' => 'Budi',
                'gender' => 'male',
                'parent_id' => null,
            ],
            [
                'name' => 'Dedi',
                'gender' => 'male',
                'parent_id' => 1,
            ],
            [
                'name' => 'Feri',
                'gender' => 'male',
                'parent_id' => 2,
            ],
            [
                'name' => 'Farah',
                'gender' => 'female',
                'parent_id' => 2,
            ],
            [
                'name' => 'Dodi',
                'gender' => 'male',
                'parent_id' => 1,
            ],
            [
                'name' => 'Gugus',
                'gender' => 'male',
                'parent_id' => 5,
            ],
            [
                'name' => 'Gandi',
                'gender' => 'male',
                'parent_id' => 5,
            ],
            [
                'name' => 'Dede',
                'gender' => 'male',
                'parent_id' => 1,
            ],
            [
                'name' => 'Hani',
                'gender' => 'female',
                'parent_id' => 8,
            ],
            [
                'name' => 'Hana',
                'gender' => 'female',
                'parent_id' => 8,
            ],
            [
                'name' => 'Dewi',
                'gender' => 'female',
                'parent_id' => 1,
            ],
        ];


        $data = collect($familyData)
            ->map(fn ($it) => array_merge($it, [
                'created_at' => now(),
                'updated_at' => now()
            ]))->toArray();

        DB::table('family')->insert($data);
    }
}
