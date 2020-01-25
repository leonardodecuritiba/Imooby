<?php

use Illuminate\Database\Seeder;

class CorrigePhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=CorrigePhotosSeeder
        $caminhos = ['admins', 'clients', 'properties'];
        foreach ($caminhos as $caminho) {
            $path = public_path("uploads" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . $caminho . DIRECTORY_SEPARATOR);
            $scanned_directory = array_diff(scandir($path), array('..', '.'));
            foreach ($scanned_directory as $fileName) {
                echo $fileName . "\n";
                \App\Helpers\ImageHelper::GenerateThumbStatic(['src' => $path, 'filename' => $fileName, 'height' => 200, 'qualidade' => 65]);
                echo "OK\n";
            }
        }
    }
}
