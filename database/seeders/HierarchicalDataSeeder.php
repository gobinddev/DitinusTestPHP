<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HieraricalData;

class HierarchicalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        $records = [
            ['name' => 'Ramesh', 'parent_id' => null],
            ['name' => 'Gaurav', 'parent_id' => 1],  
            ['name' => 'Shalu', 'parent_id' => 1],   
            ['name' => 'Deepu', 'parent_id' => null],
            ['name' => 'Amit', 'parent_id' => 4],   
            ['name' => 'Sham Lal', 'parent_id' => 5], 
            ['name' => 'Kapil', 'parent_id' => 4], 
            ['name' => 'Prem Chopra', 'parent_id' => null],
            
        ];

        HieraricalData::insert($records);
    }
}
