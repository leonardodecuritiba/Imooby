<?php

use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=PropertySeeder
        $start = microtime(true);
        echo "*** Iniciando os Seeders PropertySeeder ***";
        factory(\App\Models\Property::class, 15)->create();
        foreach (\App\Models\Property::all() as $item) {
            \App\Models\Property::changeStatus($item->id);
        }
        echo "\n*** Completo em " . round((microtime(true) - $start), 3) . "s ***";
    }
}
