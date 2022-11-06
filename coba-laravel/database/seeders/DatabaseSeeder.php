<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ini akan meng-generate 10 data palsu untuk dimasukan kedalam table User
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // menyimpan data untuk dikirimkan ke database, jadi gk perlu pake php artisan tinker untuk menambahkan data ke dalam database, cukup pake php artisan db:seed, perintah itu akan menjalankan semua code dibawah ini dan menambahkan data ke dalam table di database secara otomatis.

        User::create([
            'name' => 'Muhammad Yazid Akbar',
            'username' => 'yazz',
            'email' => 'yazidakbar08@gmail.com',
            'password' => bcrypt('password')
        ]);

        // User::create([
        //     'name' => 'Firdaus',
        //     'email' => 'firdaus@gmail.com',
        //     'password' => bcrypt('1234')
        // ]);

        // Membuat data dummy(fake) menggunakan UserFactory yg ada di folder database->factories
        User::factory(4)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Category::create([
            'name' => 'Life Style',
            'slug' => 'life-style'
        ]);

        Post::factory(20)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta deleniti, tempore recusandae ipsum, quis excepturi doloremque libero nihi',
        //     'body' => '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta deleniti, tempore recusandae ipsum, quis excepturi doloremque libero nihil est vel animi modi accusantium unde eos, deserunt iure minima nam debitis eum magni? Architecto porro tempore voluptate</p><p> ipsam eum impedit ipsa. Id quod totam quam placeat est et delectus, ex nemo odio eius iste laborum doloribus maiores earum ut impedit. In et autem modi necessitatibus assumenda ipsam, sequi rem ab veniam inventore facere voluptatem</p><p> ipsum dicta dignissimos aperiam? Non rem repellendus provident quis quisquam veniam mollitia magnam obcaecati, facilis nobis minus dolorem aliquid nam. Nemo repellat rerum ipsa dicta quod, ex voluptatibus quidem veritatis optio qui, velit natus, at possimus aliquid consectetur cumque voluptates iure laborum! Praesentium esse unde aliquam nesciunt!</p>',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'slug' => 'judul-ke-dua',
        //     'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta deleniti, tempore recusandae ipsum, quis excepturi doloremque libero nihi',
        //     'body' => '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta deleniti, tempore recusandae ipsum, quis excepturi doloremque libero nihil est vel animi modi accusantium unde eos, deserunt iure minima nam debitis eum magni? Architecto porro tempore voluptate</p><p> ipsam eum impedit ipsa. Id quod totam quam placeat est et delectus, ex nemo odio eius iste laborum doloribus maiores earum ut impedit. In et autem modi necessitatibus assumenda ipsam, sequi rem ab veniam inventore facere voluptatem</p><p> ipsum dicta dignissimos aperiam? Non rem repellendus provident quis quisquam veniam mollitia magnam obcaecati, facilis nobis minus dolorem aliquid nam. Nemo repellat rerum ipsa dicta quod, ex voluptatibus quidem veritatis optio qui, velit natus, at possimus aliquid consectetur cumque voluptates iure laborum! Praesentium esse unde aliquam nesciunt!</p>',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'slug' => 'judul-ke-tiga',
        //     'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta deleniti, tempore recusandae ipsum, quis excepturi doloremque libero nihi',
        //     'body' => '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta deleniti, tempore recusandae ipsum, quis excepturi doloremque libero nihil est vel animi modi accusantium unde eos, deserunt iure minima nam debitis eum magni? Architecto porro tempore voluptate</p><p> ipsam eum impedit ipsa. Id quod totam quam placeat est et delectus, ex nemo odio eius iste laborum doloribus maiores earum ut impedit. In et autem modi necessitatibus assumenda ipsam, sequi rem ab veniam inventore facere voluptatem</p><p> ipsum dicta dignissimos aperiam? Non rem repellendus provident quis quisquam veniam mollitia magnam obcaecati, facilis nobis minus dolorem aliquid nam. Nemo repellat rerum ipsa dicta quod, ex voluptatibus quidem veritatis optio qui, velit natus, at possimus aliquid consectetur cumque voluptates iure laborum! Praesentium esse unde aliquam nesciunt!</p>',
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Keempat',
        //     'slug' => 'judul-ke-empat',
        //     'excerpt' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta deleniti, tempore recusandae ipsum, quis excepturi doloremque libero nihi',
        //     'body' => '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta deleniti, tempore recusandae ipsum, quis excepturi doloremque libero nihil est vel animi modi accusantium unde eos, deserunt iure minima nam debitis eum magni? Architecto porro tempore voluptate</p><p> ipsam eum impedit ipsa. Id quod totam quam placeat est et delectus, ex nemo odio eius iste laborum doloribus maiores earum ut impedit. In et autem modi necessitatibus assumenda ipsam, sequi rem ab veniam inventore facere voluptatem</p><p> ipsum dicta dignissimos aperiam? Non rem repellendus provident quis quisquam veniam mollitia magnam obcaecati, facilis nobis minus dolorem aliquid nam. Nemo repellat rerum ipsa dicta quod, ex voluptatibus quidem veritatis optio qui, velit natus, at possimus aliquid consectetur cumque voluptates iure laborum! Praesentium esse unde aliquam nesciunt!</p>',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);

    }
}
