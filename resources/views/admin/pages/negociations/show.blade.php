@extends('admin.layout.template')
@section('style_content')
@endsection
@section('page_content')
    <div class="x_panel">
        <div class="alert fade in alert-{{$Data->getStatusColor()}}" role="alert">
            <i class="fa fa-{{$Data->getStatusIcon()}}"></i> {{$Data->getStatusText()}}
        </div>
        <div class="x_title">
            <h2>(#{{$Data->id}}) Negociação
                <small>Proprietário: <b>{{$Data->property->owner->name}}</b></small>
            </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="row tile_count">
                <div class="col-md-12 col-sm-12 col-xs-12 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> Aluguel</span>
                    <div class="count green">{{$Data->priceRentalTotalReal()}}</div>
                </div>
            </div>
            <div class="row tile_count">
                <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> Condomínio</span>
                    <div class="count">{{$Data->priceCondominiumReal()}}</div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> Taxas</span>
                    <div class="count">{{$Data->priceFeeReal()}}</div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> IPTU</span>
                    <div class="count">{{$Data->priceIptuReal()}}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_title">
                        <h3>Locatário
                            <small>{{$Data->renter->name}}</small>
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="profile_details">
                            <div class="well profile_view" style="width: 100%">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <ul class="list-unstyled project_files">
                                        <li><i class="fa fa-info"></i> Condições Imooby:
                                            <b>{{$Data->getRenterAcceptConditionsText()}}</b></li>
                                        <li><i class="fa fa-calendar"></i> Data provável de mudança:
                                            <b>{{$Data->date_change}}</b></li>
                                        <li><i class="fa fa-money"></i> Comprovação de renda:
                                            <b>{{$Data->getIncomeProofText()}}</b></li>
                                    </ul>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <ul class="list-unstyled project_files">
                                        <li><i class="fa fa-users"></i> Quem vai morar no imóvel:
                                            <b>{{$Data->residents}}</b></li>
                                        <li><i class="fa fa-paw"></i> Animais de estimação:
                                            <b>{{$Data->getAnimalsText()}}</b></li>
                                        <li><i class="fa fa-info"></i> Condições de Locação:
                                            <b>{{$Data->renter_conditions}}</b></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="x_title">
                                <h2>Documentos do Locatário</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                        @if($Data->isRenterDocumentsAccepted())
                                            <button class="btn btn-danger"
                                                    onclick="window.location.href='{{route('admins.negociations.rejectRenterDocuments',$Data->id)}}'">
                                                <i class="fa fa-times fa-2" aria-hidden="true"></i> Rejeitar
                                            </button>
                                        @else
                                            <button class="btn btn-success"
                                                    onclick="window.location.href='{{route('admins.negociations.acceptRenterDocuments',$Data->id)}}'">
                                                <i class="fa fa-check fa-2" aria-hidden="true"></i> Aceitar
                                            </button>
                                        @endif
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                @if($Data->renter_documents->count())
                                    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                                        @foreach($Data->renter_documents as $i => $renter_document)
                                            <div class="panel">
                                                <a class="panel-heading" role="tab" data-toggle="collapse"
                                                   data-parent="#accordion1" href="#collapse{{$i}}" aria-expanded="true"
                                                   aria-controls="collapseOne">
                                                    <h4 class="panel-title">
                                                        <div class="btn btn-xs btn-{{$renter_document->getStatusColor()}}">
                                                            <i class="fa fa-{{$renter_document->getStatusIcon()}}"></i> {{$renter_document->getStatusText()}}
                                                        </div>{{$renter_document->name}} (#{{$renter_document->id}})
                                                    </h4>
                                                </a>
                                                <div id="collapse{{$i}}" class="panel-collapse collapse" role="tabpanel"
                                                     aria-labelledby="headingOne">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div class="project_detail">
                                                                    <p class="title">Nome</p>
                                                                    <p>{{$renter_document->name}}</p>
                                                                    <p class="title">Email</p>
                                                                    <p>{{$renter_document->email}}</p>
                                                                    <p class="title">CPF</p>
                                                                    <p>{{$renter_document->cpf}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div class="project_detail">
                                                                    <p class="title">Telefone</p>
                                                                    <p>{{$renter_document->getFormatedPhone()}}</p>
                                                                    <p class="title">Celular</p>
                                                                    <p>{{$renter_document->getFormatedCellphone()}}</p>
                                                                    <p class="title">Estado Cívil</p>
                                                                    <p>{{$renter_document->civil_status}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div class="project_detail">
                                                                    <p class="title">Natureza da Renda</p>
                                                                    <p>{{$renter_document->income_nature}}</p>
                                                                    <p class="title">Rendimento Bruto Mensal</p>
                                                                    <p>{{$renter_document->getFormatedGrossIncome()}}</p>
                                                                    <p class="title">Motivo de Locação</p>
                                                                    <p>{{$renter_document->reason}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="ln_solid"></div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-6 col-xs-12 project_detail">
                                                                <p class="title">RG, CNH ou RNE</p>
                                                                <p class="url">
                                                                    <span class="fs1 text-info" aria-hidden="true"
                                                                          data-icon=""></span>
                                                                    <a target="_blank"
                                                                       href="{{$renter_document->getDocImage()}}"><i
                                                                                class="fa fa-paperclip"></i> Abrir </a>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12 project_detail">
                                                                <p class="title">CPF</p>
                                                                <p class="url">
                                                                    <span class="fs1 text-info" aria-hidden="true"
                                                                          data-icon=""></span>
                                                                    <a target="_blank"
                                                                       href="{{$renter_document->getCpfImage()}}"><i
                                                                                class="fa fa-paperclip"></i> Abrir </a>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12 project_detail">
                                                                <p class="title">Comprovante de Residência</p>
                                                                <p class="url">
                                                                    <span class="fs1 text-info" aria-hidden="true"
                                                                          data-icon=""></span>
                                                                    <a target="_blank"
                                                                       href="{{$renter_document->getAddressProofImage()}}"><i
                                                                                class="fa fa-paperclip"></i> Abrir </a>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12 project_detail">
                                                                <p class="title">Holerite, Imposto de Renda ou
                                                                    DECORE</p>
                                                                <p class="url">
                                                                    <span class="fs1 text-info" aria-hidden="true"
                                                                          data-icon=""></span>
                                                                    <a target="_blank"
                                                                       href="{{$renter_document->getIncomeProofImage()}}"><i
                                                                                class="fa fa-paperclip"></i> Abrir </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="ln_solid"></div>
                                                        @if(!$Data->isRenterDocumentsAccepted())
                                                            <div class="row">
                                                                <a href="{{$renter_document->getBtnStatusLink()}}"
                                                                   class="btn btn-{{$renter_document->getBtnStatusColor()}} pull-right">
                                                                    <i class="fa fa-{{$renter_document->getBtnStatusIcon()}}"
                                                                       aria-hidden="true"></i> {{$renter_document->getBtnStatusText()}}
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>Documentos não enviados</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_title">
                        <h3>Proprietário
                            <small>{{$Data->property->owner->name}}</small>
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="profile_details">
                            <div class="well profile_view" style="width: 100%">
                                <div class="col-xs-12">
                                    <div class="perfil">
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-info"></i> Condições Imooby:
                                                <b>{{$Data->getOwnerAcceptConditionsText()}}</b></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="x_title">
                                <h2>Documentos do Proprietário</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                        @if($Data->isOwnerDocumentsAccepted())
                                            <button class="btn btn-danger"
                                                    onclick="window.location.href='{{route('admins.negociations.rejectOwnerDocuments',$Data->id)}}'">
                                                <i class="fa fa-times fa-2" aria-hidden="true"></i> Rejeitar
                                            </button>
                                        @else
                                            <button class="btn btn-success"
                                                    onclick="window.location.href='{{route('admins.negociations.acceptOwnerDocuments',$Data->id)}}'">
                                                <i class="fa fa-check fa-2" aria-hidden="true"></i> Aceitar
                                            </button>
                                        @endif
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                @if($Data->owner_document != NULL)
                                    <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                                        <div class="panel">
                                            <a class="panel-heading" role="tab" data-toggle="collapse"
                                               data-parent="#accordion2" href="#owner_collapse{{$i}}"
                                               aria-expanded="true" aria-controls="collapseOne">
                                                <h4 class="panel-title">
                                                    <div class="btn btn-xs btn-{{$Data->owner_document->getStatusColor()}}">
                                                        <i class="fa fa-{{$Data->owner_document->getStatusIcon()}}"></i> {{$Data->owner_document->getStatusText()}}
                                                    </div>{{$Data->owner_document->name}}
                                                    (#{{$Data->owner_document->id}})
                                                </h4>
                                            </a>
                                            <div id="owner_collapse{{$i}}" class="panel-collapse collapse"
                                                 role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                            <div class="project_detail">
                                                                <p class="title">Nome</p>
                                                                <p>{{$Data->owner_document->name}}</p>
                                                                <p class="title">Email</p>
                                                                <p>{{$Data->owner_document->email}}</p>
                                                                <p class="title">CPF</p>
                                                                <p>{{$Data->owner_document->cpf}}</p>
                                                                <p class="title">Código do IPTU</p>
                                                                <p>{{$Data->owner_document->iptu_code}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                            <div class="project_detail">
                                                                <p class="title">Telefone</p>
                                                                <p>{{$Data->owner_document->getFormatedPhone()}}</p>
                                                                <p class="title">Celular</p>
                                                                <p>{{$Data->owner_document->getFormatedCellphone()}}</p>
                                                                <p class="title">Estado Cívil</p>
                                                                <p>{{$Data->owner_document->civil_status}}</p>
                                                                <p class="title">Número de Matrícula</p>
                                                                <p>{{$Data->owner_document->iptu_registration}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ln_solid"></div>
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-6 col-xs-12 project_detail">
                                                            <p class="title">RG, CNH ou RNE</p>
                                                            <p class="url">
                                                                <span class="fs1 text-info" aria-hidden="true"
                                                                      data-icon=""></span>
                                                                <a target="_blank"
                                                                   href="{{$Data->owner_document->getDocImage()}}"><i
                                                                            class="fa fa-paperclip"></i> Abrir </a>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-6 col-xs-12 project_detail">
                                                            <p class="title">CPF</p>
                                                            <p class="url">
                                                                <span class="fs1 text-info" aria-hidden="true"
                                                                      data-icon=""></span>
                                                                <a target="_blank"
                                                                   href="{{$Data->owner_document->getCpfImage()}}"><i
                                                                            class="fa fa-paperclip"></i> Abrir </a>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-6 col-xs-12 project_detail">
                                                            <p class="title">Comprovante de Residência</p>
                                                            <p class="url">
                                                                <span class="fs1 text-info" aria-hidden="true"
                                                                      data-icon=""></span>
                                                                <a target="_blank"
                                                                   href="{{$Data->owner_document->getAddressProofImage()}}"><i
                                                                            class="fa fa-paperclip"></i> Abrir </a>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-6 col-xs-12 project_detail">
                                                            <p class="title">Holerite, Imposto de Renda ou DECORE</p>
                                                            <p class="url">
                                                                <span class="fs1 text-info" aria-hidden="true"
                                                                      data-icon=""></span>
                                                                <a target="_blank"
                                                                   href="{{$Data->owner_document->getIncomeProofImage()}}"><i
                                                                            class="fa fa-paperclip"></i> Abrir </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="ln_solid"></div>
                                                    @if(!$Data->isOwnerDocumentsAccepted())
                                                        <div class="row">
                                                            <a href="{{$Data->owner_document->getBtnStatusLink()}}"
                                                               class="btn btn-{{$Data->owner_document->getBtnStatusColor()}} pull-right">
                                                                <i class="fa fa-{{$Data->owner_document->getBtnStatusIcon()}}"
                                                                   aria-hidden="true"></i> {{$Data->owner_document->getBtnStatusText()}}
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p>Documentos não enviados</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts_content')
    <script>
    </script>
@endsection

