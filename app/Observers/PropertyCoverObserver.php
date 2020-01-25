<?php

namespace App\Observers;

use App\Models\PropertyCover;

class PropertyCoverObserver {
	/**
	 * Listen to the PropertyCover deleting event.
	 *
	 * @param  PropertyCover $pc
	 *
	 * @return void
	 */
	public function deleting( PropertyCover $pc ) {
		//ao remover, remover propertiesPhoto da photo
		$pc->photo->property->delete();
	}
}