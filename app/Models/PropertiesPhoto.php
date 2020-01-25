<?php

namespace App\Models;

use App\Helpers\DataHelper;
use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertiesPhoto extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
        'idphoto',
        'idproperty',
    ];

    public $sizes = [ // Descending
            '357x280'
        ];

	static public function getNumberPhotos( $idproperty ) {
		return self::where( 'idproperty', $idproperty )->count();
	}

	static public function storePhoto( $filename, $idproperty ) {
		$Photo = Photo::create( [ 'link' => $filename ] );

		return parent::create( [
			'idphoto'    => $Photo->id,
			'idproperty' => $idproperty,
		] );
	}

    static public function storeMainPhoto($filename, $idproperty)
    {
        $Photo = Photo::create(['link' => $filename, 'main' => 1]);
        return parent::create([
            'idphoto' => $Photo->id,
            'idproperty' => $idproperty,
        ]);
    }

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }

    public function getPhoto()
    {
        $photo = $this->photo;
        return ($photo != NULL) ? asset(ImageHelper::PATH_NAME) . '/properties/' . $photo->link : asset('admin/imgs/home.png');
    }

    public function getRealPath()
    {
        $photo = $this->photo;
        return ($photo != NULL) ? public_path(ImageHelper::PATH_NAME . '/properties/' . $photo->link) : null;
    }

    public function getThumbPhoto()
    {
        $photo = $this->photo;
        return ($photo != NULL) ? asset(ImageHelper::PATH_NAME) . '/properties/thumb_' . $photo->link : asset('admin/imgs/home.png');
    }

    // ******************** RELASHIONSHIP ******************************
    public function property()
    {
        return $this->belongsTo('App\Models\Property', 'idproperty');
    }

    public function photo()
    {
        return $this->belongsTo('App\Models\Photo', 'idphoto');
    }
}
