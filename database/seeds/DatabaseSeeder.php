<?php

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
        $this->call(tableRole::class);
        $this->call(tableUser::class);

        $this->call(tableMaintainerRoles::class);
    }
}
