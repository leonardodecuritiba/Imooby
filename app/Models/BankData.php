<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankData extends Model
{
	protected $fillable = [
	'bank_id',
	'agency',
	'account_type',
	'account_number',
	'owner_name',
	'cpf'
	];

	public function getAccountTypeText()
	{
		switch($this->account_type) {
			case 1:
			return 'Conta corrente';
			break;
			case 2:
			return 'Poupança';
			break;
			default:
			return 'Nada selecionado';
		}
	}

	public function client()
	{
		return $this->belongsTo(Client::class);
	}

	public function bank()
	{
		return $this->belongsTo(Bank::class);
	}
}
