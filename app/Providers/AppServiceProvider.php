<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Negociations\Negociation;
use App\Models\Photo;
use App\Models\PropertiesPhoto;
use App\Models\Property;
use App\Models\PropertyCover;
use App\Observers\ClientObserver;
use App\Observers\NegociationObserver;
use App\Observers\PhotoObserver;
use App\Observers\PropertiesPhotoObserver;
use App\Observers\PropertyCoverObserver;
use App\Observers\PropertyObserver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		//
		View::share('_PAGE_TEMPLATE_', [
			'main_title'         => 'Imooby',
			'main_name'          => 'Imooby Internet Ltda.',
			'main_cnpj'          => '28.309.552/0001-03',
			'main_position'      => ['lat' => -25.429415, 'lng' => -49.271921],
			'GOOGLE_MAP_API_KEY' => 'AIzaSyCPDjKFh2ME851Axe7tTzghWt7S_O-xbmQ',
			'main_copyright'     => '©' . Carbon::now()->format('Y') . ' | Todos os direitos reservados'
		]);
		Schema::defaultStringLength(191);
		Property::observe(PropertyObserver::class);
		Negociation::observe( NegociationObserver::class );
		PropertiesPhoto::observe( PropertiesPhotoObserver::class );
		Photo::observe( PhotoObserver::class );
		PropertyCover::observe( PropertyCoverObserver::class );
		Client::observe( ClientObserver::class );
		Validator::extend('active', function ($attribute, $value, $parameters, $validator) {
			$Class = $parameters[0];
			return $Class::isActive($value);
		});
		Validator::extend( 'max_properties_photo', function ( $attribute, $value, $parameters ) {
			return ( count( $value ) <= $parameters[0] ) ? true : false;
		} );
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		if ( $this->app->environment() !== 'production') {
			$this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
		}
	}
}
