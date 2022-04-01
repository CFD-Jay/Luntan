<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

//填充用户数据
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     
     //注意都要在DatabaseSeeder.php注册
    public function run()
    {
        //User->factory()对应文件UserFactory.php
        User::factory()->count(10)->create();
        
        
         // 单独处理第一个用户的数据
        $user = User::find(9);
        $user->name = 'Summer';
        $user->email = 'summer@example.com';
        $user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png';
        $user->save();
    }
}
