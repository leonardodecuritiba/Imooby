<?php

use Illuminate\Database\Seeder;

class PropertiesPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=PropertiesPhotoSeeder
        $start = microtime(true);
        echo "*** Iniciando os Seeders PropertiesPhoto ***";
        factory(\App\Models\PropertiesPhoto::class, 50)->create();
        echo "\n*** Completo em " . round((microtime(true) - $start), 3) . "s ***";
    }
}
