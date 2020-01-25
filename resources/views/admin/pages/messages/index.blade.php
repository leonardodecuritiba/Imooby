@extends('layouts.template')
@section('style_content')
    <!-- Datatables -->
    @include('helpers.datatables.head')
    <!-- /Datatables -->
@endsection
@section('page_content')
    @include('layouts.modals.view')
    <!-- /page content -->
    @if(count($Contatos) > 0)
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$Page->Targets}} encontrados</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInDown">
                        <table id="datatable-responsive"
                               class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Data de Cadastro</th>
                                <th>Status</th>
                                <th>Email</th>
                                <th>Nome</th>
                                <th>Mensagem</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Contatos as $item)
                                <tr>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <a class="btn btn-xs @if($item->status) btn-success @else btn-danger  @endif">
                                            <i class="fa @if($item->status) fa-check @else fa-times @endif"></i> {{$item->status_text()}}
                                        </a>
                                    </td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->nome}}</td>
                                    <td>{{$item->mensagem}}</td>
                                    <td>
                                        <a class="btn btn-default btn-xs"
                                           href="{{route($Page->link.'.show',$item->id)}}">
                                            <i class="fa fa-edit"></i> Visualizar/Responder</a>
                                        <a class="btn btn-danger btn-xs"
                                           data-nome="O contato do cliente {{$item->nome}}"
                                           data-href="{{route($Page->link.'.destroy',$item->id)}}"
                                           data-toggle="modal"
                                           data-target="#modalRemocao">
                                            <i class="fa fa-trash-o"></i> Excluir </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('layouts.search.no-results')
    @endif
@endsection
@section('scripts_content')
    <!-- Datatables -->
    @include('helpers.datatables.foot')
    <!-- /Datatables -->
@endsection