<?php

namespace App\Models;

use App\Helpers\DataHelper;
use App\Helpers\ImageHelper;
use App\Models\Negociations\Negociation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Jobs\ProcessPropertyPhotos;

class Property extends Model
{
    use SoftDeletes;
    const ON_FIELDS = [
        'reception',
        'air_conditioning',
        'outdoor_pool',
        'garden',
        'fireplace',
        'animals',
        'playground',
        'hydro',
        'grill',
        'laundry',
        'furnished',
        'suite'
    ];
    public $timestamps = true;
    protected $fillable = [
        'idowner',
        'idproperties_type',
        'idaddress',
        'title',
        'description',
        'price_rental',
        'price_condominium',
        'price_iptu',
        'price_fee',
        'price_total',
        'bedroom_n',
        'bathroom_n',
        'internal_area',
        'external_area',
        'garage_n',
        'reception',
        'air_conditioning',
        'outdoor_pool',
        'garden',
        'fireplace',
        'animals',
        'playground',
        'hydro',
        'grill',
        'laundry',
        'furnished',
        'suite',
        'status',
        'validated_at',
    ];


	public function getPropertyTypeText() {
		return $this->properties_type->description;
	}

    static public function isActive($id)
    {
        $Data = self::findOrFail($id);
        return $Data->status;
    }

    static public function activate($id)
    {
        $Data = self::findOrFail($id);
        if ($Data->owner->getStatus()) {
            $Data->update([
                'validated_at' => Carbon::now()->toDateTimeString(),
                'status' => 1
            ]);
            return true;
        }
        return false;
    }

    public function disactivate($idcanceler = NULL)
    {
        //DESATIVAR IMÓVEL
//        DataHelper::DEBUGVAR('Property|disactive(' . $idcanceler . ')');
//        DataHelper::DEBUGVAR("this->update(['status' => 0])");

        //DESATIVAR VISITAS EM ABERTO AO IMÓVEL
        $this->visits_waiting->map(function ($item) use ($idcanceler) {
//            DataHelper::DEBUGVAR('visit->disactive(' . $idcanceler . ')',$item);
            $item->disactivate($idcanceler);
        });

        //CANCELANDO NEGOCIAÇÕES RELACIONADAS AO IMÓVEL
        $this->negociations->map(function ($item) {
//            DataHelper::DEBUGVAR('negociation->cancel()',$item);
            $item->cancel();
        });

        return $this->update([
            'validated_at' => NULL,
            'status' => 0
        ]);
    }

    public function countFavorites()
    {
        return FavoriteProperty::where('idproperty', $this->id)->count();
    }

    public function getInfoBoxData()
    {
        $address = $this->address;
        return ([
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'thumb_main_photo' => $this->getThumbMainPhoto(),
            'main_photo' => $this->getMainPhoto(),
            'type' => $this->getType(),
            'idproperties_type' => $this->idproperties_type,
            'price_total' => $this->price_total,
            'price_total_money' => $this->priceTotalReal(),
            'address' => $address->getFullStreet(),
            'full_address' => $address->getFullAddress(),
            'bedrooms' => $this->bedroom_n,
            'bathrooms' => $this->bathroom_n,
            'garages' => $this->garage_n,
            'internal_area' => $this->internal_area,
            'internal_area_formated' => $this->getInternalArea(),
            'favorites' => $this->countFavorites(),
            'position' => [
                'lat' => $address->lat,
                'lng' => $address->lng
            ],
            'props'=>[
                'reception'=>$this->reception,
                'air_conditioning'=>$this->air_conditioning,
                'outdoor_pool'=>$this->outdoor_pool,
                'garden'=>$this->garden,
                'fireplace'=>$this->fireplace,
                'animals'=>$this->animals,
                'playground'=>$this->playground,
                'hydro'=>$this->hydro,
                'grill'=>$this->grill,
                'laundry'=>$this->laundry,
                'furnished'=>$this->furnished,
                'suite'=>$this->suite
            ],
            'markerIcon' => 'marker-blue.png',
        ]);
    }

    static public function getFilters($Properties){
        if($Properties->count()>0){
            $Filters = [
                'rental'        => ['min' => $Properties->min('price_total'), 'max' => $Properties->max('price_total')],
                'bedroom'       => ['min' => $Properties->min('bedrooms'), 'max' => $Properties->max('bedrooms')],
                'bathroom'      => ['min' => $Properties->min('bathrooms'), 'max' => $Properties->max('bathrooms')],
                'garage'      => ['min' => $Properties->min('garages'), 'max' => $Properties->max('garages')],
                'internal_area' => ['min' => $Properties->min('internal_area'), 'max' => $Properties->max('internal_area')],
                'type'          => [PropertiesType::whereIn('id',$Properties->pluck('idproperties_type'))->get()],
            ];
        } else {
            $Filters = NULL;
        }
        return $Filters;
    }

    static public function getByBounds($data)
    {
        $ref = [
            'min_lat' => $data['sw'][0],
            'max_lat' => $data['ne'][0],
            'min_lng' => $data['sw'][1],
            'max_lng' => $data['ne'][1],
        ];

        $idaddresses = Address::
            whereBetween('lat', [$ref['min_lat'], $ref['max_lat']])
            ->whereBetween('lng', [$ref['min_lng'], $ref['max_lng']])
            ->pluck('id');

        $Properties = self::active()
            ->whereIn('idaddress', $idaddresses)
            ->get()
            ->map(function ($property) {
                //total, pago, pendente, vencimento
                return $property->getInfoBoxData();
            });

        return [
            'Properties' => $Properties,
            'PropertiesFilters' => self::getFilters($Properties)
        ];
    }

    static public function getByLocation($data)
    {
        if(isset($data['bounds'])){
            $bounds = $data['bounds'];
        } else {
            $bounds = 0.02;
        }

        $ref = [
            'min_lat' => $data['lat'] - $bounds,
            'max_lat' => $data['lat'] + $bounds,
            'min_lng' => $data['lng'] - $bounds,
            'max_lng' => $data['lng'] + $bounds,
        ];

        $idaddresses = Address::
            whereBetween('lat', [$ref['min_lat'], $ref['max_lat']])
            ->whereBetween('lng', [$ref['min_lng'], $ref['max_lng']])
            ->pluck('id');

        $Properties = self::active()
            ->whereIn('idaddress', $idaddresses)
            ->get()
            ->map(function ($property) {
            //total, pago, pendente, vencimento
            return $property->getInfoBoxData();
        });

        return [
            'Properties' => $Properties,
            'PropertiesFilters' => self::getFilters($Properties)
        ];
    }

    static public function updateProperty($data)
    {
        $Property = self::findOrFail($data['id']);
        $total = $data['price_rental'] + $data['price_condominium'] + $data['price_iptu'];
        $data['price_fee'] = Config::getByMetaKey('rental_fee')->meta_value * $total;
        $data['price_total'] = $data['price_fee'] + $total;
        $Property->update($data);
        $Property->address->update($data);
        return $Property;
    }

    static public function store($data)
    {
        $total = $data['price_rental'] + $data['price_condominium'] + $data['price_iptu'];
        $data['price_fee'] = Config::getByMetaKey('rental_fee')->meta_value * $total;
        $data['price_total'] = $data['price_fee'] + $total;
        $Address = Address::create($data);
        $data['idaddress'] = $Address->id;
        return self::create($data);
    }

    static public function getValid($id)
    {
        $Property = self::active()
            ->where('id', $id)
            ->first();
        return ($Property == NULL) ? abort(404) : $Property;
    }

    static public function myProperty($id,$idowner)
    {
        $Property = self::where('id', $id)
            ->where('idowner', $idowner)
            ->first();
        return ($Property == NULL) ? abort(404) : $Property;
    }

    public function getThumbMainPhoto()
    {
        $photo = $this->main_photo();
        if($photo != NULL)
            return asset(ImageHelper::PATH_NAME) . '/properties/' . $photo->filename().'_357x280.jpg';
        else if( count($this->properties_photo) > 0 )
            return asset(ImageHelper::PATH_NAME) . '/properties/' . $this->properties_photo[0]->photo->filename().'_357x280.jpg';

        return asset('assets_admin/imgs/home.png');
    }

    // public function getThumbMainPhoto()
    // {
    //     $photo = $this->main_photo();
    //     if($photo != NULL)
    //         return asset(ImageHelper::PATH_NAME) . '/properties/thumb_' . $photo->link;
    //     else if( count($this->properties_photo) > 0 )
    //         return asset(ImageHelper::PATH_NAME) . '/properties/thumb_' . $this->properties_photo[0]->photo->link;

    //     return asset('assets_admin/imgs/home.png');
    // }

    public function main_photo()
    {
        if($this->cover)
            return $this->cover->photo;
        return NULL;
    }

    public function getType()
    {
        return $this->properties_type->description;
    }

	public function getShortDescription() {
		$sz = 60;
		$fd = $this->attributes['description'];

		return ( strlen( $fd ) > $sz ) ? substr( $fd, 0, $sz ) . "..." : $fd;  // retorna "abcde"
	}

	public function getShortTitle() {
		$sz = 20;
		$fd = $this->attributes['title'];

		return ( strlen( $fd ) > $sz ) ? substr( $fd, 0, $sz ) . "..." : $fd;  // retorna "abcde"
	}
    public function getInternalArea()
    {
        return DataHelper::getFloat2Formated($this->attributes['internal_area']) . ' m²';
    }

    public function storePhotos($files)
    {
        $ImageHelper = new ImageHelper();
        foreach ($files as $key => $file) {
            $filename = $ImageHelper->store($file, 'properties');
            if ($key == 0) {
                PropertiesPhoto::storePhoto($filename, $this->id);
            } else {
                PropertiesPhoto::storeMainPhoto($filename, $this->id);
            }
        }
        dispatch(new ProcessPropertyPhotos($this->id));
    }

    public function getSimilar($n = 6)
    {
        $address = $this->address;
        $bounds = 0.05;
        $ref = [
            'min_lat' => $address->lat - $bounds,
            'max_lat' => $address->lat + $bounds,
            'min_lng' => $address->lng - $bounds,
            'max_lng' => $address->lng + $bounds,
        ];

        $idaddresses = Address::where('lat', '>=', $ref['min_lat'])->where('lat', '<=', $ref['max_lat'])
            ->where('lng', '>=', $ref['min_lng'])->where('lng', '<=', $ref['max_lng'])->pluck('id');

        $Properties = self::active()
            ->others()
            ->whereIn('idaddress', $idaddresses)
            ->take($n);

        $infoBoxData = NULL;
        foreach ($Properties->get() as $property) {
            $infoBoxData[] = $property->getInfoBoxData();
        }
        return [
            'query' => $Properties,
            'infoBoxData' => $infoBoxData,
        ];
    }

    public function haveSchedules()
    {
        if($this->schedules()->where('day', '>=', DataHelper::today()->format('Y-m-d'))->count()>0) {
            return true;
        }
        return false;
    }

    public function getExternalArea()
    {
        return DataHelper::getFloat2Formated($this->attributes['external_area']) . ' m²';
    }

    public function externalAreaFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('external_area'));
    }

    public function setExternalAreaAttribute($value)
    {
        $this->attributes['external_area'] = DataHelper::getReal2Float($value);
    }

    public function internalAreaFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('internal_area'));
    }

    public function setInternalAreaAttribute($value)
    {
        $this->attributes['internal_area'] = DataHelper::getReal2Float($value);
    }

    public function priceRentalReal()
    {
        return DataHelper::getFloat2Real($this->getAttribute('price_rental'));
    }

    public function priceRentalTotalReal()
    {
        return DataHelper::getFloat2Real($this->getAttribute('price_rental') + $this->getAttribute('price_fee'));
    }

    public function priceFeeReal()
    {
        return DataHelper::getFloat2Real($this->getAttribute('price_fee'));
    }

    public function priceCondominiumReal()
    {
        return DataHelper::getFloat2Real($this->getAttribute('price_condominium'));
    }

    public function priceIptuReal()
    {
        return DataHelper::getFloat2Real($this->getAttribute('price_iptu'));
    }

    public function priceTotalReal()
    {
        return DataHelper::getFloat2Real($this->getAttribute('price_total'));
    }

    public function priceRentalFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('price_rental'));
    }

    public function priceRentalTotalFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('price_rental') + $this->getAttribute('price_fee'));
    }

    public function priceCondominiumFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('price_condominium'));
    }

    public function priceIptuFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('price_iptu'));
    }

    public function priceTotalFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('price_total'));
    }

    public function priceFeeFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('price_fee'));
    }

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }

    public function getStatusText()
    {
        return ($this->attributes['status']) ? 'Aprovado' : 'Não Aprovado';
    }

    public function getStatusColor()
    {
        return ($this->attributes['status']) ? 'success' : 'danger';
    }

    public function getStatusActionText()
    {
        return !($this->attributes['status']) ? 'Aprovar' : 'Não Aprovar';
    }

    public function getMainPhoto()
    {
        $photo = $this->main_photo();
        return ($photo != NULL) ? asset(ImageHelper::PATH_NAME) . '/properties/thumb_' . $photo->link : asset('admin/imgs/home.png');
    }

    // Scheduler
    public function getJsDaysForSchedule()
    {
        $aschedules = $this->schedules()->where('day', '>=', DataHelper::today()->format('m-d-Y'))->get();
        $result = '';
        foreach ($aschedules as $aschedule) {
            $date = explode("-", $aschedule->day);
            $result.='"'.$date[0].'-'.trim($date[1], "0").'-'.trim($date[2], "0").'",';
        }
        return trim($result, ",");
    }

    // ******************** SCOPE ******************************

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOthers($query)
    {
        return $query->where('id', '<>', $this->id);
    }

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope a query to only include news users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNews($query, $n)
    {
        return $query->active()
            ->orderBy('validated_at', 'desc')
            ->take($n)
            ->get();
    }

	/**
	 * Scope a query to ordered by created_at.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeOrdered( $query ) {
		return $query->orderBy( 'created_at', 'desc' );
	}

    // ******************** RELASHIONSHIP ******************************

    public function owner()
    {
        return $this->belongsTo('App\Models\Client', 'idowner');
    }

    public function properties_type()
    {
        return $this->belongsTo('App\Models\PropertiesType', 'idproperties_type');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address', 'idaddress');
    }

    public function properties_photo()
    {
        return $this->hasMany('App\Models\PropertiesPhoto', 'idproperty');
    }

    public function cover()
    {
        return $this->hasOne('App\Models\PropertyCover', 'idproperty');
    }

    public function visits_waiting()
    {
        return $this->hasMany('App\Models\Visit', 'idproperty')->waiting();
    }

    public function visits()
    {
        return $this->hasMany('App\Models\Visit', 'idproperty');
    }

    public function negociations()
    {
        return $this->hasMany('App\Models\Negociations\Negociation', 'idproperty');
    }

    public function schedules()
    {
        return $this->hasMany(PropertySchedule::class);
    }

	public function favorites() {
		return $this->hasMany( 'App\Models\FavoriteProperty', 'idproperty');
	}

}




