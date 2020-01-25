@extends('admin.layout.template')
@section('style_content')
    @include('helpers.datatables.head')
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
                                <th>Data de Cadastro</th>
                                <th>Imagem</th>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Favoritos</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Buscas as $selecao)
                                <tr>
                                    <td>{{$selecao->id}}</td>
                                    <td>
                                        @if($selecao->status)
                                            <button class="btn btn-success btn-xs" role="alert"><i class="fa fa-check"
                                                                                                   aria-hidden="true"></i> {{$selecao->getStatusText()}}
                                            </button>
                                        @else
                                            <button class="btn btn-danger btn-xs" role="alert"><i class="fa fa-times"
                                                                                                  aria-hidden="true"></i> {{$selecao->getStatusText()}}
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{$selecao->created_at}}</td>
                                    <td>
                                        <img src="{{$selecao->getThumbMainPhoto()}}" class="avatar" alt="Avatar">
                                    </td>
                                    <td>{{$selecao->getShortTitle()}}</td>
                                    <td>{{$selecao->getShortDescription()}}</td>
                                    <td>{{$selecao->countFavorites()}}</td>
                                    <td>
                                        <a class="btn btn-default btn-xs"
                                           href="{{route($Page->link.'.show',[$selecao->id,'profile'])}}">
                                            <i class="fa fa-eye"></i> Visualizar</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Situação</th>
                                <th>Imagem</th>
                                <th>Data de Cadastro</th>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Favoritos</th>
                                <th>Ações</th>
                            </tr>
                            </tfoot>
                            </tbody>
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