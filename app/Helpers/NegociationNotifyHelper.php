<?php

namespace App\Helpers;

use App\Models\Admin;
use App\Models\Negociations\Negociation;
use App\Models\User;
use App\Notifications\NegociateNotify;

class NegociationNotifyHelper
{

    const DEBUG = 0;
    private $Owner;
    private $Property;
    private $Renter;
    private $UsersAdmin;
    private $Negociation;

    function __construct(Negociation $Negociation)
    {
        $this->Negociation = $Negociation;
        $this->setClients($Negociation);
        $this->setAdmins();
    }

    private function setClients(Negociation $Negociation)
    {
        $this->Property = $Negociation->property;
        $this->Owner = $this->Property->owner;
        $this->Renter = $Negociation->renter;
    }

    private function setAdmins()
    {
        $this->UsersAdmin = User::whereIn('id', Admin::pluck('iduser'))->get();
    }

    private function sendOwnerNotification($notification)
    {
        if (self::DEBUG) return;
        $this->Owner->user->notify(new NegociateNotify([
            'name' => $this->Owner->name,
            'subject' => $notification['subject'],
            'title' => $notification['title'],
            'message' => $notification['message'],
            'recomendation' => $notification['recomendation'],
            'link' => $notification['link'],
        ]));
    }

    private function sendRenterNotification($notification)
    {
        if (self::DEBUG) return;
        $this->Renter->user->notify(new NegociateNotify([
            'name' => $this->Renter->name,
            'subject' => $notification['subject'],
            'title' => $notification['title'],
            'message' => $notification['message'],
            'recomendation' => $notification['recomendation'],
            'link' => $notification['link'],
        ]));
    }

    private function sendAdminsNotification($notification)
    {
        if (self::DEBUG) return;
        foreach($this->UsersAdmin as $user){
            $user->notify(new NegociateNotify([
                'name' => $user->admin->name,
                'title' => $notification['title'],
                'subject' => $notification['subject'],
                'message' => $notification['message'],
//                'recomendation' => $notification['recomendation'],
//                'link' => $notification['link'],
            ]));
        }
    }

    public function openNegociationNotify()
    {
        if (self::DEBUG) return;
//        $this->sendOwnerNotification([
//            'subject' => 'Você recebeu uma proposta de locação para o imóvel ' . $this->Property->id,
//            'title' => 'Proposta Recebida',
//            'message' => 'Você recebeu uma proposta de locação para seu imóvel. Agora basta visualizar e aceitar para prosseguirmos com a análise de crédito e documentação do inquilino.',
//            'recomendation' => 'Confira a proposta abaixo:',
//            'link' => route('negociation.show', $this->Negociation->id),
//        ]);
//
//        $this->sendRenterNotification([
//            'subject' => 'Recebemos a proposta de locação para o imóvel ' . $this->Property->id,
//            'title' => 'Proposta Enviada',
//            'message' => 'A sua proposta de locação já foi enviada para o proprietário do imóvel com sucesso. Você receberá um aviso automático assim que o proprietário responder!',
//            'recomendation' => 'Confira sua proposta abaixo:',
//            'link' => route('negociation.show', $this->Negociation->id),
//        ]);

        $this->sendAdminsNotification([
            'subject' => 'Negociação iniciada - Imóvel ' . $this->Property->id,
            'title' => 'Negociação Iniciada',
            'message' => 'Negociação Iniciada'
        ]);

        return true;
    }

    public function cancelNegociationNotify()
    {
        if (self::DEBUG) return;
        $this->sendOwnerNotification([
            'error' => 1,
            'subject' => 'ATENÇÃO: A negociação referente ao imóvel ' . $this->Property->id . ' foi cancelada',
            'title' => 'Negociação Cancelada',
            'message' => 'Infelizmente essa negociação precisou ser cancelada, você pode entrar em contato para obter maiores informações.',
            'recomendation' => 'Confira nossos canais de atendimento abaixo:',
            'link' => route('index'),
        ]);

        $this->sendRenterNotification([
            'error' => 1,
            'subject' => 'ATENÇÃO: A negociação referente ao imóvel ' . $this->Property->id . ' foi cancelada',
            'title' => 'Negociação Cancelada',
            'message' => 'Infelizmente essa negociação precisou ser cancelada. Vamos tentar novamente?',
            'recomendation' => 'Confira mais oportunidades abaixo:',
            'link' => route('index'),
        ]);

        $this->sendAdminsNotification([
            'error' => 1,
            'subject' => 'Negociação cancelada - Imóvel ' . $this->Property->id,
            'title' => 'Negociação Cancelada',
            'message' => 'Negociação Cancelada'
        ]);

        return true;
    }

    public function acceptedConditionsNegociationNotify()
    {
        if (self::DEBUG) return;
        $this->sendOwnerNotification([
            'subject' => 'As condições de uso do Imooby para o imóvel ' . $this->Property->id . ' foram aceitas',
            'title' => 'Condições Aceitas',
            'message' => 'Parabéns! Só mais alguns passos antes de alugar seu imóvel, agora que as condições foram aceitas, você precisa visualizar e confirmar a proposta de locação.',
            'recomendation' => 'Confira as condições abaixo:',
            'link' => route('negociation.show', $this->Negociation->id),
        ]);

        $this->sendRenterNotification([
            'subject' => 'As condições de uso do Imooby foram aceitas',
            'title' => 'Condições Aceitas',
            'message' => 'Parabéns! Só mais alguns passos antes de alugar seu imóvel, agora que as condições foram aceitas, você precisa prosseguir com o envio/confirmação da proposta de locação.',
            'recomendation' => 'Confira as condições abaixo:',
            'link' => route('negociation.show', $this->Negociation->id),
        ]);

        $this->sendAdminsNotification([
            'subject' => 'Condições aceitas - Imóvel ' . $this->Property->id,
            'title' => 'Condições aceitas',
            'message' => 'Condições aceitas'
        ]);
    }

    public function submittedProposeNegociationNotify()
    {
        if (self::DEBUG) return;
        $this->sendOwnerNotification([
            'subject' => 'Você recebeu uma proposta de locação para o imóvel ' . $this->Property->id,
            'title' => 'Proposta Recebida',
            'message' => 'Você recebeu uma proposta de locação para seu imóvel. Agora basta visualizar e aceitar para prosseguirmos com a análise de crédito e documentação do inquilino.',
            'recomendation' => 'Confira a proposta abaixo:',
            'link' => route('negociation.show', $this->Negociation->id),
        ]);

        $this->sendRenterNotification([
            'subject' => 'Recebemos a proposta de locação para o imóvel ' . $this->Property->id,
            'title' => 'Proposta Enviada',
            'message' => 'A sua proposta de locação já foi enviada para o proprietário do imóvel com sucesso. Você receberá um aviso automático assim que o proprietário aceitá-la!',
            'recomendation' => 'Confira sua proposta abaixo:',
            'link' => route('negociation.show', $this->Negociation->id),
        ]);

        $this->sendAdminsNotification([
            'subject' => 'Proposta Enviada - Imóvel ' . $this->Property->id,
            'title' => 'Proposta Enviada',
            'message' => 'Proposta Enviada'
        ]);

        return true;
    }

    public function rejectedProposeNegociationNotify()
    {
        if (self::DEBUG) return;
        $this->sendOwnerNotification([
            'error' => 1,
            'subject' => 'ATENÇÃO: Você cancelou a proposta referente ao imóvel ' . $this->Property->id,
            'title' => 'Proposta Cancelada',
            'message' => 'A proposta foi cancelada com sucesso, caso tenha dúvidas entre em contato com a nossa equipe, você ainda pode receber propostas de outros usuários normalmente.',
            'recomendation' => 'Confira suas propostas abaixo:',
            'link' => route('profile.negociations'),
        ]);

        $this->sendRenterNotification([
            'error' => 1,
            'subject' => 'ATENÇÃO: A proposta referente ao imóvel ' . $this->Property->id . ' foi cancelada',
            'title' => 'Proposta Cancelada',
            'message' => 'Infelizmente essa proposta precisou ser cancelada. Vamos tentar novamente?',
            'recomendation' => 'Confira mais oportunidades abaixo:',
            'link' => route('index'),
        ]);

        $this->sendAdminsNotification([
            'error' => 1,
            'subject' => 'Proposta Cancelada - Imóvel ' . $this->Property->id,
            'title' => 'Proposta Cancelada',
            'message' => 'Proposta Cancelada'
        ]);
        return true;
    }

    public function acceptedProposeNegociationNotify()
    {
        if (self::DEBUG) return;
        $this->sendOwnerNotification([
            'subject' => 'A proposta referente ao imóvel ' . $this->Property->id . 'foi confirmada',
            'title' => 'Proposta Aceita',
            'message' => 'Recebemos sua confirmação, neste momento estamos solicitando os documentos do inquilino para análise de crédito e posterior elaboração do contrato de aluguel. Você receberá um aviso automático assim que o contrato estiver disponivel para assinatura.',
            'recomendation' => 'Confira sua negociação abaixo:',
            'link' => route('negociation.show', $this->Negociation->id),
        ]);

        $this->sendRenterNotification([
            'subject' => 'A proposta referente ao imóvel ' . $this->Property->id . ' foi confirmada',
            'title' => 'Proposta Aceita',
            'message' => 'Agora falta pouco para concluir o processo de locação. Para prosseguirmos você precisa enviar os documentos para análise e elaboração do contrato de aluguel.',
            'recomendation' => 'Confira os documentos abaixo:',
            'link' => route('negociation.show', $this->Negociation->id),
            'postscript' => ['Importante', 'O imóvel ainda não está reservado para você. Somente após a assinatura do contrato por ambas as partes a locação estará concluída.'],
        ]);

        $this->sendAdminsNotification([
            'subject' => 'Proposta Confirmada - Imóvel ' . $this->Property->id,
            'title' => 'Proposta Confirmada',
            'message' => 'Proposta Confirmada'
        ]);

        return true;
    }

    public function confirmedDocumentationNegociationNotify()
    {
        if (self::DEBUG) return;
        $this->sendOwnerNotification([
            'subject' => 'A documentação foi recebida com sucesso',
            'title' => 'Documentação Recebida',
            'message' => 'A sua documentação foi recebida. Você receberá um aviso automático assim que o contrato estiver pronto para assinatura.',
            'recomendation' => 'Confira sua negociação abaixo:',
            'link' => route('negociation.show', $this->Negociation->id),
        ]);

        $this->sendRenterNotification([
            'subject' => 'A documentação foi recebida com sucesso',
            'title' => 'Documentação Recebida',
            'message' => 'A sua documentação foi recebida. Você receberá um aviso automático assim que nossa equipe concluir a análise dos documentos.',
            'recomendation' => 'Confira sua negociação abaixo:',
            'link' => route('negociation.show', $this->Negociation->id),
        ]);

        $this->sendAdminsNotification([
            'subject' => 'Documentação Recebida - Imóvel ' . $this->Property->id,
            'title' => 'Documentação Recebida',
            'message' => 'Documentação Recebida'
        ]);

        return true;
    }

    public function acceptedDocumentationNegociationNotify()
    {
        if (self::DEBUG) return;
        $this->sendRenterNotification([
            'subject' => 'Sua documentação referente a locação do imóvel '.$this->Negociation->property->id.' foi confirmada',
            'title' => 'Documentação Aceita',
            'message' => 'Sua documentação foi aprovada, agora falta só mais um passo. Seu contrato de aluguel já está disponível para assinatura.',
            'recomendation' => 'Confira sua negociação abaixo:',
            'link' => route('negociation.show', $this->Negociation->id),
        ]);

        $this->sendAdminsNotification([
            'subject' => 'Documentação Aprovada - Imóvel ' . $this->Property->id,
            'title' => 'Documentação Aceita',
            'message' => 'Documentação Aceita'
        ]);

        return true;
    }

//    public function ownerAssignedNegociationNotify(){}

//    public function renterAssignedNegociationNotify(){}

    public function realizedNegociationNotify()
    {
        if (self::DEBUG) return;
        $this->sendOwnerNotification([
            'subject' => 'Sua negociação referente a locação do imóvel ' . $this->Property->id . ' foi concluída',
            'title' => 'Negociação Concluída',
            'message' => 'Parabéns! Sua locação foi efetuada com sucesso, agora basta agendar a entrega das chaves conforme termos e prazos acordados na proposta inicial.',
            'recomendation' => 'Confira sua via do contrato abaixo:',
            'link' => route('negociation.show', $this->Negociation->id),
        ]);

        $this->sendRenterNotification([
            'subject' => 'Sua negociação referente a locação do imóvel ' . $this->Property->id . ' foi concluída',
            'title' => 'Negociação Concluída',
            'message' => 'Parabéns! Sua locação foi efetuada com sucesso, agora basta agendar a entrega das chaves conforme termos e prazos acordados na proposta inicial.',
            'recomendation' => 'Confira sua via do contrato abaixo:',
            'link' => route('negociation.show', $this->Negociation->id),
        ]);

        $this->sendAdminsNotification([
            'subject' => 'Negociação Concluída - Imóvel ' . $this->Property->id,
            'title' => 'Negociação Concluída',
            'message' => 'Negociação Concluída'
        ]);

        return true;
    }


}