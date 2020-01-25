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
            <div class="negociation">
                <div class="loader esconda"></div>

                <div class="row" style="margin-top: 100px;">
                    <div class="col-xs-12">
                        <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                            <li class="disabled"><a href="#step-1">
                                    <h4 class="list-group-item-heading">Aceitar condições</h4>
                                    <p class="list-group-item-text">Primeiro Passo</p>
                                </a></li>
                            <li class="disabled"><a href="#step-2">
                                    <h4 class="list-group-item-heading">Proposta</h4>
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


                {{--Aceitar Condições--}}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-md-12 well setup-content text-center" id="step-1">
                            <h2 style="margin-bottom: 20px; color: #00A7EC;"><b>Aceitar Condições</b></h2>
                            <div class="row">
                                <div class="col-md-offset-2 col-md-8" style="color: #00A7EC; font-size: 14px;">
                                    <p>Antes de realizar o envio da sua proposta, você precisa aceitar as condições do Imooby, todas as informações necessárias estão disponíveis de forma transparente, leia com atenção cada uma das condições e, ao acordar com elas, vamos prosseguir com sua proposta de locação.</p>
                                </div>
                                {{Form::open(['route'=>['negociation.update.acceptRenterConditions',$_SELF_TEMPLATE_['Negociation']->id], 'method' => 'POST','class'=>'ajax'])}}
                                <input type="hidden" name="step" value="1">
                                <div class="row" style="margin-top: 50px;">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <p>{{$_SELF_TEMPLATE_['Conditions']}}</p>
                                            </div>
                                            <div class="panel-footer">
                                                <input type="checkbox" name="renter_accept_conditions" @if($_SELF_TEMPLATE_['Negociation']->renter_accept_conditions) checked @endif required> Aceito as condições do Imooby
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a class="btn btn-danger btn-lg btn-cancelar"><i class="fa fa-times"></i>
                                            Cancelar</a>
                                        <button id="accept-renter-conditions" class="btn btn-success btn-lg"><i class="fa fa-arrow-right"></i> Aceitar e Avançar</button>
                                    </div>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>

                {{--Proposta--}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12 well setup-content text-center" id="step-2">
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
                            {{Form::open(['route'=>['negociation.update.submitRenterPropose',$_SELF_TEMPLATE_['Negociation']->id], 'method' => 'POST','class'=>'ajax'])}}
                            <input type="hidden" name="step" value="2">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-8" style="color: #00A7EC; font-size: 14px;">
                                    <p>Proposta de locação, Muito bem! Parece que você encontrou seu novo lar.
                                        Nessa etapa, você poderá conferir todos os valores, descrever um pouco mais sobre você e, caso queira, propor alguma condição específica para o proprietário.</p>
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
                                    <h4>Comprovação de renda</h4>
                                </div>
                                <div class="col-md-12 text-center">
                                    <p>A soma da renda de todos os locatários (que podem ser até 4) deve ser igual ou superior a 3 vezes o valor do aluguel acordado.</p><br>
                                    <input type="checkbox" name="income_proof" @if($_SELF_TEMPLATE_['Negociation']->income_proof) checked @endif required> Aceito as condições do Imooby
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="color: #777;">
                                <div class="col-md-12 text-center">
                                    <h4>Quem vai morar no imóvel?</h4>
                                    <p>Descreva as pessoas que vão morar no imóvel e grau de parentesco, se houver.</p><br>
                                </div>
                                <div class="col-md-offset-3 col-md-6 text-center">
                                    <textarea class="form-control" rows="5" name="residents" required>{{$_SELF_TEMPLATE_['Negociation']->residents}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="color: #777;">
                                <div class="col-md-12 text-center">
                                    <h4>Quando você pretende se mudar?</h4>
                                </div>
                                <div class="col-md-offset-3 col-md-6 text-center">
                                    <input type="text" class="form-control" name="date_change" value="{{$_SELF_TEMPLATE_['Negociation']->date_change}}" required>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="color: #777;">
                                <div class="col-md-12 text-center">
                                    <h4>Você tem ou pretende ter animais de estimação?</h4>
                                    <p>Alguns proprietários podem eventualmente ter alguma restrição em relação animais em seus imóveis, <br>você pode deixar claro essa informação, assim tudo fica transparente desde o início.</p>
                                </div>
                                <div class="col-md-offset-3 col-md-6 text-center">
                                    <select class="form-control" name="animals" required>
                                        <option value="0" @if(!$_SELF_TEMPLATE_['Negociation']->animals) selected @endif>Não</option>
                                        <option value="1" @if($_SELF_TEMPLATE_['Negociation']->animals) selected @endif>Sim</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="color: #777;">
                                <div class="col-md-12 text-center">
                                    <h4>Condições de locação</h4>
                                    <p>Você tem alguma condição específica para alugar o imóvel?</p>
                                </div>
                                <div class="col-md-offset-3 col-md-6 text-center">
                                    <textarea class="form-control" rows="5" name="renter_conditions">{{$_SELF_TEMPLATE_['Negociation']->renter_conditions}}</textarea>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col-md-12 text-right">
                                    <a class="btn btn-danger btn-lg btn-cancelar"><i class="fa fa-times"></i>
                                        Cancelar</a>
                                    <button id="send-renter-propose" class="btn btn-success btn-lg"><i class="fa fa-arrow-right"></i> Aceitar e Avançar</button>
                                </div>
                            </div>
                            {{Form::close()}}
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
                                    <div class="bs-wizard-info text-center">Aguardando</div>
                                </div>

                                <div class="col-xs-6 bs-wizard-step disabled"><!-- complete -->
                                    <div class="text-center bs-wizard-stepnum">Aprovação</div>
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="#" class="bs-wizard-dot"></a>
                                    <div class="bs-wizard-info text-center">Aguardando</div>
                                </div>
                            </div>
                            <h2 style="margin-bottom: 20px; color: #00A7EC;" class="text-center"><b>Documentação</b></h2>
                            <div class="row text-center">
                                <div class="col-md-offset-2 col-md-8" style="color: #00A7EC; font-size: 14px;">
                                    <p>Estamos quase acabando, agora basta você preencher os campos abaixo com informações e documentos.
                                    </p>
                                </div>
                            </div>
                            {{Form::open(['route'=>['negociation.update.submitRenterDocuments',$_SELF_TEMPLATE_['Negociation']->id],'method'=>'POST', 'files'=>true])}}
                            <div id="duplicar_campos" class="campos-duplicados">
                                @if($_SELF_TEMPLATE_['Negociation']->renter_documents->count())
                                    <input type="hidden" name="update" value="1">
                                    @foreach($_SELF_TEMPLATE_['Negociation']->renter_documents as $i => $renter_document)
                                        @include('site.profile.negociations.forms.renter_documents')
                                    @endforeach
                                @else
                                    <?php $renter_document = NULL; $i = 0; ?>
                                    @include('site.profile.negociations.forms.renter_documents')
                                @endif
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col-md-12 text-right">
                                    <a class="btn btn-primary pull-left btn-lg btn-duplicar"
                                       style="background-color: green; border-color: green;"><i class="fa fa-plus"></i>
                                        Adicionar Pessoa</a>
                                    <a class="btn btn-danger btn-lg btn-cancelar"><i class="fa fa-times"></i>
                                        Cancelar</a>
                                    <button class="btn btn-success btn-lg"><i class="fa fa-arrow-right"></i> Enviar e Avançar</button>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>

                {{--Assinatura--}}
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
                        $renter = $negotiation->renter_documents()->where(['status'=>1])->first();
                        $negotiation_id = $negotiation->id;
                        $signer_email = $renter->email;
                        $signer_name = $renter->name;
                        $signer_cpf = $renter->cpf;
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
//        var $_STEPS_
        var i = 0;
        var $_CURRENT_STEP_ = JSON.parse('<?php echo $_SELF_TEMPLATE_['Negociation']->getCurrentStep();?>');
        var original = document.getElementById('duplicar_campos');

$('a.btn-duplicar').click(function () {
            var clone = original.cloneNode(true); // "deep" clone
            clone.id = "duplicar_campos_" + ++i;
            // or clone.id = ""; if the divs don't need an ID
            original.append(clone);
            $(clone).find('div.esconda').removeClass('esconda');
            $($(clone).find('input,select')).each(function(){
                $(this).attr('name',$(this).attr('name').replace('0',i));
                $(this).val('');
                if ($(this).hasClass('show-valor')) {
                    initMaskMoney($(this));
                } else if ($(this).hasClass('show-cpf')) {
                    $(this).inputmask({'mask': '999.999.999-99', 'removeMaskOnSubmit': true});
                } else if ($(this).hasClass('show-celular')) {
                    $(this).inputmask({'mask': '(99) 99999-9999', 'removeMaskOnSubmit': true});
                } else if ($(this).hasClass('show-telefone')) {
                    $(this).inputmask({'mask': '(99) 9999-9999', 'removeMaskOnSubmit': true});
                }
            });
        });

        function remover_campos($this){
            var $parent = $($this).parents('div.campos-duplicados').first();
            $($parent).remove();
        }

        function loading(option){
            var $container = $('div#wrapper div.container');
            if(option=='show'){
                $($container).find('div.loader').removeClass('esconda');
            } else {
                $($container).find('div.loader').addClass('esconda');
            }
        }

        function setCurrentStep(steps){
            var step = (steps.step > 2)?steps.step - 1:steps.step;

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
            var renter_step = steps.renter_step;

            $("div.container b#step").html(step);
            $("div.container b#substep").html(renter_step);

            if(!((step == 3) && (renter_step==1))){
                step = (step >= 1)? step + 1 : step;
            }

            //unblock/show current
            var $step_bar = $("#step-" + step).find('div.bs-wizard');

            //disable all substeps
            var $substeps_bar = $($step_bar).find('div.bs-wizard-step');
            $($substeps_bar).addClass('disabled');
            $($substeps_bar).find('div.bs-wizard-info').html('Aguardando');

            if(renter_step > 0){

                //update substeps
                $($substeps_bar).each(function(i,v){
                    if(i<renter_step){
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
            $('#accept-renter-conditions, #send-renter-propose').on('click', function (e) {
                var $form = $(this).parents('form');
                $($form).submit();
                $.ajax({
                    url: $($form).attr("action"),
                    type: $($form).attr("method"),
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

            $('#activate-step-4').on('click', function(e) {
                var steps = {};
                steps.setp = 4;
                steps.renter_step = 1;
                return setCurrentSteps(steps);
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