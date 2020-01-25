@extends('site.layouts.map.template')
@section('styles_content')

    {{Html::style('assets_site/vendor/datetimepicker-master/build/jquery.datetimepicker.min.css')}}
    @include('helpers.negociations.css')
@endsection
@section('modals_content')
@endsection
@section('body_content')

    <!-- Bar Navigation -->
    @include('site.layouts.menu.navbar')

    <!-- Left Side Navigation -->
    @include('site.layouts.menu.sidebar')
    <!-- Content -->


    <div id="wrapper" style="background-color: #eee;">
        <div class="container">
            <div class="row" style="margin-top: 100px;">
                <div class="col-xs-12">
                    <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                        <li class="disabled"><a href="#step-1">
                                <h4 class="list-group-item-heading">Aceitar Proposta</h4>
                                <p class="list-group-item-text">Primeiro Passo</p>
                            </a></li>
                        <li class="disabled"><a href="#step-2">
                                <h4 class="list-group-item-heading">Aceitar condições</h4>
                                <p class="list-group-item-text">Segundo Passo</p>
                            </a></li>
                        <li class="disabled"><a href="#step-3">
                                <h4 class="list-group-item-heading">Documentação</h4>
                                <p class="list-group-item-text">Terceiro Passo</p>
                            </a></li>
                        <li class="disabled"><a href="#step-4">
                                <h4 class="list-group-item-heading">Assinatura</h4>
                                <p class="list-group-item-text">Quarto Passo</p>
                            </a></li>
                    </ul>
                </div>
            </div>

            <div class="loader esconda"></div>

            {{--Proposta--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 well setup-content text-center" id="step-1">
                        <div class="row bs-wizard" style="border-bottom:0;">
                            <div class="col-xs-6 bs-wizard-step disabled">
                                <div class="text-center bs-wizard-stepnum">Preenchimento</div>
                                <div class="progress"><div class="progress-bar"></div></div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center"></div>
                            </div>
                            <div class="col-xs-6 bs-wizard-step disabled"><!-- complete -->
                                <div class="text-center bs-wizard-stepnum">Aprovação</div>
                                <div class="progress"><div class="progress-bar"></div></div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center"></div>
                            </div>
                        </div>
                        <hr>
                        <h2 style="margin-bottom: 20px; color: #00A7EC;"><b>Proposta</b></h2>
                        {{Form::open(['route'=>['negociation.update.acceptRenterPropose',$_SELF_TEMPLATE_['Negociation']->id],'method'=>'POST','class'=>'ajax'])}}
                        <div class="row">
                            <div class="col-md-offset-2 col-md-8" style="color: #00A7EC; font-size: 14px;">
                                <p>Muito bem! Parece que tem alguém interessado em alugar seu imóvel. Nessa etapa, você poderá conferir todos os valores,
                                    quem vai morar no imóvel, data da mudança, e, se for o caso, eventual condição específica do inquilino.</p>
                            </div>
                        </div>
                        <div class="row" style="color: #777; margin-top: 30px;">
                            <div class="col-md-offset-3 col-md-3 text-center">
                                <h4>Aluguel</h4>
                            </div>
                            <div class="col-md-3 text-center">
                                <h4>{{$_SELF_TEMPLATE_['Negociation']->priceRentalTotalReal()}} / Mês</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-offset-3 col-md-3 text-center">
                                <h4>Condomínio</h4>
                            </div>
                            <div class="col-md-3 text-center">
                                <h4>{{$_SELF_TEMPLATE_['Negociation']->priceCondominiumReal()}} / Mês</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-offset-3 col-md-3 text-center">
                                <h4>Taxas</h4>
                            </div>
                            <div class="col-md-3 text-center">
                                <h4>{{$_SELF_TEMPLATE_['Negociation']->priceFeeReal()}} / Mês</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-offset-3 col-md-3 text-center">
                                <h4>IPTU</h4>
                            </div>
                            <div class="col-md-3 text-center">
                                <h4>{{$_SELF_TEMPLATE_['Negociation']->priceIptuReal()}} / Mês</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-12 text-center">
                                <h4>Quem vai morar no seu imóvel?</h4>
                                <p>Descrição das pessoas que irão morar no seu imóvel.</p><br>
                            </div>
                            <div class="col-md-offset-3 col-md-6 text-center">
                                <textarea class="form-control" rows="5" name="residents" disabled>{{$_SELF_TEMPLATE_['Negociation']->residents}}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-12 text-center">
                                <h4>Quando o locatário pretende se mudar?</h4>
                            </div>
                            <div class="col-md-offset-3 col-md-6 text-center">
                                <input type="text" class="form-control" name="date_change" value="{{$_SELF_TEMPLATE_['Negociation']->date_change}}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-12 text-center">
                                <h4>O locatário tem ou pretende ter animais de estimação?</h4>
                            </div>
                            <div class="col-md-offset-3 col-md-6 text-center">
                                <select class="form-control" name="animals" disabled>
                                    <option value="0" @if(!$_SELF_TEMPLATE_['Negociation']->animals) selected @endif>Não</option>
                                    <option value="1" @if($_SELF_TEMPLATE_['Negociation']->animals) selected @endif>Sim</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-12 text-center">
                                <h4>Condições do locatário</h4>
                            </div>
                            <div class="col-md-offset-3 col-md-6 text-center">
                                <textarea class="form-control" rows="5" name="renter_conditions" disabled>{{$_SELF_TEMPLATE_['Negociation']->renter_conditions}}</textarea>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-danger btn-lg btn-cancelar"><i class="fa fa-times"></i> Cancelar</button>
                                <button id="accept-renter-propose" class="btn btn-success btn-lg"><i class="fa fa-arrow-right"></i> Aprovar e Avançar</button>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>

            {{--Aceitar Condições--}}
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-md-12 well setup-content text-center" id="step-2">
                        <h2 style="margin-bottom: 20px; color: #00A7EC;">Aceitar <b>Condições</b></h2>
                        <div class="row">
                            <div class="col-md-offset-2 col-md-8" style="color: #00A7EC; font-size: 14px;">
                                <p>Antes de realizar o envio da sua proposta, você precisa aceitar as condições do Imooby, todas as informações necessárias estão disponíveis de forma transparente, leia com atenção cada uma das condições e, ao acordar com elas, vamos prosseguir com sua proposta de locação.</p>
                            </div>
                            {{Form::open(['route'=>['negociation.update.acceptOwnerConditions',$_SELF_TEMPLATE_['Negociation']->id],'method'=>'POST','class'=>'ajax'])}}
                            <div class="row" style="margin-top: 50px;">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <p>{{$_SELF_TEMPLATE_['Conditions']}}</p>
                                        </div>
                                        <div class="panel-footer">
                                            <input type="checkbox" name="owner_accept_conditions" @if($_SELF_TEMPLATE_['Negociation']->owner_accept_conditions) checked @endif required> Aceito as condições do Imooby
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-danger btn-lg btn-cancelar"><i class="fa fa-times"></i> Cancelar</button>
                                    <button id="accept-owner-conditions" class="btn btn-success btn-lg"><i class="fa fa-arrow-right"></i> Aceitar e Avançar</button>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>

            {{--Documentação--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 well setup-content text-center" id="step-3">
                        <div class="row bs-wizard" style="border-bottom:0;">
                            <div class="col-xs-6 bs-wizard-step disabled">
                                <div class="text-center bs-wizard-stepnum">Preenchimento</div>
                                <div class="progress"><div class="progress-bar"></div></div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center"></div>
                            </div>
                            <div class="col-xs-6 bs-wizard-step disabled"><!-- complete -->
                                <div class="text-center bs-wizard-stepnum">Aprovação</div>
                                <div class="progress"><div class="progress-bar"></div></div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center"></div>
                            </div>
                        </div>
                        <h2 style="margin-bottom: 20px; color: #00A7EC;" class="text-center"><b>Documentação</b></h2>
                        <div class="row text-center">
                            <div class="col-md-offset-2 col-md-8" style="color: #00A7EC; font-size: 14px;">
                                <p>Estamos quase acabando, agora basta você preencher os campos abaixo com informações e documentos.
                                </p>
                            </div>
                        </div>
                        {{Form::open(['route'=>['negociation.update.submitOwnerDocuments',$_SELF_TEMPLATE_['Negociation']->id],'method'=>'POST', 'files'=>true])}}

                        <?php $owner_document = $_SELF_TEMPLATE_['Negociation']->owner_document;?>
                        <div class="row" style="color: #777; margin-top: 30px;">
                            <div class="col-md-offset-3 col-md-3">
                                <label class="negrito">Nome</label>
                                <input type="text" class="form-control campos" name="name" max="100" value="{{($owner_document!=NULL) ? $owner_document->name : old('name')}}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="negrito">E-mail</label>
                                <input type="text" class="form-control campos" name="email" max="60"  value="{{($owner_document!=NULL) ? $owner_document->email : old('email')}}" required>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-offset-3 col-md-3">
                            <label class="negrito">Código IPTU do Imóvel:</label>
                            <input type="text" id="iptu_code" class="form-control" name="iptu_code" value="{{($owner_document!=NULL) ? $owner_document->iptu_code : old('iptu_code')}}" required>
                            </div>
                            <div class="col-md-3">
                            <label class="negrito">Número da Matrícula:</label>
                            <input type="text" id="iptu_registration" class="form-control" name="iptu_registration" value="{{($owner_document!=NULL) ? $owner_document->iptu_registration : old('iptu_registration')}}" required>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-offset-3 col-md-3">
                                <label class="negrito">Cpf</label>
                                <input type="text" id="cpf" class="form-control show-cpf" name="cpf"
                                       value="{{($owner_document!=NULL) ? $owner_document->cpf : old('cpf')}}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="negrito">Estado Cívil {{(($owner_document!=NULL) && ($owner_document->civil_status == "Casado"))}}</label>
                                <select class="form-control campos" name="civil_status" required>
                                    <option value="">Selecione</option>
                                    <option value="Casado" {{((($owner_document!=NULL) && ($owner_document->civil_status == "Casado")) || (old('civil_status') == "Casado")) ? 'selected' : ''}}>Casado</option>
                                    <option value="Solteiro" {{((($owner_document!=NULL) && ($owner_document->civil_status == "Solteiro")) || (old('civil_status') == "Solteiro")) ? 'selected' : ''}}>Solteiro</option>
                                    <option value="Divorciado" {{((($owner_document!=NULL) && ($owner_document->civil_status == "Divorciado")) || (old('civil_status') == "Divorciado")) ? 'selected' : ''}}>Divorciado</option>
                                    <option value="Separado" {{((($owner_document!=NULL) && ($owner_document->civil_status == "Separado")) || (old('civil_status') == "Separado")) ? 'selected' : ''}}>Separado</option>
                                    <option value="Viúvo" {{((($owner_document!=NULL) && ($owner_document->civil_status == "Viúvo")) || (old('civil_status') == "Viúvo")) ? 'selected' : ''}}>Viúvo</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-offset-3 col-md-3">
                                <label class="negrito">Telefone</label>
                                <input type="text" class="form-control campos show-telefone" name="phone" max="11"
                                       value="{{($owner_document!=NULL) ? $owner_document->phone : old('phone')}}"
                                       required>
                            </div>
                            <div class="col-md-3">
                                <label class="negrito">Celular</label>
                                <input type="text" class="form-control campos show-celular" name="cellphone" max="11"
                                       value="{{($owner_document!=NULL) ? $owner_document->cellphone : old('cellphone')}}"
                                       required>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-offset-3 col-md-4">
                                <label class="negrito">RG, CNH ou RNE <letrafina style="font-weight: normal; font-size: 12px;">(Anexar Foto)</letrafina></label>
                                <input type="file" class="form-control" name="doc_link" {{($owner_document!=NULL) ? '' : 'required'}}>
                            </div>
                            <div class="col-md-2">
                                @if($owner_document!=NULL)
                                    <img src="{{$owner_document->getDocImage()}}" style="width: 100%;">
                                @else
                                    <img src="https://www.pressworks.com.br/upload/editor/images/RG_red2.jpg" style="width: 100%;">
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-offset-3 col-md-4">
                                <label class="negrito">CPF <letrafina style="font-weight: normal; font-size: 12px;">(Anexar Foto)</letrafina></label>
                                <input type="file" class="form-control" name="cpf_link" {{($owner_document!=NULL) ? '' : 'required'}}>
                            </div>
                            <div class="col-md-2">
                                @if($owner_document!=NULL)
                                    <img src="{{$owner_document->getCpfImage()}}" style="width: 100%;">
                                @else
                                    <img src="https://www.pressworks.com.br/upload/editor/images/RG_red2.jpg" style="width: 100%;">
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="color: #777;">
                            <div class="col-md-offset-3 col-md-4">
                                <label class="negrito">Comprovante de Residência <letrafina style="font-weight: normal; font-size: 12px;">(Anexar Foto)</letrafina></label>
                                <input type="file" class="form-control" name="address_proof_link" {{($owner_document!=NULL) ? '' : 'required'}}>
                            </div>
                            <div class="col-md-2">
                                @if($owner_document!=NULL)
                                    <img src="{{$owner_document->getAddressProofImage()}}" style="width: 100%;">
                                @else
                                    <img src="https://www.pressworks.com.br/upload/editor/images/RG_red2.jpg" style="width: 100%;">
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-danger btn-lg btn-cancelar"><i class="fa fa-times"></i> Cancelar</button>
                                <button id="submit-owner-documents" class="btn btn-success btn-lg"><i class="fa fa-arrow-right"></i> Enviar e Avançar</button>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>

            {{--Aceitar Condições--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 well setup-content text-center" id="step-4">
                        <h2 style="margin-bottom: 20px; color: #00A7EC;" class="text-center"><b>Assinatura</b></h2>
                        <div class="row text-center">
                            <div class="col-md-offset-2 col-md-8" style="color: #00A7EC; font-size: 14px;">
                                <p>Este é o ultimo passo.</p>
                            </div>
                        </div>
                        @php
                        $negotiation = $_SELF_TEMPLATE_['Negociation'];
                        $document_uuid = $negotiation->signature_document_uuid;
                        $document_status = $negotiation->verifySignature();
                        @endphp
                        @if($document_status==3)  {{-- Aguardando assinatura --}}
                        @php
                        $owner = $negotiation->owner_document()->where(['status'=>1])->first();
                        $negotiation_id = $negotiation->id;
                        $signer_email = $owner->email;
                        $signer_name = $owner->name;
                        $signer_cpf = $owner->cpf;
                        @endphp
                        @include('d4sign.main')
                        @elseif($document_status==4 || $document_status==5) {{-- Assinatura concluida --}}
                        O contrato foi assinado com sucesso por ambas as partes!
                        @else
                        <center>O contrato ainda não está pronto para ser assinado, por favor aguarde.</center>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts_content')
    {{Html::script('assets_site/vendor/datetimepicker-master/build/jquery.datetimepicker.full.min.js')}}
    <script type="text/javascript">
        jQuery.datetimepicker.setLocale('pt-BR');
        $(document).ready(function () {
            var amanha = new Date();
            amanha.setDate(amanha.getDate() + 1);
            $('input[name=date_change]').datetimepicker({
                minDate: amanha,
                startDate: amanha,
                format: 'd/m/Y',
                "beforeShowDay": function() {
                    $('.xdsoft_timepicker').hide()
                }
            });
        });
    </script>
    <script type="text/javascript">
        var i = 0;
        var $_CURRENT_STEP_ = JSON.parse('<?php echo $_SELF_TEMPLATE_['Negociation']->getCurrentStep();?>');
        var original = document.getElementById('duplicar_campos');
        function duplica_campo(){
            var clone = original.cloneNode(true); // "deep" clone
            clone.id = "duplicar_campos" + ++i;
            // or clone.id = ""; if the divs don't need an ID
            original.appendChild(clone);
        }

        function loading(option){
            var $container = $('div#wrapper div.container');
            if(option=='show'){
                $($container).find('div.loader').show();
            } else {
                $($container).find('div.loader').hide();
            }
        }

        function setCurrentStep(steps){
            if(!((steps.step == 1) && (steps.owner_step == 1))){
                var step = (steps.step > 0)?steps.step - 1:steps.step;
            } else {
                var step = steps.step;
            }

            //block/hide all others
            $('ul.setup-panel li').addClass('disabled').removeClass('active');
            $('.setup-content').hide();

            //unblock/show current
            $('ul.setup-panel li:eq(' + step + ')').removeClass('disabled').addClass('active');
            var $div_step = $("#step-" + (step + 1));
            $($div_step).show();
            $($div_step).parent().addClass('active');

            setCurrentSubstep(steps);
        }

        function setCurrentSubstep(steps){
            var step = steps.step;
            var owner_step = steps.owner_step;

            $("div.container b#step").html(step);
            $("div.container b#substep").html(owner_step);

            step = (step > 0)? step - 1 : step;

            //unblock/show current
            var $step_bar = $("#step-" + (step + 1)).find('div.bs-wizard');

            //disable all substeps
            var $substeps_bar = $($step_bar).find('div.bs-wizard-step');
            $($substeps_bar).addClass('disabled');
            $($substeps_bar).find('div.bs-wizard-info').html('Aguardando');

            if(owner_step > 0){

                //update substeps
                $($substeps_bar).each(function(i,v){
                    if(i<owner_step){
                        $(v).removeClass('disabled');
                        $(v).addClass('complete');
                        $(v).find('div.bs-wizard-info').html('Ok');
                    }
                })
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("form.ajax").submit(function(e){
                e.preventDefault();
            });

            var navListItems = $('ul.setup-panel li a'),
                allWells = $('.setup-content');

            allWells.hide();

            navListItems.click(function(e)
            {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this).closest('li');

                if (!$item.hasClass('disabled')) {
                    navListItems.closest('li').removeClass('active');
                    $item.addClass('active');
                    allWells.hide();
                    $target.show();
                }
            });

            $('ul.setup-panel li.active a').trigger('click');

            // DEMO ONLY //
            $('#accept-renter-propose').on('click', function(e) {
                var $form = $(this).parents('form');
                $($form).submit();
                $.ajax({
                    url: $($form).attr("action"),
                    type: 'POST',
                    data: $($form).serializeArray(),
                    dataType: "json",
                    beforeSend: function () {
                        loading('show');
                    },
                    complete: function (xhr, textStatus) {
                        loading('hide');
                    },
                    success: function (json) {
                        if (json.code) {
                            $('#modal_sucesso').modal('show');
                            $('#modal_sucesso').find('.conteudo_modal ul li').html(json.status);
                            var steps = JSON.parse(json.steps);
                            return setCurrentStep(steps);
                        } else {
                            $('#modal_danger').modal('show');
                            $('#modal_danger').find('.conteudo_modal ul').html('<li class="li_branco">' + json.status + '</li>');
                        }
                    }
                });
            })

            $('#accept-owner-conditions').on('click', function(e) {
                var $form = $(this).parents('form');
                $($form).submit();
                $.ajax({
                    url: $($form).attr("action"),
                    type: 'POST',
                    data: $($form).serializeArray(),
                    dataType: "json",
                    beforeSend: function () {
                        loading('show');
                    },
                    complete: function (xhr, textStatus) {
                        loading('hide');
                    },
                    success: function (json) {
                        if (json.code) {
                            $('#modal_sucesso').modal('show');
                            $('#modal_sucesso').find('.conteudo_modal ul li').html(json.status);
                            var steps = JSON.parse(json.steps);
                            return setCurrentStep(steps);
                        } else {
                            $('#modal_danger').modal('show');
                            $('#modal_danger').find('.conteudo_modal ul').html('<li class="li_branco">' + json.status + '</li>');
                        }
                    }
                });

                $('#submit-owner-documents').on('click', function(e) {
                    var $form = $(this).parents('form');
                    return $($form).submit();
                })
            })

            setCurrentStep($_CURRENT_STEP_);
        });
    </script>

    {!! Html::script('assets_site/vendor/jquery.inputmask/dist/min/inputmask/inputmask.min.js') !!}
    {!! Html::script('assets_site/vendor/jquery.inputmask/dist/min/inputmask/jquery.inputmask.min.js') !!}
    <script type="text/javascript">
        $(document).ready(function () {
            $('.show-cep').inputmask({'mask': '99999-999', 'removeMaskOnSubmit': true});
            $('.show-cpf').inputmask({'mask': '999.999.999-99', 'removeMaskOnSubmit': true});
            $('.show-cnpj').inputmask({'mask': '99.999.999/9999-99', 'removeMaskOnSubmit': true});
            $('.show-ie').inputmask({'mask': '999.999.999.999', 'removeMaskOnSubmit': true});
            $('.show-rg').inputmask({'mask': '99.999.999-9', 'removeMaskOnSubmit': true});
            $('.show-celular').inputmask({'mask': '(99) 99999-9999', 'removeMaskOnSubmit': true});
            $('.show-telefone').inputmask({'mask': '(99) 9999-9999', 'removeMaskOnSubmit': true});
        });
    </script>

    {!! Html::script('assets_site/vendor/jquery-maskmoney/dist/jquery.maskMoney.min.js') !!}
    <script type="text/javascript">
        function initMaskMoney(selector) {
            $(selector).maskMoney({
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });
        }
        $(document).ready(function () {
            initMaskMoney($(".show-valor"));
        });
        function initMaskMoneyPorcento(selector) {
            $(selector).maskMoney({
                suffix: ' %',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });
        }
        $(document).ready(function () {
            initMaskMoneyPorcento($(".show-porcento"));
        });
        function initMaskMoneyNumero(selector) {
            $(selector).maskMoney({allowNegative: false, precision: 0, thousands: '', decimal: '', affixesStay: false});
        }
        $(document).ready(function () {
            initMaskMoneyNumero($(".show-inteiro"));
        });
    </script>
@endsection