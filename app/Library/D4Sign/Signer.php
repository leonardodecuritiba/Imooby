<?php

namespace App\Library\D4Sign;

use App\Library\D4Sign\Client;

class Signer
{
    public static function tryToAproveDoc($document_uuid)
    {
        $client = new Client();
        $client->documents->sendToSigner($document_uuid, "", 0, 1);
    }
    public static function generateAndPrepareDocument($dados, $locador_email, $locatario_email, $document_name = 'default', $safe = 'default')
    {
        $client = new Client();
        $config = $client->serviceConfig;

        // $template = ['MzQx'=>$dados];
        $template = ['MzQx'=>$dados]; // tests
        if ($safe == 'default') {
            $safe = $config['default_safe'];
        }
        if ($document_name == 'default') {
            $document_name = $config['default_document_name'];
        }
        $document = $client->documents->makedocumentbytemplate($safe, $document_name, $template);
        if (!isset($document->uuid)) {
            return false;
        }
        $document_uuid = $document->uuid;

        $signers = [
        ["email" => $locador_email, 
        "act" => '4', 
        "foreign" => '0', 
        "certificadoicpbr" => '0', 
        "assinatura_presencial" => '0', 
        "embed_methodauth" => 'email'],
        ["email" => $locatario_email, 
        "act" => '4', 
        "foreign" => '0', 
        "certificadoicpbr" => '0', 
        "assinatura_presencial" => '0', 
        "embed_methodauth" => 'email']
        ];
            $client->documents->createList($document_uuid, $signers);
            $client->documents->sendToSigner($document_uuid, "", 0, 1);
            return $document_uuid;
    }

    public static function getDocumentStatus($document_uuid)
    {
        $client = new Client();
        $doc = $client->documents->find($document_uuid)[0];
        if (isset($doc->statusId)) {
            return $doc->statusId;
        }
        return 0;
    }

    public static function getDocuments()
    {
        $client = new Client();
        $config = $client->serviceConfig;
        return $client->documents->find();
    }

    public static function embed($negotiation_id, $document_uuid, $signer_email, $signer_name, $signer_cpf = null)
    {
        $config = config('services.d4sign');
        return view('d4sign.example', compact(['config', 'document_uuid', 'signer_email', 'signer_name', 'signer_cpf']));
    }
}
