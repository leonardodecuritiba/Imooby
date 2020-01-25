<?php

namespace App\Models;

use App\Helpers\DataHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use SoftDeletes;
    const STATUS_WAIT_OWNER_CONFIRMATION = 1; //amarelo
    const STATUS_WAIT_VISITOR_CONFIRMATION = 2; //azul
    const STATUS_CONFIRMED = 3; //azul
    const STATUS_CANCELED = 4; //vermelho
    const STATUS_RESCHEDULED = 5; //vermelho
    const STATUS_EXPIRED = 6; //vermelho
    const STATUS_REALIZED = 7; //verde
    public $timestamps = true;
    protected $fillable = [
        'idparent',
        'idvisits_status',
        'idvisitor',
        'visitor_message',
        'visitor_confirmation',
        'idproperty',
        'visited_message',
        'visited_confirmation',

        'idcanceler',
        'date_time',
        'cancelation_reason',
        'cancelation',
    ];

    public function checkStatus()
    {
        $status = $this->idvisits_status;
        $date_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->date_time);
        if ($status == self::STATUS_WAIT_OWNER_CONFIRMATION || $status == self::STATUS_WAIT_VISITOR_CONFIRMATION) {
            if(Carbon::now()->gte($date_time)) {
                $this->expire();
            }
        } else {
            if ($status == self::STATUS_CONFIRMED) {
                if(Carbon::now()->gte($date_time)) {
                    $this->realize();
                }
            }
        }
    }

    // ******************** VISITS FUNCTIONS ******************************
    public function disactivate($idcanceler)
    {
        //DESATIVAR VISITA
        return $this->cancel([
            'idcanceler' => $idcanceler,
            'cancelation_reason' => 'Imóvel Desativado',
        ]);


        DataHelper::DEBUGVAR('Visit|disactive(' . $idcanceler . ')');
        DataHelper::DEBUGVAR("this->cancel([
            'idcanceler'            => " . $idcanceler . ",
            'cancelation_reason'    => 'Imóvel Desativado',
        ])");
        return;
    }

    static public function schedule($data)
    {
        return self::create([
            'idvisits_status' => self::STATUS_WAIT_OWNER_CONFIRMATION,
            'idvisitor' => $data['idvisitor'],
            'idproperty' => $data['idproperty'],
            'date_time' => Carbon::createFromFormat('d/m/Y H:i', $data['date_time'])->toDateTimeString(),
            'visitor_message' => $data['visitor_message'],
            'visitor_confirmation' => Carbon::now()->toDateTimeString(),
        ]);
    }

    static public function getWaitingOwnerConfirmation()
    {
        return self::where('idvisits_status', self::STATUS_WAIT_OWNER_CONFIRMATION)->get();
    }

    static public function getConfirmedStatus()
    {
        return self::where('idvisits_status', self::STATUS_CONFIRMED)->get();
    }

    public function getPrettyDate()
    {
        return DataHelper::getPrettyDateFormated($this->attributes['date_time']);
    }

    public function isConfirmedByClient($op)
    {
        return ($this->attributes[$op] != NULL);
    }

    public function ownerConfirm($data)
    {
        return $this->update([
            'idvisits_status' => self::STATUS_CONFIRMED,
            'visited_message' => $data['message'],
            'visited_confirmation' => Carbon::now()->toDateTimeString(),
        ]);
    }

    public function visitorConfirm($data)
    {
        return $this->update([
            'idvisits_status' => self::STATUS_CONFIRMED,
            'visitor_message' => $data['message'],
            'visitor_confirmation' => Carbon::now()->toDateTimeString(),
        ]);
    }

    public function cancel($data)
    {
        return $this->update([
            'idvisits_status' => self::STATUS_CANCELED,
            'idcanceler' => $data['idcanceler'],
            'cancelation_reason' => $data['cancelation_reason'],
            'cancelation' => Carbon::now()->toDateTimeString(),
        ]);
    }

    public function renew($data)
    {
        //INQUILINO É O CANCELADOR
        if ($this->attributes['idvisitor'] == $data['idcanceler']) {
            $novo = self::create([
                'idparent' => $this->id,
                'idvisits_status' => self::STATUS_WAIT_OWNER_CONFIRMATION,
                'idvisitor' => $this->attributes['idvisitor'],
                'idproperty' => $this->attributes['idproperty'],
                'date_time' => Carbon::createFromFormat('d/m/Y H:i', $data['date_time'])->toDateTimeString(),
                'visitor_message' => $data['message'],
                'visitor_confirmation' => Carbon::now()->toDateTimeString(),
            ]);
        } else {
            $novo = self::create([
                'idparent' => $this->id,
                'idvisits_status' => self::STATUS_WAIT_VISITOR_CONFIRMATION,
                'idvisitor' => $this->attributes['idvisitor'],
                'idproperty' => $this->attributes['idproperty'],
                'date_time' => Carbon::createFromFormat('d/m/Y H:i', $data['date_time'])->toDateTimeString(),
                'visited_message' => $data['message'],
                'visited_confirmation' => Carbon::now()->toDateTimeString(),
            ]);
        }
        $this->reschedule($data);
        return $novo;
    }

    public function reschedule($data)
    {
        return $this->update([
            'idvisits_status' => self::STATUS_RESCHEDULED,
            'idcanceler' => $data['idcanceler'],
            'cancelation_reason' => 'Visita Reagendada',
            'cancelation' => Carbon::now()->toDateTimeString(),
        ]);
    }

    public function isOpened()
    {
        return (($this->attributes['idvisits_status'] != self::STATUS_CANCELED) &&
            ($this->attributes['idvisits_status'] != self::STATUS_EXPIRED) &&
            ($this->attributes['idvisits_status'] != self::STATUS_RESCHEDULED) &&
            ($this->attributes['idvisits_status'] != self::STATUS_REALIZED));
    }

    public function isConfirmed()
    {
        return ($this->attributes['idvisits_status'] == self::STATUS_CONFIRMED);
    }

    public function getStatusColor()
    {
        switch ($this->attributes['idvisits_status']) {
            case self::STATUS_WAIT_OWNER_CONFIRMATION:
                return 'warning';
                break;
            case self::STATUS_WAIT_VISITOR_CONFIRMATION:
                return 'warning';
                break;
            case self::STATUS_CONFIRMED:
                return 'primary';
                break;
            case self::STATUS_CANCELED:
                return 'danger';
                break;
            case self::STATUS_RESCHEDULED:
                return 'danger';
                break;
            case self::STATUS_EXPIRED:
                return 'danger';
                break;
            case self::STATUS_REALIZED:
                return 'success';
                break;
        }
    }

    public function getStatusIcon()
    {
        switch ($this->attributes['idvisits_status']) {
            case self::STATUS_WAIT_OWNER_CONFIRMATION:
                return 'clock-o';
                break;
            case self::STATUS_WAIT_VISITOR_CONFIRMATION:
                return 'clock-o';
                break;
            case self::STATUS_CONFIRMED:
                return 'check';
                break;
            case self::STATUS_CANCELED:
                return 'times';
                break;
            case self::STATUS_RESCHEDULED:
                return 'times';
                break;
            case self::STATUS_EXPIRED:
                return 'times';
                break;
            case self::STATUS_REALIZED:
                return 'check';
                break;
        }
    }

    public function getStatusText()
    {
        return $this->visits_status->description;
    }

    public function getDateHour()
    {
        return DataHelper::getPrettyDateTime($this->attributes['date_time']);
    }


    // ******************** SCHEDULE JOBS ******************************

    static public function verifyVisits()
    {
        // Verify waiting confirmation visits
        foreach (self::waiting()->get() as $visit) {
            if ($visit->verifyDateTime()) {
                echo 'expire '.$visit->id."<br>";
                $visit->expire();
            }
        }
        // Verify confirmed visits
        foreach (self::confirmed()->get() as $visit) {
            if ($visit->verifyDateTime()) {
                echo 'realize '.$visit->id."<br>";
                $visit->realize();
            }
        }
    }

    public function verifyDateTime()
    {
        $now = Carbon::now();
        $date_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->getAttribute('date_time'));
        return ($now > $date_time);
    }

    public function expire()
    {
        return $this->update([
            'idvisits_status' => self::STATUS_EXPIRED
        ]);
    }

    public function realize()
    {
        return $this->update([
            'idvisits_status' => self::STATUS_REALIZED
        ]);
    }

    // ******************** /SCHEDULE JOBS ******************************



    public function getStatus()
    {
        return $this->visits_status->description;
    }

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }

    // ******************** RELASHIONSHIP ******************************
    public function visits_status()
    {
        return $this->belongsTo('App\Models\VisitsStatus', 'idvisits_status');
    }

    public function visitor()
    {
        return $this->belongsTo('App\Models\Client', 'idvisitor');
    }

    public function property()
    {
        return $this->belongsTo('App\Models\Property', 'idproperty');
    }

    public function canceler()
    {
        return $this->belongsTo('App\Models\Client', 'idcanceler');
    }
    // ******************** SCOPE ******************************
    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeConfirmed($query)
    {
        return $query->where('idvisits_status', self::STATUS_CONFIRMED);
    }
    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWaiting($query)
    {
        return $query->whereBetween('idvisits_status', [self::STATUS_WAIT_OWNER_CONFIRMATION, self::STATUS_WAIT_VISITOR_CONFIRMATION]);
    }

}

//    public function getStatusType()
//    {
//        $status = $this->getAttribute('idvisits_status');
//        if ($status == 1) {
//            return 'default';
//        } else if ($status == 2) {
//            return 'warning';
//        } else if ($status < 5) {
//            return 'danger';
//        } else {
//            return 'success';
//        }
//    }