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
        //
        $data=
        [

            [
                'name' =>'Khoa Bui',
                'email'=>'buidangkhoa29@gmail.com',
                'password'=>bcrypt('12345'),

            ],
            [
                'name' =>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('12345'),
            ]
        ];
        DB::table('users')->insert($data);
    }
}
