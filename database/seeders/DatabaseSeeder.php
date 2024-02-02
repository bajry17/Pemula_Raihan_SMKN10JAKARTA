<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Role::create(['name'=>'user']);
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'bank']);
        Role::create(['name'=>'kantin']);

        User::create([
            'name'      => 'Raihan',
            'email'     => 'raihan@gmail.com',
            'password'  => 'raihan',
            'role_id'   => 1,
        ]);
        User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'password'  => 'admin',
            'role_id'   => 2,
        ]);
        User::create([
            'name'      => 'Tenizen Bank',
            'email'     => 'bank@gmail.com',
            'password'  => 'bank',
            'role_id'   => 3,
        ]);
        User::create([
            'name'      => 'Tenizen Mart',
            'email'     => 'kantin@gmail.com',
            'password'  => 'kantin',
            'role_id'   => 4,
        ]);

        Category::create(['name'=>'Makanan']);
        Category::create(['name'=>'Minuman']);
        Category::create(['name'=>'Jajanan']);

        Product::create([
            'name'  => 'Nasi Goreng',
            'price' => 10000,
            'stock' => 30,
            'stand' => 1,
            'category_id' => 1,
            'photo' => '/photos/nasgor.png',
            'desc'  => 'Nasi Goreng 3 rasa'
        ]);
        Product::create([
            'name'  => 'Es Jeruk',
            'price' => 5000,
            'stock' => 50,
            'stand' => 2,
            'category_id' => 2,
            'photo' => '/photos/jeruk.png',
            'desc'  => 'Jeruk Asam'
        ]);
        Product::create([
            'name'  => 'Siomay',
            'price' => 6000,
            'stock' => 30,
            'stand' => 3,
            'category_id' => 3,
            'photo' => '/photos/siomay.png',
            'desc'  => 'Siomay Bandung'
        ]);

        Wallet::create([
            'user_id'   => 1,
            'credit'    => 100000,
            'status'    => 'diterima',
            'desc'      => 'Top Up'
        ]);
        Wallet::create([
            'user_id'   => 1,
            'debit'    => 10000,
            'status'    => 'diterima',
            'desc'      => 'Membeli Produk'
        ]);
        Wallet::create([
            'user_id'   => 1,
            'debit'    => 10000,
            'status'    => 'proses',
            'desc'      => 'Tarik Tunai'
        ]);
        Wallet::create([
            'user_id'   => 1,
            'debit'    => 10000,
            'status'    => 'ditolak',
            'desc'      => 'Tarik Tunai'
        ]);
        Wallet::create([
            'user_id'   => 1,
            'credit'    => 100000,
            'status'    => 'ditolak',
            'desc'      => 'Top Up'
        ]);

        Transaction::create([
            'user_id'   => 1,
            'product_id'=> 1,
            'quantity'  => 2,
            'status'    => 'dikeranjang'
        ]);
        Transaction::create([
            'user_id'   => 1,
            'product_id'=> 2,
            'quantity'  => 2,
            'status'    => 'dikeranjang'
        ]);
        Transaction::create([
            'user_id'   => 1,
            'product_id'=> 3,
            'quantity'  => 2,
            'status'    => 'dikeranjang'
        ]);
    }

}
