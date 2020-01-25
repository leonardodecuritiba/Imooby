@extends('site.layouts.map.template')
@section('styles_content')
    <style type="text/css">

    </style>
@endsection
@section('modals_content')
    @include('site.layouts.modal.negociate')

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
                        <h3 class="h3title"><i class="fa fa-money"></i><b>Negociações</b></h3>
                    </div>
                    <div class="col-md-12">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" style="border-radius: 0px;">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <div class="row" style="margin-top: -10px;">
                                            <div class="col-md-3">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#minhasnegociacoes">
                                                    <button class="btn btn-primary btn-block"
                                                            style="color: #fff; background-color: #00A7EC; border-color: #00A7EC; border-radius: 0px; margin-top: 10px;">
                                                        Minhas Negociações
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#listarnegociacoes">
                                                    <button class="btn btn-primary btn-block"
                                                            style="color: #fff; background-color: #00A7EC; border-color: #00A7EC; border-radius: 0px; margin-top: 10px;">
                                                        Listar Negociações
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#iniciarnegociacao">
                                                    <button class="btn btn-primary btn-block"
                                                            style="color: #fff; background-color: #00A7EC; border-color: #00A7EC; border-radius: 0px; margin-top: 10px;">
                                                        Iniciar
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </h4>
                                </div>
                                <div id="minhasnegociacoes" class="panel-collapse collapse in">
                                    <div class="panel-body" style="border-radius: 0px;">
                                        <label class="form-label" style="font-size: 1.5em;">Minhas Negociações</label>
                                        <p>Confira abaixo as negociações que você iniciou.</p>
                                        @if($_SELF_TEMPLATE_['RenterNegociations']->count()>0)
                                            <table class="table table-responsive table-bordered table-striped"
                                                   id="no-more-tables">
                                                <thead>
                                                <tr>
                                                    <th><b>#</b></th>
                                                    <th><b>Imóvel</b></th>
                                                    <th><b>Proprietário</b></th>
                                                    <th><b>Status</b></th>
                                                    <th><b>Opções</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($_SELF_TEMPLATE_['RenterNegociations'] as $negociation)
                                                    <tr>
                                                        <td data-title="ID">{{$negociation->id}}</td>
                                                        <td data-title="Imóvel">
                                                            <a href="{{route('ver-imovel',$negociation->idproperty)}}">{{$negociation->property->title}}</a>
                                                        </td>
                                                        <td data-title="Propietário">{{$negociation->property->owner->name}}</td>
                                                        <td data-title="Status">
                                                                <span class="btn btn-{{$negociation->getStatusColor()}} btn-xs btn-block botao_pequeno">
                                                                    <i class="fa fa-{{$negociation->getStatusIcon()}}"></i> {{$negociation->getStatusText()}}</span>
                                                        </td>
                                                        <td data-title="Opções">
                                                            <a href="{{route('negociation.show',$negociation->id)}}" class="btn btn-success btn-xs btn-block botao_pequeno">Visualizar</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                                <div id="listarnegociacoes" class="panel-collapse collapse">
                                    <div class="panel-body" style="border-radius: 0px;">
                                        <label class="form-label" style="font-size: 1.5em;">Listar Negociações</label>
                                        <p>Confira abaixo as negociações que foram iniciadas para os seus imóveis.</p>
                                        @if($_SELF_TEMPLATE_['OwnerNegociations']->count()>0)
                                            <table class="table table-responsive table-bordered table-striped"
                                                   id="no-more-tables">
                                                <thead>
                                                <tr>
                                                    <th><b>#</b></th>
                                                    <th><b>Meu Imóvel</b></th>
                                                    <th><b>Interessado</b></th>
                                                    <th><b>Status</b></th>
                                                    <th><b>Opções</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($_SELF_TEMPLATE_['OwnerNegociations'] as $negociation)
                                                    <tr>
                                                        <td data-title="ID">{{$negociation->id}}</td>
                                                        <td data-title="Imóvel">
                                                            <a href="{{route('ver-imovel',$negociation->idproperty)}}">{{$negociation->property->title}}</a>
                                                        </td>
                                                        <td data-title="Interessado">{{$negociation->renter->name}}</td>
                                                        <td data-title="Status">
                                                                <span class="btn btn-{{$negociation->getStatusColor()}} btn-xs btn-block botao_pequeno">
                                                                    <i class="fa fa-{{$negociation->getStatusIcon()}}"></i> {{$negociation->getStatusText()}}</span>
                                                        </td>
                                                        <td data-title="Opções">
                                                            <a href="{{route('negociation.show',$negociation->id)}}" class="btn btn-success btn-xs btn-block botao_pequeno">Visualizar</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                                <div id="iniciarnegociacao" class="panel-collapse collapse">
                                    <div class="panel-body" style="border-radius: 0px;">
                                        <label class="form-label" style="font-size: 1.5em;">Iniciar Nova Negociação</label>
                                        <p>Inicie uma nova negociação.</p>
                                        @if($_SELF_TEMPLATE_['Visits']->count()>0)
                                            <table class="table table-responsive table-bordered table-striped"
                                                   id="no-more-tables">
                                                <thead>
                                                <tr>
                                                    <th><b>#</b></th>
                                                    <th><b>Imóvel</b></th>
                                                    <th><b>Propietário</b></th>
                                                    <th><b>Situação Imóvel</b></th>
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
                                                        <td data-title="Situação Imóvel"><span
                                                                    class="btn btn-xs btn-{{$visit->property->getStatusColor()}}">{{$visit->property->getStatusText()}}</span>
                                                        </td>
                                                        <td data-title="Opções">
                                                            <a data-toggle="modal"
                                                               href="#modal_iniciar_negociacao"
                                                               data-idproperty="{{$visit->idproperty}}"
                                                               class="btn btn-success btn-xs btn-block botao_pequeno">Iniciar Negociação</a>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('div#modal_iniciar_negociacao').on('show.bs.modal', function (e) {
                var $origem = $(e.relatedTarget);
                var idproperty = $($origem).data('idproperty');
                $(this).find('form input[name=idproperty]').val(idproperty);
            });
        });
    </script>


@endsection