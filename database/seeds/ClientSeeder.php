<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=ClientSeeder
        $start = microtime(true);
        echo "*** Iniciando os Seeders ClientSeeder ***";
        factory(\App\Models\Client::class, 10)->create();

        echo "\n*** Completo em " . round((microtime(true) - $start), 3) . "s ***";
    }
}
