<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=DatabaseSeeder
        //Creating directories
        $directories = [
            public_path('uploads' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'admins' . DIRECTORY_SEPARATOR),
            public_path('uploads' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'clients' . DIRECTORY_SEPARATOR),
            public_path('uploads' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'nogociations' . DIRECTORY_SEPARATOR),
            public_path('uploads' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'properties' . DIRECTORY_SEPARATOR)
        ];
        foreach ($directories as $directory) {
            File::makeDirectory($directory, $mode = 0777, true, true);
        }
        $configs = array(
            array(
                'name' => 'Taxa Imooby',
                'meta_key' => 'rental_fee',
                'meta_value' => '0.1',
            ),
            array(
                'name' => 'Condições Imooby para o Proprietário',
                'meta_key' => 'owner_conditions',
                'meta_value' => '- Autorizo à Imooby Internet Ltda, consultar meus dados e informações, junto a órgãos de proteção ao crédito como SERASA, SPC e outros, bem como declaro sob as penas da lei, ter autorizado para solicitar a consulta, em nome das demais partes, financeiros e não financeiro, citados nesse formulário (quando houver).\r\n- Declaro estar ciente da possibilidade de recusa em função da análise de risco.\r\n- Todos os contratos de aluguel através da plataforma Imooby são de 30 meses, você pode rescindir o contrato a qualquer momento, desde que avise com 30 dias de antecedência. \r\n- O imóvel ainda não está reservado para você, enviar a proposta não garante a reserva do imóvel. O imóvel estará reservado para você a partir da assinatura do contrato. \r\n- Concordo que as cópias dos documentos enviados para avaliação do cadastro, não serão devolvidas, mesmo em caso de recusa ou cancelamento da análise cadastral.\r\n- Declaro que as informações prestadas são a expressão da verdade, pelas quais me responsabilizo, sob pena e aplicação do disposto nas condições gerais.',
            ),
            array(
                'name' => 'Condições Imooby para o Locatário',
                'meta_key' => 'renter_conditions',
                'meta_value' => '- Autorizo à Imooby Internet Ltda, consultar meus dados e informações, junto a órgãos de proteção ao crédito como SERASA, SPC e outros, bem como declaro sob as penas da lei, ter autorizado para solicitar a consulta, em nome das demais partes, financeiros e não financeiro, citados nesse formulário (quando houver).\r\n- Autorizo à Imooby Internet Ltda, consultar meus dados e informações, junto a órgãos de proteção ao crédito como SERASA, SPC e outros, bem como declaro sob as penas da lei, ter autorizado para solicitar a consulta, em nome das demais partes, financeiros e não financeiro, citados nesse formulário (quando houver).',
            ),
	        array(
		        'name'       => 'Número Máximo de Fotos',
		        'meta_key'   => 'properties_photo_max',
		        'meta_value' => '25',
	        ),
	        array(
		        'name'       => 'Tamanho Máximo da Foto (MB)',
		        'meta_key'   => 'properties_photo_mb',
		        'meta_value' => '7',
	        ),
        );
        foreach ($configs as $config) {
            \App\Models\Config::create($config);
        }

        $properties_type = ['Casa', 'Apartamento', 'Cobertura', 'Sobrado'];
        foreach ($properties_type as $descritption) {
            \App\Models\PropertiesType::create(['description' => $descritption]);
        }
        $visits_status = [
	        'Aguardando Confirmação do Proprietário',
	        'Aguardando Confirmação do Inquilino',
            'Visita Confirmada',
            'Visita Cancelada',
            'Visita Reagendada',
            'Visita Expirada',
            'Visita Realizada'
        ];
        foreach ($visits_status as $descritption) {
            \App\Models\VisitsStatus::create(['description' => $descritption]);
        }

        $status_negociations = [
            'Aguardando Aceite de Condições do Inquilino',
            'Aguardando Envio da Proposta do Inquilino',
            'Aguardando Aceite da Proposta pelo Proprietário',
            'Aguardando Aceite de Condições do Proprietário',
            'Proposta Rejeitada',
            'Aguardando Documentação',
            'Aguardando Envio da Documentação do Inquilino',
            'Aguardando Envio da Documentação do Proprietário',
            'Aguardando Aceite da Documentação pelo Admin',
            'Aguardando Aceite Documentação do Inquilino pelo Admin',
            'Aguardando Aceite Documentação do Proprietário pelo Admin',
            'Aguardando Assinatura Digital',
            'Aguardando Assinatura Digital do Proprietário',
            'Aguardando Assinatura Digital do Inquilino',
            'Negociação Realizada',
            'Negociação Cancelada'
        ];
        foreach ($status_negociations as $descritption) {
            \App\Models\Negociations\StatusNegociation::create(['description' => $descritption]);
        }
        $this->call(AdminSeeder::class);
        $this->call(ZizacoSeeder::class);
        sleep(10);
        $this->call(CorrigePhotosSeeder::class);

    }
}
