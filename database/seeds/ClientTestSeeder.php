<?php

use Illuminate\Database\Seeder;

class ClientTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=ClientTestSeeder
        $start = microtime(true);
        echo "*** Iniciando os Seeders ClientTestSeeder ***";
        factory(\App\Models\Client::class, 'leonardo')->create();
        factory(\App\Models\Client::class, 'leonardo2')->create();
        factory(\App\Models\Client::class, 'luiz')->create();
        echo "\n*** Completo em " . round((microtime(true) - $start), 3) . "s ***";
    }
}
