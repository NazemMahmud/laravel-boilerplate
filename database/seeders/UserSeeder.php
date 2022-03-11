<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Traits\DateTimer;

class UserSeeder extends Seeder
{
    use DateTimer;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'Super Admin',
                    'email' => 'superadmin@gmail.com',
                    'password' => bcrypt('qwerty123456'),
                    'created_at' => $this::dateTimeNow(),
                    'updated_at' => $this::dateTimeNow()
                ],
                [
                    'id' => 2,
                    'name' => 'Zahid Hasan',
                    'email' => 'zahid@gmail.com',
                    'password' => bcrypt('qwerty123456'),
                    'created_at' => $this::dateTimeNow(),
                    'updated_at' => $this::dateTimeNow()
                ],
                [
                    'id' => 3,
                    'name' => 'John Doe',
                    'email' => 'john@gmail.com',
                    'password' => bcrypt('123456'),
                    'created_at' => $this::dateTimeNow(),
                    'updated_at' => $this::dateTimeNow(),
                ],
                [
                    'id' => 4,
                    'name' => 'Designer Cartage',
                    'email' => 'des@gmail.com',
                    'password' => bcrypt('123456'),
                    'created_at' => $this::dateTimeNow(),
                    'updated_at' => $this::dateTimeNow()
                ],
            ]);
    }
}

