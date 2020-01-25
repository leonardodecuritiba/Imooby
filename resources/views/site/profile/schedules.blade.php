@extends('site.layouts.map.template')
@section('styles_content')
    {{Html::style('assets_site/vendor/datetimepicker-master/build/jquery.datetimepicker.min.css')}}
    <style type="text/css">
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

        @media only screen and (max-width: 800px) {
            /* Force table to not be like tables anymore */
            #no-more-tables table,
            #no-more-tables thead,
            #no-more-tables tbody,
            #no-more-tables th,
            #no-more-tables td,
            #no-more-tables tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            #no-more-tables thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            #no-more-tables tr {
                border: 1px solid #ccc;
            }

            #no-more-tables td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                white-space: normal;
                text-align: left;
            }

            #no-more-tables td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }

            /*
            Label the data
            */
            #no-more-tables td:before {
                content: attr(data-title);
            }
        }

        .botao_pequeno {
            border-radius: 0px;
        }

        .datepicker {
            z-index: 1151 !important;
        }
    </style>
@endsection
@section('modals_content')
    @include('site.layouts.modal.reschedule')
    @include('site.layouts.modal.cancel_schedule')
    @include('site.layouts.modal.confirm_schedule')
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
                        <h3 class="h3title"><i class="fa fa-list"></i><b>Agendamentos</b></label>
                    </div>
                    <div class="col-md-12">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" style="border-radius: 0px;">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <div class="row" style="margin-top: -10px;">
                                            <div class="col-md-3">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#agendamentos">
                                                    <button class="btn btn-primary btn-block"
                                                            style="color: #fff; background-color: #00A7EC; border-color: #00A7EC; border-radius: 0px; margin-top: 10px;">
                                                        Agenda Proprietário
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#minhaagenda">
                                                    <button class="btn btn-primary btn-block"
                                                            style="color: #fff; background-color: #00A7EC; border-color: #00A7EC; border-radius: 0px; margin-top: 10px;">
                                                        Agenda Inquilino
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </h4>
                                </div>
                                <div id="agendamentos" class="panel-collapse collapse in">
                                    <div class="panel-body" style="border-radius: 0px;">
                                        <label class="form-label" style="font-size: 1.5em;">Agenda Proprietário</label>
                                        <p>Confira abaixo todos os interessados em visitar seu imóvel, confirme caso
                                            tenha
                                            disponibilidade para a data solicitada, eventuais reagendamentos ou
                                            cancelamentos
                                            devem ser efetuados com 24 horas de antecedência.</p>
                                        @if($_SELF_TEMPLATE_['Schedules']->count()>0)
                                            <table class="table table-responsive table-bordered table-striped"
                                                   id="no-more-tables">
                                                <thead>
                                                <tr>
                                                    <th><b>#</b></th>
                                                    <th><b>Meu Imóvel</b></th>
                                                    <th><b>Interessado</b></th>
                                                    <th><b>Data/Hora</b></th>
                                                    <th><b>Mensagem</b></th>
                                                    <th><b>Status</b></th>
                                                    <th><b>Opções</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($_SELF_TEMPLATE_['Schedules'] as $visit)
                                                    <tr>
                                                        <td>{{$visit->id}}</td>
                                                        <td data-title="Imóvel"><a
                                                                    href="{{route('ver-imovel',$visit->idproperty)}}">{{$visit->property->title}}</a>
                                                        </td>
                                                        <td data-title="Propietário">{{$visit->visitor->name}}</td>
                                                        <td data-title="DataHora">{{$visit->getDateHour()}}</td>
                                                        <td data-title="Mensagem">{{$visit->visitor_message}}</td>
                                                        <td data-title="Status">
                                                                <span class="btn btn-{{$visit->getStatusColor()}} btn-xs btn-block botao_pequeno">
                                                                    <i class="fa fa-{{$visit->getStatusIcon()}}"></i> {{$visit->getStatusText()}}</span>
                                                        </td>
                                                        <td data-title="Opções">
                                                            @if($visit->isConfirmed())
                                                                <a data-toggle="modal"
                                                                   href="#modal_reagendar_visita"
                                                                   data-href="{{route('schedule.refresh',$visit->id)}}"
                                                                   class="btn btn-default btn-xs btn-block botao_pequeno">Reagendar</a>
                                                                <a data-toggle="modal"
                                                                   href="#modal_cancelar_visita"
                                                                   data-href="{{route('schedule.cancel',$visit->id)}}"
                                                                   class="btn btn-danger btn-xs btn-block botao_pequeno">Cancelar</a>
                                                            @elseif($visit->isOpened())
                                                                @if(!$visit->isConfirmedByClient('visited_confirmation'))
                                                                    <a data-toggle="modal"
                                                                       href="#modal_confirmar_visita"
                                                                       data-href="{{route('schedule.owner_confirm',$visit->id)}}"
                                                                       class="btn btn-success btn-xs btn-block botao_pequeno">Confirmar</a>
                                                                @endif
                                                                <a data-toggle="modal"
                                                                   href="#modal_reagendar_visita"
                                                                   data-href="{{route('schedule.refresh',$visit->id)}}"
                                                                   class="btn btn-default btn-xs btn-block botao_pequeno">Reagendar</a>
                                                                <a data-toggle="modal"
                                                                   href="#modal_cancelar_visita"
                                                                   data-href="{{route('schedule.cancel',$visit->id)}}"
                                                                   class="btn btn-danger btn-xs btn-block botao_pequeno">Cancelar</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div style="margin-top:15px">
                                            <center>{{ $_SELF_TEMPLATE_['Schedules']->links() }}</center>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div id="minhaagenda" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <label class="form-label" style="font-size: 1.5em;">Agenda Inquilino</label>
                                        <p>Confira abaixo os imóveis que você tem interesse em visitar,
                                            acompanhe o status até que a visita seja confirmada pelo proprietário,
                                            eventuais reagendamentos ou cancelamentos devem ser efetuados com 24 horas
                                            de antecedência.</p>
                                        @if($_SELF_TEMPLATE_['Visits']->count()>0)
                                            <table class="table table-responsive table-bordered table-striped"
                                                   id="no-more-tables">
                                                <thead>
                                                <tr>
                                                    <th><b>#</b></th>
                                                    <th><b>Imóvel</b></th>
                                                    <th><b>Propietário</b></th>
                                                    <th><b>Data/Hora</b></th>
                                                    <th><b>Mensagem</b></th>
                                                    <th><b>Status</b></th>
                                                    <th colspan="2"><b>Opções</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($_SELF_TEMPLATE_['Visits'] as $visit)
                                                    <tr>
                                                        <td>{{$visit->id}}</td>
                                                        <td data-title="Imóvel"><a
                                                                    href="{{route('ver-imovel', $visit->property->id)}}">{{$visit->property->title}}</a>
                                                        </td>
                                                        <td data-title="Propietário">{{$visit->property->owner->name}}</td>
                                                        <td data-title="DataHora">{{$visit->getDateHour()}}</td>
                                                        <td data-title="Mensagem">{{$visit->visited_message}}</td>
                                                        <td data-title="Status">
                                                            <span class="btn btn-{{$visit->getStatusColor()}} btn-xs btn-block botao_pequeno">
                                                                <i class="fa fa-{{$visit->getStatusIcon()}}"></i> {{$visit->getStatusText()}}</span>
                                                        </td>
                                                        <td data-title="Opções">
                                                            @if($visit->isOpened())
                                                                @if(!$visit->isConfirmedByClient('visitor_confirmation'))
                                                                    <a data-toggle="modal"
                                                                       href="#modal_confirmar_visita"
                                                                       data-href="{{route('schedule.visitor_confirm',$visit->id)}}"
                                                                       class="btn btn-success btn-xs btn-block botao_pequeno">Confirmar</a>
                                                                @endif
                                                                <a data-toggle="modal"
                                                                   href="#modal_reagendar_visita"
                                                                   data-href="{{route('schedule.refresh',$visit->id)}}"
                                                                   class="btn btn-default btn-xs btn-block botao_pequeno">Reagendar</a>
                                                                <a data-toggle="modal"
                                                                   href="#modal_cancelar_visita"
                                                                   data-href="{{route('schedule.cancel',$visit->id)}}"
                                                                   class="btn btn-danger btn-xs btn-block botao_pequeno">Cancelar</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
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
            amanha.setDate(amanha.getDate() + 1)
            $('input[name=date_time]').datetimepicker({
                minDate: amanha,
                startDate: amanha,
                format: 'd/m/Y H:i'
            });
        });
        $(document).ready(function () {
            $('div#modal_reagendar_visita').on('show.bs.modal', function (e) {
                    $origem = $(e.relatedTarget);
                    href = $($origem).data('href');
                    console.log(href);
                    $(this).find('form').attr('action', href);
                }
            );
            $('div#modal_confirmar_visita').on('show.bs.modal', function (e) {
                    $origem = $(e.relatedTarget);
                    href = $($origem).data('href');
                    console.log(href);
                    $(this).find('form').attr('action', href);
                }
            );
            $('div#modal_cancelar_visita').on('show.bs.modal', function (e) {
                    $origem = $(e.relatedTarget);
                    href = $($origem).data('href');
                    console.log(href);
                    $(this).find('form').attr('action', href);
                }
            );

            $('div#modal_reagendar').on('show.bs.modal', function (e) {
                $origem = $(e.relatedTarget);
                href = $($origem).data('href');
                console.log(href);
                $(this).find('form').attr('action', href);

                {{----}}
                {{--//                console.log($el);return;--}}
                {{--$('div#modalRemocao').modal('hide');--}}
                {{--$.ajax({--}}
                {{--url: href_,--}}
                {{--type: 'post',--}}
                {{--data: {"_method": 'delete', "_token": "{{ csrf_token() }}"},--}}
                {{--dataType: "json",--}}
                {{--/*--}}
                {{--beforeSend: function () {--}}
                {{--$(".onLoading").show();--}}
                {{--},--}}
                {{--complete: function (xhr, textStatus) {--}}
                {{--$(".onLoading").hide();--}}
                {{--},--}}
                {{--error: function (xhr, textStatus) {--}}
                {{--console.log('xhr-error: ' + xhr);--}}
                {{--console.log('textStatus-error: ' + textStatus);--}}
                {{--},--}}
                {{--*/--}}
                {{--success: function (json) {--}}
                {{--if (json.status) {--}}
                {{--console.log(json.response);--}}

                {{--$el = $($origem).closest('tr');--}}
                {{--if ($el.length == 0) {--}}
                {{--$el = $($origem).closest('.tr');--}}
                {{--}--}}
                {{--$($el).remove();--}}
                {{--} else {--}}
                {{--alert(json.response);--}}
                {{--}--}}
                {{--}--}}
                {{--});--}}
            });
        });

    </script>


@endsection