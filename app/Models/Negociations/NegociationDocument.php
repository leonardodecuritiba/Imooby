<?php

namespace App\Models\Negociations;

use App\Helpers\DataHelper;
use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NegociationDocument extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
        'idnegociation',
        'owner',
        'name',
        'email',
        'cpf',
        'phone',
        'cellphone',
        'income_nature',
        'gross_income',
        'reason',
        'civil_status',
        'doc_link',
        'cpf_link',
        'address_proof_link',
        'income_proof_link',
        'status',
        'iptu_code',
        'iptu_registration'
    ];

    // ************************ FUNCTIONS ******************************

    static public function createOwner($data)
    {
        $data['owner'] = 1;
        $data['income_proof_link'] = NULL;
        return self::create($data);
    }

    static public function createRenter($data)
    {
        $data['owner'] = 0;
        return self::create($data);
    }

    public function acceptDocument()
    {
        $this->update(['status' => 1]);
        return 'Documento Aceito';
    }

    public function rejectDocument()
    {
        $this->update(['status' => 0]);
        return 'Documento Rejeitado';
    }

    public function getDocImage()
    {
        $doc = $this->getAttribute('doc_link');
        return ($doc != NULL) ? asset(ImageHelper::PATH_NAME) . '/negociations/' . $doc : asset('assets_site/imgs/no-documents.png');
    }

    public function getCpfImage()
    {
        $doc = $this->getAttribute('cpf_link');
        return ($doc != NULL) ? asset(ImageHelper::PATH_NAME) . '/negociations/' . $doc : asset('assets_site/imgs/no-documents.png');
    }

    public function getAddressProofImage()
    {
        $doc = $this->getAttribute('address_proof_link');
        return ($doc != NULL) ? asset(ImageHelper::PATH_NAME) . '/negociations/' . $doc : asset('assets_site/imgs/no-documents.png');
    }

    public function getIncomeProofImage()
    {
        $doc = $this->getAttribute('income_proof_link');
        return ($doc != NULL) ? asset(ImageHelper::PATH_NAME) . '/negociations/' . $doc : asset('assets_site/imgs/no-documents.png');
    }

    // ******************** /STATUS ******************************

    public function getStatusColor()
    {
        return ($this->attributes['status']) ? 'success' : 'warning';
    }

    public function getStatusIcon()
    {
        return ($this->attributes['status']) ? 'check' : 'clock-o';
    }

    public function getStatusText()
    {
        return ($this->attributes['status']) ? 'Verificado' : 'Aguardando Verificação';
    }

    public function getBtnStatusColor()
    {
        return !($this->attributes['status']) ? 'success' : 'danger';
    }

    public function getBtnStatusIcon()
    {
        return !($this->attributes['status']) ? 'check' : 'times';
    }

    public function getBtnStatusText()
    {
        return !($this->attributes['status']) ? 'Aceitar Documento' : 'Rejeitar Documento';
    }

    public function getBtnStatusLink()
    {
        return route('admins.negociations.' . (($this->attributes['status']) ? 'rejectDocument' : 'acceptDocument'), $this->id);
    }

    // ************************ MUTATORS ******************************
    public function setPhoneAttribute($value)
    {
        return $this->attributes['phone'] = DataHelper::getOnlyNumbers($value);
    }

    public function setCellphoneAttribute($value)
    {
        return $this->attributes['cellphone'] = DataHelper::getOnlyNumbers($value);
    }

    public function setCpfAttribute($value)
    {
        return $this->attributes['cpf'] = DataHelper::getOnlyNumbers($value);
    }

    public function setGrossIncomeAttribute($value)
    {
        return $this->attributes['gross_income'] = DataHelper::getReal2Float($value);
    }

    // ************************ ACCESSORS ******************************
    public function getFormatedGrossIncome()
    {
        return DataHelper::getFloat2Real($this->attributes['gross_income']);
    }

    public function getFormatedPhone()
    {
        return DataHelper::mask($this->attributes['phone'], '(##)####-####');
    }

    public function getFormatedCellphone()
    {
        return DataHelper::mask($this->attributes['cellphone'], '(##)#####-####');
    }

    public function getCreatedAtAttribute($value)
    {
        return DataHelper::getPrettyDateTime($value);
    }

    public function getCpfAttribute($value)
    {
        return DataHelper::mask($this->attributes['cpf'], '###.###.###-###');
    }

    // ******************** RELASHIONSHIP ******************************
    public function negociation()
    {
        return $this->belongsTo('App\Models\Negociations\Negociation', 'idnegociation');
    }
}
