@extends('admin.layout.template')
@section('style_content')
    @include('helpers.datatables.head')
@endsection
@section('modal_content')
    @include('admin.layout.modals.desativacao')
@endsection
@section('page_content')
    <!-- Seach form -->
    @include('admin.layout.search.form')

    @if(count($Buscas) > 0)
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$Page->Targets}} encontrados</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInDown">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Situação</th>
                                <th>Imagem</th>
                                <th>Data de Cadastro</th>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Buscas as $selecao)
                                <tr>
                                    <td>{{$selecao->id}}</td>
                                    <td>
                                        <span class="btn btn-{{$selecao->getStatusColor()}} btn-xs">{{$selecao->getStatusText()}}</span>
                                    </td>
                                    <td>
                                        <img src="{{$selecao->getThumbPhoto()}}" class="avatar" alt="Avatar">
                                    </td>
                                    <td>{{$selecao->created_at}}</td>
                                    <td>{{$selecao->name}}</td>
                                    <td>
                                        <a class="btn btn-default btn-xs"
                                           href="{{route($Page->link.'.show',$selecao->id)}}">
                                            <i class="fa fa-eye"></i> Visualizar</a>
                                        @if($selecao->getStatus())
                                            <a class="btn btn-danger btn-xs"
                                               data-nome="Cliente: {{$selecao->name}}"
                                               data-href="{{route($Page->link.'.disactivate',$selecao->id)}}"
                                               data-toggle="modal"
                                               data-target="#modalDesativacao"><i class="fa fa-times"></i> Desativar
                                            </a>
                                        @else
                                            <a class="btn btn-success btn-xs"
                                               href="{{route($Page->link.'.activate',$selecao->id)}}"><i
                                                        class="fa fa-check"></i> Ativar </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Situação</th>
                                <th>Imagem</th>
                                <th>Data de Cadastro</th>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('admin.layout.search.no-results')
    @endif
    <!-- /page content -->
@endsection
@section('scripts_content')
    <!-- Datatables -->
    @include('helpers.datatables.foot')
    <script>
        $(document).ready(function () {
            $('.dt-responsive').DataTable(
                {
                    "language": language_pt_br,
                    "pageLength": 10,
                    "columnDefs": [{
                        "targets": 0,
                        "orderable": true
                    }],
                    "order": [[0, "desc"]],
                    "bLengthChange": false, //used to hide the property
                    "bFilter": false
                }
            );
        });
    </script>
    <!-- /Datatables -->
@endsection