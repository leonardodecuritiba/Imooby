<?php

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
        //php artisan db:seed --class=AdminSeeder
        $start = microtime(true);
        echo "*** Iniciando os Seeders AdminSeeder ***";
        factory(\App\Models\Admin::class, 'leonardo')->create();
        factory(\App\Models\Admin::class, 'luiz')->create();
        echo "\n*** Completo em " . round((microtime(true) - $start), 3) . "s ***";
    }
}
