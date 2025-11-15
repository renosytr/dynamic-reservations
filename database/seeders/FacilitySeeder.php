<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'Biometric Access', 
                'icon' => 'biometrics.svg'
            ],
            [
                'name' => 'Charging Port', 
                'icon' => 'charging-port.svg'
            ],
            [
                'name' => 'LCD Display', 
                'icon' => 'lcd.svg'
            ],
            [
                'name' => 'Locker Integration', 
                'icon' => 'locker.svg'
            ],
            [
                'name' => 'Projector', 
                'icon' => 'projector.svg'
            ],
            [
                'name' => 'RFID Access', 
                'icon' => 'rfid-access.svg'
            ],
            [
                'name' => 'Smart Lock System', 
                'icon' => 'smart-lock.svg'
            ],
            [
                'name' => 'Projector Screen', 
                'icon' => 'thin.svg'
            ],
        ];
        Facility::upsert($facilities, ['name'], ['icon']);
    }
}
