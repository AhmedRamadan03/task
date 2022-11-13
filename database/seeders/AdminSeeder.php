<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $data = [
                'username' => 'admin',
                'is_admin' => '1',
                'password' => bcrypt(12345678),
            ];
            User::updateOrCreate($data);
        } catch (\Exception $th) {
            //throw $th;
        }
    }
}
