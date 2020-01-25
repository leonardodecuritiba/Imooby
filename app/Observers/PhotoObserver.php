<?php

namespace App\Observers;

use App\Helpers\ImageHelper;
use App\Models\Photo;

class PhotoObserver {
	/**
	 * Listen to the PropertiesPhoto deleting event.
	 *
	 * @param  Photo $ph
	 *
	 * @return void
	 */
	public function deleting( Photo $ph ) {
		//ao remover, remover arquivos
		$ImageHelper = new ImageHelper();
		$ImageHelper->remove( $ph->link, 'properties' );
	}
}