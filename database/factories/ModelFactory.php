<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/*
|--------------------------------------------------------------------------
| User Factories
|--------------------------------------------------------------------------
 */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('123'),
        'remember_token' => str_random(10),
    ];
});
/*
|--------------------------------------------------------------------------
| Address Factories
|--------------------------------------------------------------------------
 */
$factory->define(App\Models\Address::class, function (Faker\Generator $faker) {
    $lat = -25.431016;
    $lng = -49.2655;
    return [
        'lat' => $lat + $faker->latitude($min = -0.05, $max = 0.05),
        'lng' => $lng + $faker->longitude($min = -0.05, $max = 0.05),
        'zip' => $faker->randomNumber($nbDigits = 8),
        'state' => 'Paraná',
        'city' => 'Curitiba',
        'district' => $faker->streetName,
        'street' => $faker->streetName,
        'number' => $faker->randomNumber($nbDigits = 4),
        'complement' => $faker->word
    ];
});
/*
|--------------------------------------------------------------------------
| Contact Factories
|--------------------------------------------------------------------------
 */
$factory->define(App\Models\Contact::class, function (Faker\Generator $faker) {
    return [
        'phone' => $faker->randomNumber($nbDigits = 9),
        'cellphone' => $faker->randomNumber($nbDigits = 9),
        'skype' => $faker->word,
        'facebook' => 'www.facebook.com/' . $faker->word,
        'google_plus' => 'www.google_plus.com/' . $faker->word,
        'pinterest' => 'www.pinterest.com/' . $faker->word,
        'twitter' => 'www.twitter.com/' . $faker->word,
    ];
});
/*
|--------------------------------------------------------------------------
| Photo Factories
|--------------------------------------------------------------------------
 */
$factory->defineAs(App\Models\Photo::class, 'clients', function (Faker\Generator $faker) {
    $path = public_path('uploads' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'clients' . DIRECTORY_SEPARATOR);
    $fileName = $faker->image($dir = $path, $width = 640, $height = 480, 'people', false);
    return [
        'link' => $fileName,
        'main' => 1,
    ];
});

$factory->defineAs(App\Models\Photo::class, 'properties', function (Faker\Generator $faker) {
    $path = public_path('uploads' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'properties' . DIRECTORY_SEPARATOR);
    $fileName = $faker->image($dir = $path, $width = 640, $height = 480, 'technics', false);
    return [
        'link' => $fileName,
    ];
});

$factory->defineAs(App\Models\Photo::class, 'admins', function (Faker\Generator $faker) {
    $path = public_path('uploads' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'admins' . DIRECTORY_SEPARATOR);
    $fileName = $faker->image($dir = $path, $width = 640, $height = 480, 'people', false);
    return [
        'link' => $fileName,
        'main' => 1,
    ];
});
/*
|--------------------------------------------------------------------------
| Clients Factories
|--------------------------------------------------------------------------
 */
$factory->defineAs(App\Models\Client::class, 'leonardo', function (Faker\Generator $faker) {
    return [
        'idphoto' => function () {
            $v = factory(App\Models\Photo::class, 'clients')->create();
            $x = $v->all();
            return count($x);
        },
        'iduser' => function () {
            return
                App\Models\User::create([
                    'email' => 'silva.zanin@gmail.com',
                    'password' => bcrypt('123'),
                    'remember_token' => str_random(10),
                ])->id;
        },
        'idaddress' => function () {
            return factory(App\Models\Address::class)->create()->id;
        },
        'idcontact' => function () {
            return factory(App\Models\Contact::class)->create()->id;
        },
        'name' => 'Leonardo Cliente',
        'about' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
$factory->defineAs(App\Models\Client::class, 'leonardo2', function (Faker\Generator $faker) {
    return [
        'idphoto' => function () {
            $v = factory(App\Models\Photo::class, 'clients')->create();
            $x = $v->all();
            return count($x);
        },
        'iduser' => function () {
            return
                App\Models\User::create([
                    'email' => 'oquefoi@gmail.com',
                    'password' => bcrypt('123'),
                    'remember_token' => str_random(10),
                ])->id;
        },
        'idaddress' => function () {
            return factory(App\Models\Address::class)->create()->id;
        },
        'idcontact' => function () {
            return factory(App\Models\Contact::class)->create()->id;
        },
        'name' => 'Cliente 2',
        'about' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
$factory->defineAs(App\Models\Client::class, 'luiz', function (Faker\Generator $faker) {
    return [
        'idphoto' => function () {
            $v = factory(App\Models\Photo::class, 'clients')->create();
            $x = $v->all();
            return count($x);
        },
        'iduser' => function () {
            return
                App\Models\User::create([
                    'email' => 'cliente_luiz@email.com',
                    'password' => bcrypt('123'),
                    'remember_token' => str_random(10),
                ])->id;
        },
        'idaddress' => function () {
            return factory(App\Models\Address::class)->create()->id;
        },
        'idcontact' => function () {
            return factory(App\Models\Contact::class)->create()->id;
        },
        'name' => 'Luiz Cliente',
        'about' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});

$factory->define(App\Models\Client::class, function (Faker\Generator $faker) {
    return [
        'idphoto' => function () {
            $v = factory(App\Models\Photo::class, 'clients')->create();
            $x = $v->all();
            return count($x);
        },
        'iduser' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'idaddress' => function () {
            return factory(App\Models\Address::class)->create()->id;
        },
        'idcontact' => function () {
            return factory(App\Models\Contact::class)->create()->id;
        },
        'name' => $faker->name,
        'about' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
/*
|--------------------------------------------------------------------------
| Admins Factories
|--------------------------------------------------------------------------
 */
$factory->defineAs(App\Models\Admin::class, 'leonardo', function (Faker\Generator $faker) {
    return [
        'iduser' => function () {
            return App\Models\User::create(['email' => 'silva.zanin@gmail.com', 'password' => bcrypt('123')])->id;
        },
        'idphoto' => function () {
            $v = factory(App\Models\Photo::class, 'admins')->create();
            $x = $v->all();
            return count($x);
        },
        'name' => 'Leonardo',
    ];
});
$factory->defineAs(App\Models\Admin::class, 'luiz', function (Faker\Generator $faker) {
    return [
        'iduser' => function () {
            return App\Models\User::create(['email' => 'lfernando.cwb@gmail.com', 'password' => bcrypt('123')])->id;
        },
        'idphoto' => function () {
            $v = factory(App\Models\Photo::class, 'admins')->create();
            $x = $v->all();
            return count($x);
        },
        'name' => 'Luiz',
    ];
});
/*
|--------------------------------------------------------------------------
| Property Factories
|--------------------------------------------------------------------------
 */
$factory->define(App\Models\PropertiesPhoto::class, function (Faker\Generator $faker) {
    return [
        'idphoto' => function () {
            $v = factory(App\Models\Photo::class, 'properties')->create();
            $x = $v->all();
            return count($x);
        },
        'idproperty' => $faker->numberBetween($min = 1, $max = 15),
    ];
});
$factory->define(App\Models\Property::class, function (Faker\Generator $faker) {
    $fee = \App\Models\Config::where('meta_key', 'rental_fee')->first()->meta_value;
    $price_rental = $faker->randomFloat($nbMaxDecimals = 2, $min = 400, $max = 800);
    $price_condominium = $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 200);
    $price_iptu = $faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = 150);
    $price_total = ($price_rental + $price_iptu + $price_condominium) * (1 + $fee);
    return [
        'idowner' => $faker->numberBetween($min = 1, $max = 10),
        'idproperties_type' => $faker->numberBetween($min = 1, $max = 2),
        'idaddress' => function () {
            return factory(App\Models\Address::class)->create()->id;
        },
        'title' => $faker->name,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),

        'price_rental' => $price_rental,
        'price_condominium' => $price_condominium,
        'price_iptu' => $price_iptu,
        'price_total' => $price_total,

        'bedroom_n' => $faker->numberBetween($min = 1, $max = 5),
        'bathroom_n' => $faker->numberBetween($min = 0, $max = 3),
        'internal_area' => $faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 20),
        'external_area' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 20),
        'garage' => $faker->boolean(),
        'reception' => $faker->boolean(),
        'air_conditioning' => $faker->boolean(),
        'outdoor_pool' => $faker->boolean(),
        'garden' => $faker->boolean(),
        'fireplace' => $faker->boolean(),
        'animals' => $faker->boolean(),
        'playground' => $faker->boolean(),
        'hydro' => $faker->boolean(),
        'grill' => $faker->boolean(),
        'laundry' => $faker->boolean(),
        'furnished' => $faker->boolean(),
        'status' => $faker->boolean(),
    ];
});

/*
|--------------------------------------------------------------------------
| Condition Factories
|--------------------------------------------------------------------------
 */
$factory->define(App\Models\Negociations\Condition::class, function (Faker\Generator $faker) {
    return [
        'title' => 'Condição',
        'description' => $faker->text(1000),
        'order'=> 0,
    ];
});