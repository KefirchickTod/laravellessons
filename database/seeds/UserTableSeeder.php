<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'     => 'Super admin',
                'email'    => 'root@root.com',
                'password' => Hash::make('root'),
            ],
            [
                'name'     => 'No user',
                'email'    => 'author_notfound@g.g',
                'password' => bcrypt(Str::random(16)),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
