<?php

use Illuminate\Database\Seeder;

class ZizacoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=ZizacoSeeder
        $start = microtime(true);
        echo "*** Iniciando os Seeders ZizacoSeeder ***\n";
        echo "*** SETANDO ADMINS ***\n";
        $admin = new \App\Models\Role();
        $admin->name = 'admin';
        $admin->display_name = 'Usuário Administrador'; // optional
        $admin->description = 'Usuário pode administrar e acessar todo o sistema'; // optional
        $admin->save();
        foreach (\App\Models\Admin::all() as $item) {
            $item->user->attachRole($admin);
        }

        echo "*** SETANDO CLIENTES ***\n";
        $client = new \App\Models\Role();
        $client->name = 'client';
        $client->display_name = 'Usuário Cliente'; // optional
        $client->description = 'Usuário com acessos restritos'; // optional
        $client->save();

        foreach (\App\Models\Client::all() as $item) {
            $item->user->attachRole($client);
        }

//        $role = Role::find($data['tipo_cadastro']);
//        $data['remember_token'] = str_random(60);
//        $data['password'] = bcrypt('123');
//        $User = User::create($data);
//        $User->attachRole($role);


        echo "\n*** Completo em " . round((microtime(true) - $start), 3) . "s ***";
    }
}
