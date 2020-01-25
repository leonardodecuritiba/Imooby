<?php

namespace App\Models\Negociations;

use App\Helpers\DataHelper;
use App\Helpers\NegociationNotifyHelper;
use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\JsonResponse;
use App\Library\D4Sign\Signer;

class Negociation extends Model
{
    use SoftDeletes;

//    const STATUS_OPPENED                        = 1; //azul //'Negociação Aberta',
    const STATUS_WAIT_RENTER_CONDITION_ACCEPT = 1; //amarelo //'Aguardando Aceite de Condições do Inquilino',
    const STATUS_WAIT_RENTER_PROPOSE = 2; //amarelo //'Aguardando Envio da Proposta do Inquilino',
    const STATUS_WAIT_OWNER_PROPOSE_ACCEPT              = 3; //amarelo //'Aguardando Aceite da Proposta pelo Proprietário',
    const STATUS_WAIT_OWNER_CONDITION_ACCEPT            = 4; //amarelo //'Aguardando Aceite de Condições do Proprietário',
    const STATUS_PROPOSED_REJECTED                      = 5; //vermelho //'Proposta Rejeitada',
    const STATUS_WAIT_DOCUMENTATION                     = 6; //amarelo //'Aguardando Documentação',
    const STATUS_WAIT_RENTER_DOCUMENTATION = 7; //amarelo //'Aguardando Envio da Documentação do Inquilino',
    const STATUS_WAIT_OWNER_DOCUMENTATION               = 8; //amarelo //'Aguardando Envio da Documentação do Proprietário',
    const STATUS_WAIT_ADMIN_DOCUMENTATION_ACCEPT        = 9; //amarelo //'Aguardando Aceite da Documentação pelo Admin',
    const STATUS_WAIT_ADMIN_RENTER_DOCUMENTATION_ACCEPT = 10; //amarelo //'Aguardando Aceite Documentação do Inquilino pelo Admin',
    const STATUS_WAIT_ADMIN_OWNER_DOCUMENTATION_ACCEPT  = 11; //amarelo //'Aguardando Aceite Documentação do Proprietário pelo Admin',
    const STATUS_WAIT_DIGITAL_SIGNATURE                    = 12; //amarelo //'Aguardando Assinatura Digital',

    const STATUS_WAIT_RENTER_DIGITAL_SIGNATURE             = 13; //amarelo //'Aguardando Assinatura do Proprietário',
    const STATUS_WAIT_OWNER_DIGITAL_SIGNATURE = 14; //amarelo //'Aguardando Assinatura do Inquilino',
    const STATUS_REALIZED                               = 15; //verde 'Negociação Realizada',,
    const STATUS_CANCELED                               = 16; //vermelho 'Negociação Cancelada'
    public $timestamps = true;
    protected $fillable = [
        'idstatus_negociation',
        'idrenter',
        'idproperty',
        'rental',
        'fee',
        'condominium',
        'iptu',
        'income_proof',
        'residents',
        'date_change',
        'animals',
        'renter_conditions',
        'owner_accept_conditions',
        'renter_accept_conditions',
        'signature_document_uuid'
    ];

    // ******************** FUNCTIONS ******************************

    // ******************** FLUX FUNCTIONS *************************
    public function __construct()
    {
        $this->verifySignature();
    }

    static public function open($data)
    {
        $Property = Property::findOrFail($data['idproperty']);

        //Criar Negociação
        $negotiation = new Negociation;
        $negotiation->idstatus_negociation = self::STATUS_WAIT_RENTER_CONDITION_ACCEPT;
        $negotiation->idrenter = $data['idrenter'];
        $negotiation->idproperty = $Property->id;
        $negotiation->rental = $Property->price_rental;
        $negotiation->fee = $Property->price_fee;
        $negotiation->condominium = $Property->price_condominium;
        $negotiation->iptu = $Property->price_iptu;
        $negotiation->save();
        //Notification
        $NegociationNotifyHelper = new NegociationNotifyHelper($negotiation);
        $NegociationNotifyHelper->openNegociationNotify();

        return $negotiation;

    }

    public function whois($idclient)
    {
        if($this->attributes['idrenter'] == $idclient){
            $retorno = 'renter';
        } else if($this->property->owner->id == $idclient){
            $retorno = 'owner';
        } else {
            $retorno = false;
        }
        return ($retorno == false) ? abort(403) : $retorno;
    }

    public function getCurrentStep(){
        switch($this->getAttributeValue('idstatus_negociation')){
            case self::STATUS_WAIT_RENTER_CONDITION_ACCEPT : {
                $step = 0;
                $renter = 0;
                $owner = 0;
                break;
            }
            case self::STATUS_WAIT_RENTER_PROPOSE : {
                $step = 1;
                $renter = 0;
                $owner = 0;
                break;
            }
            case self::STATUS_WAIT_OWNER_PROPOSE_ACCEPT : {
                $step = 1;
                $renter = 1;
                $owner = 0;
                break;
            }
            case self::STATUS_WAIT_OWNER_CONDITION_ACCEPT : {
                $step = 1;
                $renter = 1;
                $owner = 1;
                break;
            }
            case self::STATUS_WAIT_DOCUMENTATION : {
                $step = 3;
                $renter = 0;
                $owner = 0;
                break;
            }
            case self::STATUS_WAIT_RENTER_DOCUMENTATION : {
                $step = 3;
                $renter = 0;
                $owner = 1;
                break;
            }
            case self::STATUS_WAIT_OWNER_DOCUMENTATION : {
                $step = 3;
                $renter = 1;
                $owner = 0;
                break;
            }
            case self::STATUS_WAIT_ADMIN_DOCUMENTATION_ACCEPT : {
                $step = 3;
                $renter = 1;
                $owner = 1;
                break;
            }
            case self::STATUS_WAIT_ADMIN_RENTER_DOCUMENTATION_ACCEPT : {
                $step = 3;
                $renter = 2;
                $owner = 1;
                break;
            }
            case self::STATUS_WAIT_ADMIN_OWNER_DOCUMENTATION_ACCEPT : {
                $step = 3;
                $renter = 1;
                $owner = 2;
                break;
            }
            case self::STATUS_WAIT_DIGITAL_SIGNATURE : {
                $step = 4;
                $renter = 0;
                $owner = 0;
                break;
            }
        }
        return json_encode(['step' => $step, 'renter_step' => $renter, 'owner_step' => $owner]);
    }

    public function acceptRenterConditions()
    {
        $steps = $this->getCurrentStep();
        $steps_ = json_decode($steps);

        if (($steps_->step == 0) && ($steps_->renter_step == 0)) {
            $this->update([
                'renter_accept_conditions' => 1,
                'idstatus_negociation' => self::STATUS_WAIT_RENTER_PROPOSE
            ]);
            $content = [
                'code' => 1,
                'status' => 'Condições do Imooby aceitas com sucesso!',
                'steps' => $this->getCurrentStep(),
            ];

            //acceptedConditionsNegociationNotify
//            $NegociationNotifyHelper = new NegociationNotifyHelper($this);
//            $NegociationNotifyHelper->acceptedConditionsNegociationNotify();
        } else {
            $content = [
                'code' => 0,
                'status' => 'Você precisa aceitar as condição do Imooby!',
                'steps' => $steps,
            ];
        }

        return new JsonResponse($content, 200);
    }

    public function submitRenterPropose($data)
    {
        $steps = $this->getCurrentStep();
        $steps_ = json_decode($steps);

        if (($steps_->step == 1) && ($steps_->renter_step == 0)) {
            $this->update([
                'idstatus_negociation' => self::STATUS_WAIT_OWNER_PROPOSE_ACCEPT,
                'income_proof' => $data['income_proof'],
                'residents' => $data['residents'],
                'date_change' => $data['date_change'],
                'animals' => $data['animals'],
                'renter_conditions' => $data['renter_conditions'],
            ]);
            $content = [
                'code' => 1,
                'status' => 'Sua Proposta foi enviada com sucesso. Aguarde o proprietário aceitá-la para poder continuar!',
                'steps' => $this->getCurrentStep(),
            ];
            //submittedProposeNegociationNotify
            $NegociationNotifyHelper = new NegociationNotifyHelper($this);
            $NegociationNotifyHelper->submittedProposeNegociationNotify();
        } else {
            $content = [
                'code' => 0,
                'status' => 'Sua proposta já foi enviada!',
                'steps' => $steps,
            ];
        }

        return new JsonResponse($content, 200);
    }

    public function acceptRenterPropose()
    {
        $steps = $this->getCurrentStep();
        $steps_ = json_decode($steps);

        if(($steps_->step == 1) && ($steps_->renter_step == 1)){
            $this->update(['idstatus_negociation' => self::STATUS_WAIT_OWNER_CONDITION_ACCEPT]);
            $content = [
                'code'   => 1,
                'status' => 'A Proposta para o seu imóvel foi aceita com sucesso!',
                'steps'=> $steps = $this->getCurrentStep(),
            ];

            //acceptedProposeNegociationNotify
            $NegociationNotifyHelper = new NegociationNotifyHelper($this);
            $NegociationNotifyHelper->acceptedProposeNegociationNotify();
        } else {
            $content = [
                'code'   => 0,
                'status' => 'Aguarde o envio da proposta do Inquilino!',
                'steps'=> $steps,
            ];
        }

        return new JsonResponse($content, 200);
    }

    public function acceptOwnerConditions($accept = 1)
    {
        $steps = $this->getCurrentStep();
        $steps_ = json_decode($steps);

        if(($steps_->step == 1) && ($steps_->owner_step == 1)){
            $this->update([
                'owner_accept_conditions' => $accept,
                'idstatus_negociation' => self::STATUS_WAIT_DOCUMENTATION
            ]);
            $content = [
                'code'  => 1,
                'status'=> 'Condições do Imooby aceitas com sucesso!',
                'steps'=> $this->getCurrentStep(),
            ];

            //acceptedConditionsNegociationNotify
            $NegociationNotifyHelper = new NegociationNotifyHelper($this);
            $NegociationNotifyHelper->acceptedConditionsNegociationNotify();
        } else {
            $content = [
                'code'   => 0,
                'status' => 'Você precisa aceitar a proposta do Inquilino!',
                'steps'=> $steps,
            ];
        }

        return new JsonResponse($content, 200);
    }

    public function submitOwnerDocuments($data)
    {
        $NegociationDocument = NegociationDocument::createOwner($data);
        if($NegociationDocument->count()>0){
            if($this->attributes['idstatus_negociation'] == self::STATUS_WAIT_OWNER_DOCUMENTATION){
                $status = self::STATUS_WAIT_ADMIN_DOCUMENTATION_ACCEPT;
            } else {
                $status = self::STATUS_WAIT_RENTER_DOCUMENTATION;
            }
            $this->update(['idstatus_negociation' => $status]);
            $content = 'Documentos recebidos com sucesso!';
        } else {
            $content = 'Ocorreu um erro ao receber os seus documentos!';
        }
        return $content;
    }

    public function submitRenterDocuments($data)
    {
        $NegociationDocument = [];
        foreach ($data['document'] as $i => $document){
            $NegociationDocument[$i] = NegociationDocument::createRenter($document);
        }
        if(count($NegociationDocument)>0){
            if($this->attributes['idstatus_negociation'] == self::STATUS_WAIT_RENTER_DOCUMENTATION){
                $status = self::STATUS_WAIT_ADMIN_DOCUMENTATION_ACCEPT;
            } else {
                $status = self::STATUS_WAIT_OWNER_DOCUMENTATION;
            }
            $this->update(['idstatus_negociation' => $status]);
            $content = 'Documentos recebidos com sucesso!';
        } else {
            $content = 'Ocorreu um erro ao receber os seus documentos!';
        }
        return $content;

    }

    public function isOwnerDocumentsAccepted()
    {
        return ($this->attributes['idstatus_negociation'] != self::STATUS_WAIT_ADMIN_OWNER_DOCUMENTATION_ACCEPT)
            && ($this->attributes['idstatus_negociation'] > self::STATUS_WAIT_ADMIN_DOCUMENTATION_ACCEPT);
    }

    public function isRenterDocumentsAccepted()
    {
        return ($this->attributes['idstatus_negociation'] != self::STATUS_WAIT_ADMIN_RENTER_DOCUMENTATION_ACCEPT)
            && ($this->attributes['idstatus_negociation'] > self::STATUS_WAIT_ADMIN_DOCUMENTATION_ACCEPT);
    }

    public function acceptAdminOwnerDocument()
    {
        $this->owner_document->update(['status' => 1]);
        if($this->attributes['idstatus_negociation'] == self::STATUS_WAIT_ADMIN_OWNER_DOCUMENTATION_ACCEPT){
            $status = self::STATUS_WAIT_DIGITAL_SIGNATURE;
            $this->prepareDigitalSignature();
        } else {
            $status = self::STATUS_WAIT_ADMIN_RENTER_DOCUMENTATION_ACCEPT;
        }
        $this->update(['idstatus_negociation' => $status]);

        //Notification
        $NegociationNotifyHelper = new NegociationNotifyHelper($this);
        $NegociationNotifyHelper->acceptedDocumentationNegociationNotify();
        $content = 'A Documentação do Inquilino foi aceita!';
        return $content;
    }

    public function prepareDigitalSignature()
    {
        $locador = $this->owner_document()->where(['status' => 1])->first();
        $locatario = $this->renter_documents()->where(['status' => 1])->first();
        $address = $this->property->address;
        $dados = [
            'nome_do_locatario' => $locatario->name,
            'cpf_locatario' => $locatario->cpf,
            'nome_do_locador' => $locador->name,
            'cpf_locador' => $locador->cpf,
            'nome_dos_moradores' => $this->residents,
            'rua' => $address->street,
            'numero' => $address->number,
            'cidade' => $address->city,
            'estado' => $address->state,
            'cep' => $address->zip,
            'numero_matricula' => ($this->iptu_code != null ? $this->iptu_code : ''),
            'codigo_IPTU' => ($this->iptu_registration != null ? $this->iptu_registration : ''),
            'aceita_animais' => ($this->animals ? 'Sim,' : 'Não'),
            'valor_aluguel' => $this->rental,
            'valor_condominio' => $this->condominium,
            'valor_IPTU' => $this->iptu,
            'valor_taxa' => $this->fee,
        ];
        if ($document_uuid = Signer::generateAndPrepareDocument($dados, $locador->email, $locatario->email)) {
            $this->update(['signature_document_uuid' => $document_uuid]);
        }
    }

    public function owner_document()
    {
        return $this->hasOne('App\Models\Negociations\NegociationDocument', 'idnegociation')
            ->where('owner', 1);
    }

    public function renter_documents()
    {
        return $this->hasMany('App\Models\Negociations\NegociationDocument', 'idnegociation')
            ->where('owner', 0);
    }

    public function acceptAdminRenterDocuments()
    {
        foreach ($this->renter_documents as $renter_document) $renter_document->update(['status' => 1]);
        if($this->attributes['idstatus_negociation'] == self::STATUS_WAIT_ADMIN_RENTER_DOCUMENTATION_ACCEPT){
            $status = self::STATUS_WAIT_DIGITAL_SIGNATURE;
            $this->prepareDigitalSignature();
        } else {
            $status = self::STATUS_WAIT_ADMIN_OWNER_DOCUMENTATION_ACCEPT;
        }
        $this->update(['idstatus_negociation' => $status]);

        //Notification
        $NegociationNotifyHelper = new NegociationNotifyHelper($this);
        $NegociationNotifyHelper->acceptedDocumentationNegociationNotify();
        $content = 'A Documentação do Proprietário foi aceita!';
        return $content;
    }

    public function rejectAdminOwnerDocument()
    {
        $this->owner_document->update(['status' => 0]);
        if ($this->attributes['idstatus_negociation'] == self::STATUS_WAIT_ADMIN_RENTER_DOCUMENTATION_ACCEPT) {
            $status = self::STATUS_WAIT_ADMIN_DOCUMENTATION_ACCEPT;
        } else {
            $status = self::STATUS_WAIT_ADMIN_OWNER_DOCUMENTATION_ACCEPT;
        }
        $this->update(['idstatus_negociation' => $status]);
        $content = 'A Documentação do Proprietário foi rejeitada!';
        return $content;
    }

    // Assinatura Digital

    public function rejectAdminRenterDocuments()
    {
        foreach ($this->renter_documents as $renter_document) $renter_document->update(['status' => 0]);
        if ($this->attributes['idstatus_negociation'] == self::STATUS_WAIT_ADMIN_OWNER_DOCUMENTATION_ACCEPT) {
            $status = self::STATUS_WAIT_ADMIN_DOCUMENTATION_ACCEPT;
        } else {
            $status = self::STATUS_WAIT_ADMIN_RENTER_DOCUMENTATION_ACCEPT;
        }
        $this->update(['idstatus_negociation' => $status]);
        $content = 'A Documentação do Inquilino foi rejeitada!';
        return $content;
    }

    public function rejectRenterPropose()
    {
        return $this->update(['idstatus_negociation' => self::STATUS_PROPOSED_REJECTED]);
        exit;
        //Notification
        $NegociationNotifyHelper = new NegociationNotifyHelper($Negociation);
        $NegociationNotifyHelper->openNegociationNotify();
    }

    // ******************** /STATUS ******************************

    public function cancel()
    {
        return $this->update(['idstatus_negociation' => self::STATUS_CANCELED]);

        DataHelper::DEBUGVAR('Negociation|cancel');
        DataHelper::DEBUGVAR("this->update(['idstatus_negociation' => self::STATUS_CANCELED]");
        return;
    }

    public function verifySignature()
    {
        if($this->idstatus_negociation == self::STATUS_WAIT_DIGITAL_SIGNATURE)
        {
            if($this->signature_document_uuid != null) {
                $status = Signer::getDocumentStatus($this->signature_document_uuid);
                if ($status == 2) {
                    Signer::tryToAproveDoc($this->signature_document_uuid);
                    return 3;
                }
                if ($status==4 || $status == 5) { // Contrato finalizado
                    $this->update(['idstatus_negociation' => self::STATUS_REALIZED]);
                } elseif($status==6) { // Contrato cancelado
                    $this->update(['idstatus_negociation' => self::STATUS_CANCELED]); // Cancelado
                }
                return $status;
            }
        }
    }

    public function getStatusColor()
    {
        switch ($this->attributes['idstatus_negociation']) {
            case self::STATUS_PROPOSED_REJECTED:
            case self::STATUS_CANCELED:
                return 'danger';
                break;
            case self::STATUS_REALIZED:
                return 'success';
                break;
            default:
                return 'warning';
                break;
        }
    }

    // ******************** MUTATORS ******************************

    public function getStatusIcon()
    {
        switch ($this->attributes['idstatus_negociation']) {
            case self::STATUS_PROPOSED_REJECTED:
            case self::STATUS_CANCELED:
                return 'times';
                break;
            case self::STATUS_REALIZED:
                return 'check';
                break;
            default:
                return 'clock-o';
                break;
        }
    }

    public function getStatusText()
    {
        return $this->status->description;
    }

    // ******************** ACCESSORS ******************************

    public function setDateChangeAttribute($value)
    {
        $this->attributes['date_change'] = DataHelper::setDate($value);
    }

    public function setIncomeProofAttribute($value)
    {
        $this->attributes['income_proof'] = ($value=='on');
    }

    public function getAnimalsText()
    {
        return ($this->getAttribute('animals')) ? 'Pretende' : 'Não Pretende';
    }

    public function getIncomeProofText()
    {
        return ($this->getAttribute('income_proof')) ? 'Comprovada' : 'Não Comprovada';
    }

    public function getOwnerAcceptConditionsText()
    {
        return ($this->getAttribute('owner_accept_conditions')) ? 'Aceitas' : 'Não Aceitas';
    }

    public function getRenterAcceptConditionsText()
    {
        return ($this->getAttribute('renter_accept_conditions')) ? 'Aceitas' : 'Não Aceitas';
    }

    public function getDateChangeAttribute($value)
    {
        return DataHelper::getPrettyDate($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }

    public function priceIptuReal()
    {
        return DataHelper::getFloat2Real($this->getAttribute('iptu'));
    }

    public function priceRentalReal()
    {
        return DataHelper::getFloat2Real($this->getAttribute('rental'));
    }

    public function priceFeeReal()
    {
        return DataHelper::getFloat2Real($this->getAttribute('fee'));
    }

    public function priceCondominiumReal()
    {
        return DataHelper::getFloat2Real($this->getAttribute('condominium'));
    }

    public function rentalFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('rental'));
    }

    public function priceRentalTotalReal()
    {
        return DataHelper::getFloat2Real($this->getAttribute('rental') + $this->getAttribute('fee'));
    }

    public function priceRentalTotalFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('rental') + $this->getAttribute('fee   '));
    }

    public function feeFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('fee'));
    }

    // ******************** RELASHIONSHIP ******************************

    public function condominiumFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('condominium'));
    }

    public function iptuFormated()
    {
        return DataHelper::getFloat2Formated($this->getAttribute('iptu'));
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Negociations\StatusNegociation', 'idstatus_negociation');
    }

    public function property()
    {
        return $this->belongsTo('App\Models\Property', 'idproperty');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\Property', 'idproperty')->owner;
    }

    public function renter()
    {
        return $this->belongsTo('App\Models\Client', 'idrenter');
    }

    public function owner_assign()
    {
        return $this->hasOne('App\Models\Negociations\NegociationAssign', 'idnegociation')
            ->where('owner',1);
    }

    public function renter_assign()
    {
        return $this->hasOne('App\Models\Negociations\NegociationAssign', 'idnegociation')
            ->where('owner',0);
    }
}
