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

        $this->call(FormTableSeeder::class);
        $this->call(FormColumnTableSeeder::class);
        $this->call(FormColumnPilganTableSeeder::class);
        $this->call(FormContentTableSeeder::class);

        $this->call(seedContohContentForm::class);

        $this->call(seedDashboardElement::class);
    }
}
