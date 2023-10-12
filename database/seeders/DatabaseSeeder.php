<?php

namespace Database\Seeders;

use App\Models\Advice;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert(
           [
               'name' => 'Admin',
               'email' => 'admin@gmail.com',
               'email_verified_at' => now(),
               'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
               'remember_token' => Str::random(10),
               'role' => '1',
               'created_at' => now()
           ]
        );


        $categories = ['ဆပ်ပြာ'];

        foreach ($categories as $cat) {

            $category = new Category();
            $category->name = $cat;
            $category->save();

        }

        $brands = ['အီလန်','အိုကီ','ဖူမီ'];

        foreach ($brands as $b) {

            $brand = new Brand();
            $brand->category_id = Category::all()->random()->id;
            $brand->name = $b;
            $brand->save();

        }

        \App\Models\Product::factory(5)->create()->each(function ($p){

            for ($i=0; $i< rand(1,9); $i++){

                $photo = new ProductPhoto();
                $photo->product_id = $p->id ;
                $photo->name = null;
                $photo->save();
            }
        });

        \App\Models\User::factory(50)->create()->each(function ($u){
            $unique = uniqid();

            $order = new Order();
            $order->unique_id = $unique;
            $order->user_id = $u->id;
            $order->created_at = now()->subMonths(rand(1,12));
            $order->save();

            for ($i=0; $i< rand(3,20); $i++){
                $product = Product::all()->random();
                $quantity = random_int(1,$product->stock);

                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id ;
                $orderProduct->quantity = $quantity;
                $orderProduct->product_price = $product->price;
                $orderProduct->product_id = $product->id;
                $orderProduct->sub_price = $product->price * $quantity;
                $orderProduct->save();
            }
        });

        \App\Models\Advice::factory(1)->create();


    }
}
