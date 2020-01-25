<?php

namespace App\Observers;

use App\Models\PropertiesPhoto;

class PropertiesPhotoObserver {
	/**
	 * Listen to the PropertiesPhoto deleting event.
	 *
	 * @param  PropertiesPhoto $pf
	 *
	 * @return void
	 */
	public function deleting( PropertiesPhoto $pf ) {
		//ao remover, remover photo
		$pf->photo->delete();
	}
}