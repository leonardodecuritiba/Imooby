@extends('site.layouts.map.template')
@section('styles_content')
    <style type="text/css">
        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            background-color: #00a7ec;
        }

        .modal-content {
            border-radius: 0px;
        }

        .modal-body {
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 30px;
        }

        .label_perfil {
            font-weight: bold;
            margin-top: 5px;
        }

        .sombra_total {
            -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.13);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.13);
            border: 1px solid #ddd;
            border-radius: 0px;
        }

        .topo_painel {
            background-color: #00A7EC !important;
            border-color: #00A7EC !important;
            border-radius: 0px !important;
            color: #fff !important;
        }

        .campos_perfil {
            padding: 2px 10px;
            border-radius: 0px;
        }

        .file-input-new {
            border-color: transparent;
        }

        .btn-o.btn-default {
            border-radius: 0px;
        }

        .file-preview {
            display: none;
        }
    </style>
@endsection
@section('body_content')

    <!-- Bar Navigation -->
    @include('site.layouts.menu.navbar')

    <!-- Left Side Navigation -->
    @include('site.layouts.menu.sidebar')
    <!-- Content -->
    <div id="wrapper" style="background-color: #eee;">
        <div class="container">
            <div class="sombra_total"
                 style="background-color: #fff; margin-top: 20px; padding: 20px; margin-bottom: 20px;">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="h3title"><i class="fa fa-edit"></i>Meu <b>Perfil</b></h3>
                    </div>
                    {{Form::open(['route' => 'profile.update', 'method'=>'POST'])}}
                    <div class="col-md-2 text-center" style="margin-bottom: 20px;">
                        <img src="{{$_SELF_TEMPLATE_['Profile']->getThumbPhoto()}}"
                             style="width: 100%; margin-bottom: 5px;">
                        <a href="" data-toggle="modal" data-target="#modal_trocar_foto" class="btn btn-warning btn-xs btn-block" style="border-radius: 0px;"><i class="fa fa-edit"></i> Trocar foto</a>
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default" style="border-radius: 0px;">
                                    <div class="panel-heading topo_painel">
                                        <b style="font-size: 16px;">Dados do cliente</b>
                                    </div>
                                    <div class="panel-body" style="border-radius: 0px;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="label_perfil">Nome</label>
                                                <input type="text" class="form-control campos_perfil" name="name"
                                                       value="{{$_SELF_TEMPLATE_['Profile']->name}}"
                                                       placeholder="Digite o seu nome" required>
                                            </div>
{{--                                             <div class="col-md-6">
                                                <label class="label_perfil">Email</label>
                                                <input type="text" class="form-control campos_perfil" name="email" value="{{$_SELF_TEMPLATE_['Profile']->user->email}}" placeholder="Seu email" required>
                                            </div> --}}
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="label_perfil">Telefone</label>
                                                <input type="text" id="telefone" class="sp_celphones form-control campos_perfil" name="phone" value="{{$_SELF_TEMPLATE_['Profile']->contact->getFormatedPhone()}}" placeholder="Digite o seu telefone">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="label_perfil">Celular</label>
                                                <input type="text" id="celular" class="sp_celphones form-control campos_perfil"
                                                       name="cellphone"
                                                       value="{{$_SELF_TEMPLATE_['Profile']->contact->getFormatedCellphone()}}"
                                                       placeholder="Digite o seu celular">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default" style="border-radius: 0px;">
                                    <div class="panel-heading topo_painel">
                                        <b style="font-size: 16px;">Dados bancários</b>
                                    </div>
                                    @php
                                        $bank = \Auth::user()->client->bankData;
                                    @endphp
                                    <div class="panel-body" style="border-radius: 0px;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="label_perfil">Banco</label>
                                            <select name="bank_id" id="input" class="form-control">
                                            <option>Selecione um banco</option>
                                            @foreach(\App\Models\Bank::orderBy('code')->get() as $banco)
                                                <option value="{{ $banco->code }}"{!! $bank->bank_id == $banco->id ? ' selected="selected"' : '' !!}>{{ $banco->code }} - {{ $banco->name }}</option>
                                            @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label class="label_perfil">Agência Bancária</label>
                                                <input type="text" class="form-control" name="agency" value="{{ $bank->agency }}" placeholder="Sua agência bancária">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label class="label_perfil">Tipo de conta</label>
                                                <select name="account_type" id="input" class="form-control">
                                                    <option>Selecione um tipo de conta</option>
                                                    <option value="1"{!! $bank->account_type == 1 ? ' selected="selected"' : '' !!}>Conta corrente</option>
                                                    <option value="2"{!! $bank->account_type == 2 ? ' selected="selected"' : '' !!}>Poupança</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <label class="label_perfil">Número da conta:</label>
                                                <input type="text" name="account_number" value="{{ $bank->account_number }}" class="form-control" placeholder="Número da conta">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <label class="label_perfil">Nome do titular</label>
                                                <input type="text" name="owner_name" value="{{ $bank->owner_name }}" class="form-control" placeholder="Nome do titular">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <label class="label_perfil">CPF do titular</label>
                                                <input type="text" name="cpf" value="{{ $bank->cpf }}" class="form-control" placeholder="CPF do titular">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{--Address--}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default" style="border-radius: 0px;">
                                    <div class="panel-heading topo_painel">
                                        <b style="font-size: 16px;">Dados de endereço</b>
                                    </div>
                                    <div class="panel-body" style="border-radius: 0px;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="label_perfil">Cep</label>
                                                <input type="text" class="form-control campos_perfil" name="zip" value="{{$_SELF_TEMPLATE_['Profile']->address->getFormatedZip()}}" placeholder="Digite o seu cep">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="label_perfil">Estado</label>
                                                <select class="form-control campos_perfil" name="state">
                                                    <option value="">Selecione o Estado</option>
                                                    @foreach($_SELF_TEMPLATE_['States'] as $state)
                                                        <option value="{{$state['sigla']}}"
                                                                @if($state['sigla'] == $_SELF_TEMPLATE_['Profile']->address['state']) selected @endif>{{$state['nome']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="label_perfil">Cidade</label>
                                                <input type="text" class="form-control campos_perfil" name="city"
                                                       value="{{$_SELF_TEMPLATE_['Profile']->address->city}}"
                                                       placeholder="Digite o seu cidade">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="label_perfil">Bairro</label>
                                                <input type="text" class="form-control campos_perfil" name="district"
                                                       value="{{$_SELF_TEMPLATE_['Profile']->address->district}}"
                                                       placeholder="Digite o seu bairro">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="label_perfil">Rua</label>
                                                <input type="text" class="form-control campos_perfil" name="street"
                                                       value="{{$_SELF_TEMPLATE_['Profile']->address->street}}"
                                                       placeholder="Digite a sua rua">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="label_perfil">Número</label>
                                                <input type="text" class="form-control campos_perfil" name="number" value="{{$_SELF_TEMPLATE_['Profile']->address->number}}" placeholder="Digite o número">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="label_perfil">Complemento</label>
                                                <input type="text" class="form-control campos_perfil" name="complement" value="{{$_SELF_TEMPLATE_['Profile']->address->complement}}" placeholder="Digite o complemento">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-3 col-md-3">
                                <button href="" class="btn btn-success btn-block"
                                        style="background-color: #00A7EC; border-color: #00A7EC; font-weight: bold; border-radius: 0px; margin-top: 10px;"><i
                                            class="fa fa-save"></i> Salvar
                                </button>
                            </div>
                            <div class="col-md-3">
                                <a href="" class="btn btn-warning btn-block" data-toggle="modal"
                                   data-target="#modal_alterar_senha"
                                   style="font-weight: bold; border-radius: 0px; margin-right: 10px; margin-top: 10px;"><i
                                            class="fa fa-lock"></i> Alterar Senha</a>
                            </div>
                            <div class="col-md-3">
                                <a href="" disabled="" class="btn btn-danger btn-block" data-toggle="modal"
                                   {{--data-target="#modal_excluir_conta"--}}
                                   style="font-weight: bold; border-radius: 0px; margin-right: 10px; margin-top: 10px;"><i
                                            class="fa fa-times"></i> Excluir Conta</a>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts_content')
@endsection
@section('modals_content')
    @include('site.layouts.modal.change_photo')
    @include('site.layouts.modal.delete_profile')
    @include('site.layouts.modal.change_pwd')
@endsection