<?php

use Illuminate\Database\Seeder;

class UsersTableSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Администратор',
            'email' => 'admin@app.com',
            'password' => bcrypt('password'),
        ]);
    }
}
