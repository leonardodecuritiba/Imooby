<?php

namespace App\Http\Requests\Admin\Properties;

use App\Models\Config;
use App\Models\PropertiesPhoto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class PropertiesUploadPhotosRequest extends FormRequest {

	private $properties_photo_max;
	private $properties_photo_mb;
	private $max;

	public function __construct( array $query = array(), array $request = array(), array $attributes = array(), array $cookies = array(), array $files = array(), array $server = array(), $content = null ) {
		parent::__construct( $query, $request, $attributes, $cookies, $files, $server, $content );
		$this->properties_photo_max = Config::getByMetaKey( 'properties_photo_max' )->meta_value;
		$this->properties_photo_mb  = Config::getByMetaKey( 'properties_photo_mb' )->meta_value;
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		$num       = PropertiesPhoto::getNumberPhotos( $this->get( 'idproperty' ) );
		$this->max = $this->properties_photo_max - $num;

		return [
			'fotos'   => 'sometimes|max_properties_photo:' . $this->max,
			'fotos.*' => 'sometimes|mimes:jpg,jpeg,png,bmp|max:' . $this->properties_photo_mb * 1000,
		];
	}

	public function messages() {
		return [
			'fotos.max_properties_photo' => 'Desculpe! Você só pode enviar mais ' . $this->max . ' arquivos para este imóvel.',
			'fotos.*.required'           => 'Por favor selecione uma imagem',
			'fotos.*.mimes'              => 'Somente extensões jpeg,png e bmp são permitidas',
			'fotos.*.max'                => 'Desculpe! O tamanho máximo permitido é de 7' . $this->properties_photo_mb . 'MB',
		];
	}

	/**
	 * Get the response that handle the request errors.
	 *
	 * @param  array $errors
	 *
	 * @return array
	 */
	public function response( array $errors ) {
		return Redirect::back()->withErrors( $errors )->withInput();
	}
}
