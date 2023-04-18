<?php

namespace Database\Seeders;

use App\Models\contact as ModelsContact;
use Database\Factories\ContactFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class contact extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       ModelsContact::factory()->create();
    }
}
