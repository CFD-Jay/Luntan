<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        //注意以下都是有顺序的
        //注册用户数据填充
        $this->call(UsersTableSeeder::class);
        //假帖子生成
        $this->call(TopicsTableSeeder::class);
        //假回复生成
        $this->call(RepliesTableSeeder::class);
    }
}
