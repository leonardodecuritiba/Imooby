<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ScheduleRequest;
use App\Http\Requests\Profile\RescheduleRequest;
use App\Http\Requests\Profile\CancelScheduleRequest;
use App\Models\Visit;
use App\Models\Property;
use App\Notifications\ScheduleNotify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Jenssegers\Date\Date;

class ScheduleController extends Controller
{

    public function create(ScheduleRequest $request)
    {
        // Verifica se a propriedade existe
        if ($property = Property::find($request->get('idproperty'))) {
            $client_id = Auth::user()->client->id;
            // Verifica se a propriedade não pertence ao usuário logado
            if ($property->idowner != $client_id) {
                $date = Date::createFromFormat('d/m/Y', $request->get('date'));
                $time = Date::createFromFormat('H:i', $request->get('time'));
                // Verifica e pega a data requisitada
                foreach($property->schedules()->where('day', $date->format('Y-m-d'))->get() as $schedule) {
                    // Verifica se não há uma visita nesta data-horário
                    if($property->visits()->where('date_time', $date->format('Y-m-d').' '.$time->format('H:i:s'))->count()>0) {
                        return redirect()->back()->withErrors(['Horário selecionado não está disponível.']);
                    }
                    // Verifica se o horário está disponível
                    if ($time->gte($schedule->dateFrom()) && $time->lte($schedule->dateTo())) {
                        $datetime = $date->format('d/m/Y').' '.$time->format('H:i');
                        $datetime = Date::createFromFormat('d/m/Y H:i', $datetime);
                        if ($datetime->lt(Date::now()->addMinutes(15))) {
                            return redirect()->back()->withErrors(['É necessário realizar a solicitação de visita com 15 minutos de antecedência.']);
                        }
                        $visit = $property->visits()->create([
                            'idvisits_status' => Visit::STATUS_WAIT_OWNER_CONFIRMATION,
                            'idvisitor' => $client_id,
                            'date_time' => $datetime->toDateTimeString(),
                            'visitor_message' => $request->visitor_message,
                            'visitor_confirmation' => Date::now()->toDateTimeString()
                            ]);
                        $owner = $visit->property->owner;
                        // mandar email para o proprietário, dizendo que o visitante agendou uma visita
                        $owner->user->notify(new ScheduleNotify([
                            'name' => $owner->name,
                            'subject' => 'Confirme o agendamento da visita de ' . $visit->getPrettyDate(),
                            'message' => 'Você tem uma solicitação de visita em seu imóvel, clique no link abaixo para confirmar.',
                            'link' => route('profile.schedules'),
                            ]));
                        session(['status' => 'Visita agendada com sucesso!']);
                        return Redirect::route('ver-imovel', $property->id);
                    }
                }
                return redirect()->back()->withErrors(['Horário selecionado não está disponível.']);
            } else {
                return redirect()->back()->withErrors(['Você não pode agendar em uma propriedade que pertence a você mesmo.']);
            }
        }
        return redirect()->back()->withErrors(['Propriedade não encontrada.']);
    }

    public function ownerConfirm(Request $request, $idvisit)
    {
        $Visit = Visit::findOrFail($idvisit);
        $Visit->ownerConfirm($request->all());

        //mandar email para o visitante, dizendo que o proprietário confirmou a visita
        $Client = $Visit->visitor;
        $Client->user->notify(new ScheduleNotify([
            'name' => $Client->name,
            'subject' => 'Confirmação da visita de ' . $Visit->getPrettyDate(),
            'message' => 'O proprietário confirmou sua visita, clique no link abaixo para visualizar.',
            'link' => route('profile.schedules'),
            ]));
        session(['status' => 'Visita confirmada com sucesso!']);
        return Redirect::route('profile.schedules');
    }

    public function visitorConfirm(Request $request, $idvisit)
    {
        $Visit = Visit::findOrFail($idvisit);
        $Visit->visitorConfirm($request->all());

        //mandar email para o proprietário, dizendo que o visitante confirmou a visita
        $Client = $Visit->property->owner;
        $Client->user->notify(new ScheduleNotify([
            'name' => $Client->name,
            'subject' => 'Confirmação da visita de ' . $Visit->getPrettyDate(),
            'message' => 'O visitante confirmou sua visita, clique no link abaixo para visualizar.',
            'link' => route('profile.schedules'),
            ]));
        session(['status' => 'Visita confirmada com sucesso!']);
        return Redirect::route('profile.schedules');
    }

    public function cancel(CancelScheduleRequest $request, $idvisit)
    {
        $data = $request->all();
        $data['idcanceler'] = Auth::user()->client->id;
        $data['cancelation_reason'] = $data['message'];
        $Visit = Visit::findOrFail($idvisit);
        $Visit->cancel($data);

        //mandar email para a outra parte, dizendo que a outra parte cancelou a visita
        if ($Visit->idcanceler == $Visit->idvisitor) {
            $Client = $Visit->property->owner;
            $Client->user->notify(new ScheduleNotify([
                'name' => $Client->name,
                'subject' => 'Atenção: A visita de ' . $Visit->getPrettyDate() . ' foi cancelada!',
                'message' => 'Infelizmente essa visita precisou ser cancelada, clique no link abaixo para visualizar.',
                'link' => route('profile.schedules'),
                ]));
        } else {
            $Client = $Visit->visitor;
            $Client->user->notify(new ScheduleNotify([
                'name' => $Client->name,
                'subject' => 'Atenção: A visita de ' . $Visit->getPrettyDate() . 'foi cancelada!',
                'message' => 'Infelizmente essa visita precisou ser cancelada. Vamos remarcar?',
                'link' => route('profile.schedules'),
                ]));
        }
        session(['status' => 'Visita cancelada com sucesso!']);
        return Redirect::route('profile.schedules');
    }

    public function refresh(RescheduleRequest $request)
    {
        $client = Auth::user()->client;
        $data = [];
        $visit = Visit::findOrFail($idvisit);
        if(!$visit->idvisitor == $client->id) {
            if (!$visit->property->owner == $client->id) {
                abort(403);
            }
        }
        $day = Date::createFromFormat($request->date);
        $time = Date::createFromFormat($request->time);
        $data['date_time'] = $day->format('d/m/Y').' '.$time->format('H:i');
        $data['message'] = $request->message;
        $data['idcanceler'] = Auth::user()->client->id;
        $data['cancelation_reason'] = NULL;
        $visit->renew($data);
        //mandar email para a outra parte, dizendo que a outra parte reagendou a visita
        if ($visit->idcanceler == $visit->idvisitor) {
            $Client = $visit->property->owner;
            $Client->user->notify(new ScheduleNotify([
                'name' => $Client->name,
                'subject' => 'A visita foi reagendada para ' . $visit->getPrettyDate(),
                'message' => 'Você recebeu uma solicitação de reagendamento, clique aqui no link abaixo para confirmar ou remarcar.',
                'link' => route('profile.schedules'),
                ]));
        } else {
            $Client = $visit->visitor;
            $Client->user->notify(new ScheduleNotify([
                'name' => $Client->name,
                'subject' => 'A visita foi reagendada para ' . $visit->getPrettyDate(),
                'message' => 'Sua visita foi reagendada pelo proprietário do imóvel, clique aqui no link abaixo para confirmar ou remarcar.',
                'link' => route('profile.schedules'),
                ]));
        }
        session(['status' => 'Visita reagendada com sucesso!']);
        return Redirect::route('profile.schedules');
    }

}
