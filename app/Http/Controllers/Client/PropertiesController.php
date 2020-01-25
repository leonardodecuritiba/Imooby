<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\PropertiesRequest;
use App\Models\PropertiesPhoto;
use App\Models\Property;
use App\Models\PropertyCover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Jenssegers\Date\Date;
use App\Http\Controllers\Controller;

class PropertiesController extends Controller
{
    private $name = 'Imóveis';
    private $single_name = 'Imóvel';
    private $Page;

    public function __construct()
    {
        $this->Page = (object)[
        'table' => "properties",
        'link' => "properties",
        'Target' => "Imóvel",
        'Targets' => "Imóveis",
        'Titulo' => "Imóvel",
        'tab' => "",
        'Sex' => "M",
        'titulo_primario' => "",
        'titulo_secundario' => "",
        ];
    }

    public function changeStatus($id)
    {
        return Redirect::route($this->Page->link . '.show', $id);
    }

    public function updateCover($pid, $phid)
    {
        $Property = Property::find($pid);
        if($Property->cover)
            $Property->cover->idphoto = $phid;
        else
            $Property->cover = PropertyCover::create(['idproperty' => $pid, 'idphoto' => $phid]);
        $Property->cover->save();

        return Redirect::route('profile.properties');
    }

    public function update(PropertiesRequest $request,$id)
    {
        $data = $request->all();
        $data['idowner'] = Auth::user()->client->id;
        $data['id'] = $id;
        $Property = Property::updateProperty($data);
        if ( $request->hasFile( 'fotos' ) ) {
            $Property->storePhotos( $request->file( 'fotos' ) );
        }
        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'US', ['name' => $this->single_name])]);
        return Redirect::route('property.edit',$Property->id);
    }

    public function store(PropertiesRequest $request)
    {
        $data = $request->all();
        $data['idowner'] = Auth::user()->client->id;
        $Property = Property::store($data);
        if ($request->hasFile('fotos')) {
            $Property->storePhotos($request->file('fotos'));

            PropertyCover::create([
                'idphoto' => PropertiesPhoto::where('idproperty', $Property->id)->first()->idphoto,
                'idproperty' => $Property->id,
            ]);
        }

        session()->forget('mensagem');
        session(['mensagem' => trans('messages.crud.' . $this->Page->Sex . 'SS', ['name' => $this->single_name])]);
        return redirect()->route('scheduler', ['id'=>$Property->id]);
    }

    // Disponibilidade de agendamentos
    public function scheduler($id)
    {
        if (Auth::check()) {
            if ($property = \Auth::user()->client->properties()->where('id', $id)->first()) {
                $schedules = $property->schedules()->where('created_at', '<', Date::now()->format('Y-m-d H:i:s'))->paginate(12);
                return view('site.properties.property_scheduler', compact(['property','schedules']));
            }
        }
        abort(404);
    }

    public function addPropertySchedule(Request $request)
    {
        if (Auth::check()) {
            $this->validate($request, [
                'property_id'=>'required',
                'dates'=>'required',
                'from'=>'required|date_format:H:i',
                'to'=>'required|date_format:H:i|after:from'
            ]);
            if ($property = \Auth::user()->client->properties()->where('id', $request->property_id)->first()) {
                $dates = explode(",", $request->dates);
                foreach($dates as $date) {
                    if ($date = Date::createFromFormat('d/m/Y', $date)) {
                        $property->schedules()->create([
                            'day'=>$date->format('Y-m-d'),
                            'from'=>$request->from,
                            'to'=>$request->to,
                            'period'=>'01:00'
                        ]);
                    }
                }
                return redirect()->back();
            }
        }
        abort(404);
    }

    public function removePropertySchedule($pid, $sid)
    {
        if (Auth::check()) {
            if ($property = \Auth::user()->client->properties()->find($pid)) {
                if ($scheduler = $property->schedules()->find($sid)) {
                    $scheduler->delete();
                    return redirect()->back();
                }
            }
            return redirect()->back()->withErrors(['Horário não encontrada.']);
        }
        return redirect()->back()->withErrors(['Você precisa estar logado.']);
    }

    public function getAvailableTimes($id)
    {
        if (!isset($_GET['date'])) {
            return '<option>Selecione uma data</option>';
        }
        $date = $_GET['date'];
        if ($property = Property::find($id)) {
            $today = Date::now();
            $aschedules = $property->schedules()
            ->where('day', '>=', $today->format('Y-m-d'))
            ->where('day', $date)->get();
            $addedTimes = [];
            $i=0;
            $tday = Date::createFromFormat('H:i:s', $today->format('H:i:s'));
            foreach($aschedules as $aschedule) {
                $i++;
                $from = Date::createFromFormat('Y-m-d H:i:s', $aschedule->day.' '.$aschedule->from);
                $to = Date::createFromFormat('Y-m-d H:i:s', $aschedule->day.' '.$aschedule->to);
                $have_time = true;
                $last_from = $from;
                $x=0;
                while($have_time) {
                    $x++;
                    if ($last_from->gt($to)) {
                        $have_time = false;
                    } else {
                        $date_time = $date.' '.$last_from->format('H:i:s');
                        if ($property->visits()->where('date_time', $date_time)->count()==0) {
                            $ltfromhi = $last_from->format('H:i');
                            if ($last_from->gt($today) && !in_array($ltfromhi, $addedTimes)) {
                                $addedTimes[] = $ltfromhi;
                            }
                        }
                        $last_from = $last_from->addMinutes(30);
                    }
                }
            }
            
            if (!empty($addedTimes)) {
                $result='';
                sort($addedTimes);
                foreach($addedTimes as $time) {
                    $result.='<option value="'.$time.'">'.$time.'</option>';
                }
                return $result;
            }
            
            return '<option>Nenhum horário disponível para essa data</option>';
        }
    }

	public function destroyPhoto( Request $request, $id ) {
//      return $id;
        //remover
	    $PropertiesPhoto = PropertiesPhoto::findOrFail( $id );
	    $PropertiesPhoto->delete();
        return response()->json( [
            'mensagem' => '1',
            'response' => trans( 'messages.crud.' . 'FDS', [ 'name' => 'Imagem' ] )
        ] );
    }

//    public function destroy($id)
//    {
//        $data = Property::findOrFail($id);
//        $data->user->delete();
//        $data->photo->delete();
//        $data->delete();
//        return response()->json(['mensagem' => '1',
//            'response' => trans('messages.crud.' . $this->Page->Sex . 'DS', ['name' => $this->name])]);
//    }

}
