@extends('admin.layout.template')
@section('modal_content')
    @include('admin.layout.modals.exclusao')
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
                        <table border="0" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Data de Cadastro</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th colspan="2">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Buscas as $selecao)
                                <tr>
                                    <td>
                                        <img src="{{$selecao->getThumbPhoto()}}" class="avatar" alt="Avatar">
                                    </td>
                                    <td>{{$selecao->created_at}}</td>
                                    <td>{{$selecao->name}}</td>
                                    <td>{{$selecao->user->email}}</td>
                                    <td>
                                        <a class="btn btn-default btn-xs"
                                           href="{{route($Page->link.'.show',$selecao->id)}}">
                                            <i class="fa fa-edit"></i> Visualizar / Editar</a>
                                        <a class="btn btn-danger btn-xs"
                                           data-nome="Administrador: {{$selecao->name}}"
                                           data-href="{{route($Page->link.'.destroy',$selecao->id)}}"
                                           data-toggle="modal"
                                           data-target="#modalExclusao"><i class="fa fa-trash-o"></i> Excluir </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">
                            {!! $Buscas->appends(Request::only('busca'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('admin.layout.search.no-results')
    @endif
    <!-- /page content -->
@endsection