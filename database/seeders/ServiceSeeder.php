<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [

            // Mens Services
            [
                'name' => 'Mens Haircut',
                'description' => 'Mens haircut service',
                'price' => 150,
                'duration' => 30,
                'status' => 'active'
            ],
            [
                'name' => 'Beard',
                'description' => 'Beard trimming',
                'price' => 100,
                'duration' => 20,
                'status' => 'active'
            ],
            [
                'name' => 'Mens Threading',
                'description' => 'Threading service for men',
                'price' => 80,
                'duration' => 15,
                'status' => 'active'
            ],

            // Women Services
            [
                'name' => 'Women Haircut',
                'description' => 'Haircut for women',
                'price' => 300,
                'duration' => 45,
                'status' => 'active'
            ],
            [
                'name' => 'Advance Haircut',
                'description' => 'Advanced haircut styling',
                'price' => 300,
                'duration' => 60,
                'status' => 'active'
            ],
            [
                'name' => 'Women Threading',
                'description' => 'Threading service for women',
                'price' => 50,
                'duration' => 15,
                'status' => 'active'
            ],

            // Treatments
            ['name'=>'Straightening','description'=>'Hair straightening treatment','price'=>3000,'duration'=>120,'status'=>'active'],
            ['name'=>'Smoothing','description'=>'Hair smoothing treatment','price'=>3000,'duration'=>120,'status'=>'active'],
            ['name'=>'Rebonding','description'=>'Hair rebonding treatment','price'=>3000,'duration'=>120,'status'=>'active'],
            ['name'=>'Botox','description'=>'Hair botox treatment','price'=>4000,'duration'=>120,'status'=>'active'],
            ['name'=>'Nanoplastia','description'=>'Hair nanoplastia treatment','price'=>4500,'duration'=>120,'status'=>'active'],
            ['name'=>'Keratin','description'=>'Keratin treatment','price'=>3000,'duration'=>120,'status'=>'active'],
            ['name'=>'Dandruff Treatment','description'=>'Dandruff hair treatment','price'=>3000,'duration'=>60,'status'=>'active'],
            ['name'=>'Toning','description'=>'Hair toning','price'=>300,'duration'=>30,'status'=>'active'],
            ['name'=>'Tones','description'=>'Hair tones service','price'=>300,'duration'=>30,'status'=>'active'],

            // Facials
            ['name'=>'Fruit Facial','description'=>'Fruit facial treatment','price'=>500,'duration'=>45,'status'=>'active'],
            ['name'=>'Skin Whitening','description'=>'Skin whitening facial','price'=>700,'duration'=>45,'status'=>'active'],
            ['name'=>'Wine Facial','description'=>'Wine facial treatment','price'=>700,'duration'=>45,'status'=>'active'],
            ['name'=>'De-Tan','description'=>'De-tan facial','price'=>800,'duration'=>45,'status'=>'active'],
            ['name'=>'Ubtan Radiance','description'=>'Ubtan radiance facial','price'=>600,'duration'=>45,'status'=>'active'],
            ['name'=>'24ct Gold Facial','description'=>'Gold facial treatment','price'=>1000,'duration'=>60,'status'=>'active'],
            ['name'=>'Diamond Facial','description'=>'Diamond facial','price'=>1000,'duration'=>60,'status'=>'active'],
            ['name'=>'Skin Tightening','description'=>'Skin tightening facial','price'=>700,'duration'=>45,'status'=>'active'],
            ['name'=>'Pearl Facial','description'=>'Pearl facial treatment','price'=>1200,'duration'=>60,'status'=>'active'],
            ['name'=>'O3+ Facial','description'=>'O3+ professional facial','price'=>2800,'duration'=>60,'status'=>'active'],

            // Clean Up
            ['name'=>'Basic Clean Up','description'=>'Basic face clean up','price'=>200,'duration'=>30,'status'=>'active'],
            ['name'=>'Advance Clean Up','description'=>'Advance face clean up','price'=>500,'duration'=>45,'status'=>'active'],

            // Professional Facials
            ['name'=>'Kakadu Plum Facial','description'=>'Professional Kakadu Plum facial','price'=>1500,'duration'=>60,'status'=>'active'],
            ['name'=>'Gotu Kola Facial','description'=>'Professional Gotu Kola facial','price'=>1000,'duration'=>60,'status'=>'active'],
            ['name'=>'Platinum Sheen Facial','description'=>'Professional Platinum Sheen facial','price'=>2000,'duration'=>60,'status'=>'active'],
            ['name'=>'Hydra Glow Facial','description'=>'Professional Hydra Glow facial','price'=>2000,'duration'=>60,'status'=>'active'],

            // Add On Services
            ['name'=>'Sheet Mask','description'=>'Sheet mask add-on','price'=>100,'duration'=>10,'status'=>'active'],
            ['name'=>'Nose Strip','description'=>'Nose strip treatment','price'=>50,'duration'=>5,'status'=>'active'],
            ['name'=>'Rubber Mask','description'=>'Rubber mask treatment','price'=>300,'duration'=>15,'status'=>'active'],
            ['name'=>'Head Massage','description'=>'Head massage','price'=>200,'duration'=>20,'status'=>'active'],
            ['name'=>'Foot Massage','description'=>'Foot massage','price'=>150,'duration'=>20,'status'=>'active'],
            ['name'=>'Back Massage','description'=>'Back massage','price'=>150,'duration'=>20,'status'=>'active'],
            ['name'=>'Nail Filing','description'=>'Nail filing','price'=>50,'duration'=>10,'status'=>'active'],
            ['name'=>'Nail Paint / Polish','description'=>'Nail polish service','price'=>100,'duration'=>15,'status'=>'active'],

        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}