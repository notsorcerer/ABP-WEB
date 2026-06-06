<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $vapeCat = Category::firstOrCreate(['name' => 'Vape', 'slug' => 'vape']);
        $liquidCat = Category::firstOrCreate(['name' => 'Liquid', 'slug' => 'liquid']);

        $products = [
            ['name' => 'Vaporesso XROS Pro', 'description' => 'Pod system terbaru dengan airflow adjustable, battery 1000mAh, dan compatible dengan XROS series pod. Cocok untuk pemula hingga advanced user.', 'price' => 350000, 'category_id' => $vapeCat->id, 'image' => 'https://images.unsplash.com/photo-1574053810618-e9281b9fc3e6?w=600&q=80', 'is_best_seller' => true, 'is_new_arrival' => true],
            ['name' => 'Oxva Xlim Pro 2', 'description' => 'Pod mod dengan layar OLED 0.96 inch, battery 1500mAh, dan output maksimal 30W. Desain elegan dengan berbagai pilihan warna.', 'price' => 420000, 'category_id' => $vapeCat->id, 'image' => 'https://images.unsplash.com/photo-1621609764095-32f35c27e5e7?w=600&q=80', 'is_best_seller' => true, 'is_new_arrival' => false],
            ['name' => 'Geekvape Wenax Q', 'description' => 'Pod system ultra portabel dengan desain minimalis. Battery 800mAh, compatible dengan Wenax Q series pod. Nikmati vaping experience terbaik.', 'price' => 280000, 'category_id' => $vapeCat->id, 'image' => 'https://images.unsplash.com/photo-1583424511280-5da8177344d5?w=600&q=80', 'is_best_seller' => false, 'is_new_arrival' => true],
            ['name' => 'SMOK Nord 5', 'description' => 'Pod mod powerful dengan dual battery 18650, output hingga 100W, dan airflow control. Cocok untuk cloud chaser dan flavor chaser.', 'price' => 580000, 'category_id' => $vapeCat->id, 'image' => 'https://images.unsplash.com/photo-1606914469271-52e0a0817f38?w=600&q=80', 'is_best_seller' => true, 'is_new_arrival' => false],
            ['name' => 'Uwell Caliburn G3', 'description' => 'Pod system terbaru dari Uwell dengan coil pro-focus technology. Battery 900mAh, pengisian USB-C, dan leak-proof design.', 'price' => 320000, 'category_id' => $vapeCat->id, 'image' => 'https://images.unsplash.com/photo-1615487154365-5f7b9190ec84?w=600&q=80', 'is_best_seller' => false, 'is_new_arrival' => true],
            ['name' => 'Voopoo Drag 4', 'description' => 'Box mod legendaris dengan chipset Gene.Fan 3.0, dual 18650 battery, output hingga 177W. Desain kulit sintetis yang premium.', 'price' => 650000, 'category_id' => $vapeCat->id, 'image' => 'https://images.unsplash.com/photo-1601645191163-3fc0d5d64e35?w=600&q=80', 'is_best_seller' => true, 'is_new_arrival' => false],
            ['name' => 'Lost Vape Ursa Nano 2', 'description' => 'Pod system kompak dengan desain fashionable. Battery 700mAh, compatible dengan Ursa Nano pod. Cocok untuk daily driver.', 'price' => 250000, 'category_id' => $vapeCat->id, 'image' => 'https://images.unsplash.com/photo-1585837191776-7356b53cc16a?w=600&q=80', 'is_best_seller' => false, 'is_new_arrival' => false],
            ['name' => 'Aspire Flexus Q', 'description' => 'Pod system tipis dan stylish dengan battery 800mAh. AF Mesh Coil untuk flavor maksimal. Desain card-like yang mudah dibawa.', 'price' => 300000, 'category_id' => $vapeCat->id, 'image' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?w=600&q=80', 'is_best_seller' => false, 'is_new_arrival' => true],
            ['name' => 'Pod Juice - Mango Ice 30ml', 'description' => 'Liquid salt nic dengan rasa mangga segar dan sensasi cool mint. Nikotin 30mg, PG/VG 50:50. Cocok untuk pod system.', 'price' => 85000, 'category_id' => $liquidCat->id, 'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=600&q=80', 'is_best_seller' => true, 'is_new_arrival' => false],
            ['name' => 'Elf Bar - Blueberry Sour Raspberry 30ml', 'description' => 'Liquid salt nic premium dengan perpaduan blueberry dan raspberry asam. Nikotin 30mg, smooth throat hit.', 'price' => 90000, 'category_id' => $liquidCat->id, 'image' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=600&q=80', 'is_best_seller' => true, 'is_new_arrival' => true],
            ['name' => 'Naked 100 - Lava Flow 60ml', 'description' => 'Freebase liquid dengan rasa perpaduan strawberry, pineapple, dan coconut. Nikotin 3mg, VG 70%. Cocok untuk sub-ohm.', 'price' => 150000, 'category_id' => $liquidCat->id, 'image' => 'https://images.unsplash.com/photo-1544441893-675973e31985?w=600&q=80', 'is_best_seller' => true, 'is_new_arrival' => false],
            ['name' => 'Fruitia - Lychee Grape 30ml', 'description' => 'Salt nic liquid dengan kombinasi leci manis dan anggur segar. Nikotin 25mg, perfect for everyday vaping.', 'price' => 80000, 'category_id' => $liquidCat->id, 'image' => 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?w=600&q=80', 'is_best_seller' => false, 'is_new_arrival' => true],
            ['name' => 'Dinner Lady - Lemon Tart 60ml', 'description' => 'Freebase liquid rasa lemon tart klasik dengan pastry cream. Nikotin 6mg, VG 70%. Rekomendasi untuk all-day vaping.', 'price' => 160000, 'category_id' => $liquidCat->id, 'image' => 'https://images.unsplash.com/photo-1584305574647-0cc9494f1a8b?w=600&q=80', 'is_best_seller' => true, 'is_new_arrival' => false],
            ['name' => 'Pod Juice - Strawberry Watermelon 30ml', 'description' => 'Salt nic liquid dengan rasa strawberry dan semangka yang menyegarkan. Nikotin 30mg, PG 50% untuk throat hit optimal.', 'price' => 85000, 'category_id' => $liquidCat->id, 'image' => 'https://images.unsplash.com/photo-1607613009820-a29f7bb81c04?w=600&q=80', 'is_best_seller' => false, 'is_new_arrival' => false],
            ['name' => 'Keep It 100 - Blue Slushie 100ml', 'description' => 'Freebase liquid rasa blue slushie yang manis dan segar. Nikotin 3mg, VG 80%. Cloud chaser favorite!', 'price' => 200000, 'category_id' => $liquidCat->id, 'image' => 'https://images.unsplash.com/photo-1531058020387-3be344556be6?w=600&q=80', 'is_best_seller' => false, 'is_new_arrival' => true],
            ['name' => 'Vapetasia - Killer Kustard 60ml', 'description' => 'Freebase liquid vanilla custard klasik dengan sentuhan creamy. Nikotin 6mg, VG 70%. Best seller sepanjang masa.', 'price' => 170000, 'category_id' => $liquidCat->id, 'image' => 'https://images.unsplash.com/photo-1583244685026-d8519b5e3d2e?w=600&q=80', 'is_best_seller' => true, 'is_new_arrival' => false],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
