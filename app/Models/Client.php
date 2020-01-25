<?php

namespace App\Models;

use App\Helpers\DataHelper;
use App\Helpers\ImageHelper;
use App\Models\Negociations\Negociation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Client extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
        'iduser',
        'idaddress',
        'idcontact',
        'idphoto',
        'name',
        'about',
    ];


    public function activate()
    {
        return $this->user->activate();
    }

    public function disactivate()
    {

        //DESATIVAR IMÓVEIS
//        DataHelper::DEBUGVAR('Client|disactive');
        $idcanceler = $this->id;
        $this->properties->map(function ($item) use ($idcanceler) {
//            DataHelper::DEBUGVAR('property',$item);
            $item->disactivate($idcanceler);
        });
        $this->visits_waiting->map(function ($item) use ($idcanceler) {
//            DataHelper::DEBUGVAR('visit',$item);
            $item->disactivate($idcanceler);
        });
        //DESATIVAR VISITAS EM ABERTO (LOCATÁRIO)
        //DESATIVAR NEGOCIAÇÕES (LOCATÁRIO)
        return $this->user->disactivate();
    }


    public function getStatus()
    {
        return $this->user->status;
    }

    public function getStatusText()
    {
        return ($this->user->status) ? 'Ativo' : 'Inativo';
    }

    public function getStatusColor()
    {
        return ($this->user->status) ? 'success' : 'danger';
    }

    public function getStatusActionText()
    {
        return !($this->user->status) ? 'Ativar' : 'Desativar';
    }

    public function getMyNegociation($idnegociation)
    {
        $Negociation = $this->isMyNegociation($idnegociation);
        return ($Negociation == false) ? abort(403) : $Negociation;
    }

    public function isMyNegociation($idnegociation)
    {
        $Negociation = Negociation::findOrFail($idnegociation);
        if ($this->renter_negociations->where('id', $Negociation->id)->count() > 0) {
            return $Negociation;
        } else if($this->owner_negociations()->where('id', $Negociation->id)->count() > 0){
            return $Negociation;
        }
        return false;
    }

    public function availableNegociations()
    {
        $idproperties = $this->renter_negociations->pluck('idproperty');
        return $this->visits
            ->where('idvisits_status', Visit::STATUS_REALIZED)
            ->whereNotIn('idproperty', $idproperties);
    }

    static public function updateData($data)
    {
        return true;
    }

    public function confirmSchedule($idvisit, $data)
    {
        $Visit = $this->isMySchedule($idvisit);
        if ($Visit != false) {
            return Visit::confirm($idvisit, $data);
        }
        return $Visit;
    }

    public function isMySchedule($idvisit)
    {
        $Visit = Visit::findOrFail($idvisit);
        if ($this->properties->where('id', $Visit->idproperty)->count() > 0) {
            return $Visit;
        }
        return false;
    }

    public function getSchedules()
    {
        $idproperties = $this->properties->pluck('id');
        return Visit::whereIn('idproperty', $idproperties)->get();
    }

    public function getSchedulesPaginated()
    {
        $idproperties = $this->properties->pluck('id');
        return Visit::whereIn('idproperty', $idproperties)->paginate(12);
    }

    public function changePhoto($photo)
    {
        $Photo = $this->photo;
        if ($Photo == NULL) {
            $ImageHelper = new ImageHelper();
            $filename = $ImageHelper->store($photo, 'clients');
            $Photo = Photo::create([
                'link' => $filename,
                'main' => 1
            ]);
            $this->idphoto = $Photo->id;
            $this->save();
        } else {
            $ImageHelper = new ImageHelper();
            $Photo->update([
                'link' => $ImageHelper->update($photo, 'clients', $Photo->link)
            ]);
        }
        return true;
    }

    public function getShortName()
    {
        $name = explode(' ', trim($this->name));
        return $name[0]; // will print Test
    }

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }

    public function getResumedAddress()
    {
        $address = $this->address;
        $retorno[0] = $address->city;
        $retorno[1] = $address->state;
        return $retorno;
    }

    public function getPhoto()
    {
        $photo = $this->photo;
        return ($photo != NULL) ? asset(ImageHelper::PATH_NAME) . '/clients/' . $photo->link : asset('assets_admin/imgs/user.png');
    }

    public function getThumbPhoto()
    {
        $photo = $this->photo;
        return ($photo != NULL) ? asset(ImageHelper::PATH_NAME) . '/clients/thumb_' . $photo->link : asset('assets_admin/imgs/user.png');
    }
	// ******************** SCOPE ******************************

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
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'iduser');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address', 'idaddress');
    }

    public function contact()
    {
        return $this->belongsTo('App\Models\Contact', 'idcontact');
    }

    public function bankData()
    {
        return $this->hasOne(BankData::class);
    }

    public function photo()
    {
        return $this->belongsTo('App\Models\Photo', 'idphoto');
    }

    public function propertiesInfoBox()
    {
        $properties = $this->properties;
        $infoBoxData = [];
        foreach ($properties as $property) {
            $infoBoxData[] = $property->getInfoBoxData();
        }
        return [
            'data' => $properties,
            'infoBoxData' => $infoBoxData,
        ];
    }

    public function favoritesBox()
    {
        if(auth()->guest())
            return null;
        if(!auth()->user()->client)
            return null;

        $favorites = FavoriteProperty::where('idowner', auth()->user()->client->id)->get();
        $properties = [];
        $infoBoxData = [];
        foreach ($favorites as $favorite) {
            $properties[] = $favorite->property;
            $infoBoxData[] = $favorite->property->getInfoBoxData();
        }
        return [
            'data' => $properties,
            'infoBoxData' => $infoBoxData,
        ];
    }

    public function favoritesArray()
    {
        $favorites = [];
        foreach ($this->favorites as $favorite)
            $favorites[] = $favorite->property->id;

        return $favorites;
    }

    public function properties()
    {
        return $this->hasMany('App\Models\Property', 'idowner');
    }

    public function favorites()
    {
        return $this->hasMany('App\Models\FavoriteProperty', 'idowner');
    }

    public function visits()
    {
        return $this->hasMany('App\Models\Visit', 'idvisitor')->orderBy('id')->with(['property', 'property.owner']);
    }

    public function visits_waiting()
    {
        return $this->hasMany('App\Models\Visit', 'idvisitor')->waiting()->orderBy('id');
    }

    public function renter_negociations()
    {
        return $this->hasMany('App\Models\Negociations\Negociation', 'idrenter')->orderBy('id')->with(['property', 'property.owner']);
    }

    public function owner_negociations()
    {
        return Negociation::whereIn('idproperty', $this->properties->pluck('id'))->with(['property', 'property.owner']);
    }

}
