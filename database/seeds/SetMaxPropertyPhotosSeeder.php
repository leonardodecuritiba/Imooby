<?php

use Illuminate\Database\Seeder;

class SetMaxPropertyPhotosSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//php artisan db:seed --class=SetMaxPropertyPhotosSeeder
		$start = microtime( true );
		echo "*** Iniciando os Seeders SetMaxPropertyPhotosSeeder ***";
		$configs = array(
			array(
				'name'       => 'Número Máximo de Fotos',
				'meta_key'   => 'properties_photo_max',
				'meta_value' => '25',
			),
			array(
				'name'       => 'Tamanho Máximo da Foto (MB)',
				'meta_key'   => 'properties_photo_mb',
				'meta_value' => '7',
			),
		);
		foreach ( $configs as $config ) {
			\App\Models\Config::create( $config );
		}
		echo "\n*** Completo em " . round( ( microtime( true ) - $start ), 3 ) . "s ***";

	}
}
